<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DashboardController extends Controller {


    /**
     * Отображает панель управления для администратора с ключевой статистикой.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function dashboard() {
        // Получаем общее количество продуктов
        $totalProducts = Product::count();

        // Получаем общее количество заказов
        $totalOrders = Order::count();

        // Считаем уникальных клиентов по имени
        $totalCustomers = Order::distinct('customer')->count('customer');

        // Считаем количество складов
        $totalWarehouses = Warehouse::count();

        // Получаем последние 5 заказов
        $latestOrders = Order::with('warehouse')->latest()->take(5)->get();


            // Получаем 5 продуктов с наибольшим суммарным остатком на складах
            $products = Product::with('stocks.warehouse')
                ->get()->sortByDesc(function ($product) {
                    return $product->stocks->sum('stock');
                })
                ->take(5);

                //Список складов
        $warehouses = Warehouse::with('stocks')->latest()->take(5)->get();

        // Получаем 5 последних движений товаров
        $latestMovements = Movement::with('product', 'warehouse')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

            // Получаем последние 5 уникальных клиентов по заказам
        $clients = Order::select('customer', 'created_at')
            ->orderByDesc('created_at')
            ->distinct('customer')
            ->take(5)
            ->get();


        // Возвращаем представление с данными
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalWarehouses',
            'latestOrders',
            'latestMovements',
            'clients',
            'products',
            'warehouses'
        ));
    }

}
