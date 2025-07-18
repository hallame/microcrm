<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\HasFilters;
use App\Models\Movement;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {
    use HasFilters;
    /**
     * Получить список заказов с фильтрами и настраиваемой пагинацией.
     */

    public function index(Request $request) {
        // Запрос с предзагрузкой связей: товары в заказе и клиент
        $query = Order::query()->with(['items.product']);

        // Применяем фильтры статуса и периода (если переданы)
        $query = $this->applyFilters($request, $query);

        // Параметр постраничной навигации
        $perPage = $request->input('per_page', 10);
        $orders = $query->paginate($perPage);

        // Статистика
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();
        $lastOrderDate = Order::latest('created_at')->first()?->created_at;


        // PRODUCTS
        $products = Product::all();

        // WAREHOUSES
        $warehouses = Warehouse::with(['stocks.product'])->get();
        $stocksGroupedByWarehouse = [];

        foreach ($warehouses as $warehouse) {
            $stocksGroupedByWarehouse[$warehouse->id] = $warehouse->stocks
                ->filter(fn($s) => $s->stock > 0)
                ->map(fn($s) => [
                    'product_id' => $s->product->id,
                    'product_name' => $s->product->name,
                    'stock' => $s->stock,
                ])->values();
        }

        // Возвращаем представление с данными
        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'canceledOrders',
            'lastOrderDate',
            'warehouses',
            'stocksGroupedByWarehouse',
            'products'
        ))->with('filters', $request->all());
    }

    public function add(Request $request) {
        $request->validate([
            'customer' => 'required|string|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.count' => 'required|integer|min:1',
        ], [
            'customer.required' => 'Пожалуйста, укажите имя клиента.',
            'customer.string' => 'Имя клиента должно быть строкой.',
            'customer.max' => 'Имя клиента не должно превышать 255 символов.',

            'warehouse_id.required' => 'Пожалуйста, выберите склад.',
            'warehouse_id.exists' => 'Выбранный склад не существует.',

            'items.required' => 'Необходимо добавить хотя бы одну позицию в заказ.',
            'items.array' => 'Позиции заказа должны быть массивом.',
            'items.min' => 'Добавьте хотя бы один товар.',

            'items.*.product_id.required' => 'Выберите продукт для каждой позиции.',
            'items.*.product_id.exists' => 'Выбранный продукт не найден.',

            'items.*.count.required' => 'Укажите количество для каждой позиции.',
            'items.*.count.integer' => 'Количество должно быть целым числом.',
            'items.*.count.min' => 'Минимальное количество — 1.',
        ]);

        DB::beginTransaction();
        try {
            // Создание заказа
            $order = Order::create([
                'customer' => $request->customer,
                'warehouse_id' => $request->warehouse_id,
                'status' => 'active',
            ]);

            foreach ($request->items as $item) {
                // Проверка наличия товара
                $stock = Stock::where('warehouse_id', $request->warehouse_id)
                            ->where('product_id', $item['product_id'])
                            ->first();

                if (!$stock || $stock->stock < $item['count']) {
                    throw new \Exception("Недостаточно товара на складе для продукта ID: {$item['product_id']}");
                }

                // Добавление позиции заказа
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'count' => $item['count'],
                ]);

                // Обновление склада
                $stock->decrement('stock', $item['count']);

                // Запись движения
                Movement::create([
                    'product_id' => $item['product_id'],
                    'warehouse_id' => $request->warehouse_id,
                    'quantity' => $item['count'],
                    'type' => 'order'
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Заказ успешно создан.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ошибка: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        $order = Order::with(['items.product', 'warehouse'])->findOrFail($id);
        $warehouses = Warehouse::all();
        $products = Product::all();
         if ($order->status === 'completed') {
            return back()->with('error', 'Нельзя изменить завершённый заказ.');
        }

        $stocksGroupedByWarehouse = Stock::with('product')
            ->get()
            ->groupBy('warehouse_id')
            ->map(fn($group) => $group->map(fn($s) => [
                'product_id' => $s->product_id,
                'product_name' => $s->product->name,
                'stock' => $s->stock,
            ]));

        return view('admin.orders.edit', compact('order', 'warehouses', 'products', 'stocksGroupedByWarehouse'));
    }


    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        // Не разрешать обновление, если команда завершена
        if ($order->status === 'completed') {
            return back()->with('error', 'Нельзя изменить завершённый заказ.');
        }

        $request->validate([
            'customer' => 'required|string|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.count' => 'required|integer|min:1',
        ], [
           'customer.required' => 'Пожалуйста, укажите имя клиента.',
            'customer.string' => 'Имя клиента должно быть строкой.',
            'customer.max' => 'Имя клиента не должно превышать 255 символов.',

            'warehouse_id.required' => 'Пожалуйста, выберите склад.',
            'warehouse_id.exists' => 'Выбранный склад не существует.',

            'items.required' => 'Необходимо добавить хотя бы одну позицию в заказ.',
            'items.array' => 'Позиции заказа должны быть массивом.',
            'items.min' => 'Добавьте хотя бы один товар.',

            'items.*.product_id.required' => 'Выберите продукт для каждой позиции.',
            'items.*.product_id.exists' => 'Выбранный продукт не найден.',

            'items.*.count.required' => 'Укажите количество для каждой позиции.',
            'items.*.count.integer' => 'Количество должно быть целым числом.',
            'items.*.count.min' => 'Минимальное количество — 1.',
        ]);

       $warehouseId = $request->warehouse_id;

        // Проверка доступных остатков с учётом уже зарезервированных в заказе
        foreach ($request->items as $index => $item) {
            $productId = $item['product_id'];
            $requestedCount = $item['count'];

            $stock = Stock::where('product_id', $productId)
                        ->where('warehouse_id', $warehouseId)
                        ->first();

            // Количество, уже заказанное ранее (до удаления)
            $previousCount = $order->items()
                ->where('product_id', $productId)
                ->first()?->count ?? 0;

            $availableStock = ($stock?->stock ?? 0) + $previousCount;

            if ($requestedCount > $availableStock) {
                return back()->withErrors([
                    "items.$index.product_id" => "Недостаточно запаса для товара «" . Product::find($productId)?->name . "».",
                ])->withInput();
            }
        }

        // Обновление клиента и склада (статус не изменяется)
        $order->update([
            'customer' => $request->customer,
            'warehouse_id' => $warehouseId,
        ]);

        // Удаление старых позиций
        $order->items()->delete();

        // Добавление новых позиций
        foreach ($request->items as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'count' => $item['count'],
            ]);
        }

        return back()->with('success', 'Заказ успешно обновлён.');

    }






}
