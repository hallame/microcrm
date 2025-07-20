<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function index(){
        $products = Product::with(['stocks.warehouse'])->get();
        $totalWarehouses = Warehouse::count();
        $totalProductsInStock = Stock::distinct('product_id')->count();
        $totalStock = Stock::sum('stock');
        $lastMovementDate = Movement::latest('created_at')->value('created_at');
        $warehouses = Warehouse::all();
        return view('admin.products.index', compact(
                                        'totalWarehouses',
                                        'totalProductsInStock',
                                        'totalStock',
                                        'lastMovementDate',
                                        'products',
                                        'warehouses'
                                    ));
    }


    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stocks' => 'required|array|min:1',
            'stocks.*.warehouse_id' => 'required|exists:warehouses,id',
            'stocks.*.stock' => 'required|numeric|min:0',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        foreach ($request->stocks as $entry) {
            $stock = Stock::create([
                'product_id' => $product->id,
                'warehouse_id' => $entry['warehouse_id'],
                'stock' => $entry['stock'],
            ]);

            if ($entry['stock'] > 0) {
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $entry['warehouse_id'],
                    'quantity' => $entry['stock'],
                    'type' => 'create',
                    'reason' => 'Начальный запас при создании продукта',
                ]);
            }
        }

        return back()->with('success', 'Продукт успешно добавлен с несколькими остатками.');
    }


    public function update(Request $request, $id) {
        // Валидация данных с пользовательскими сообщениями
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
            'stock' => 'required|numeric|min:0',

        ], [
            'name.required' => 'Пожалуйста, введите название продукта.',
            'name.string' => 'Название должно быть текстом.',
            'name.max' => 'Название не должно превышать 255 символов.',

            'price.required' => 'Пожалуйста, укажите цену продукта.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть меньше 0.',

            'warehouse_id.required' => 'Пожалуйста, выберите склад.',
            'warehouse_id.exists' => 'Выбранный склад не существует.',

           'stock.required' => 'Пожалуйста, укажите количество на складе.',
            'stock.numeric' => 'Количество должно быть числом.',
            'stock.min' => 'Количество не может быть отрицательным.',
        ]);

        // Поиск продукта
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        // Обновление записи на складе (предполагаем только одну связанную запись)
        $stock = Stock::where('product_id', $product->id)->first();
        if ($stock) {
            $stock->warehouse_id = $request->warehouse_id;
            $stock->save();
        }
        return back()->with('success', 'Продукт успешно обновлён.');
    }

    public function delete($id) {
        $product = Product::findOrFail($id);
        foreach ($product->stocks as $stock) {
            // Сохранить движение удаления
            Movement::create([
                'product_id' => $product->id,
                'warehouse_id' => $stock->warehouse_id,
                'quantity' => $stock->stock,
                'type' => 'delete',
                'reason' => "Удаление продукта «{$product->name}» и очистка остатков",
            ]);
            $stock->delete();
        }
        $product->delete();
        return back()->with('success', 'Продукт успешно удалён.');
    }


}
