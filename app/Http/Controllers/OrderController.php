<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\HasFilters;


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

        // Возвращаем представление с данными
        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'canceledOrders',
            'lastOrderDate'
        ))->with('filters', $request->all());
    }




}
