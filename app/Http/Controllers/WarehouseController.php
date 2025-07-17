<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller {

    /**
     * Получить список всех складов
     */
    public function index(){
        $warehouses = Warehouse::all();
        $totalWarehouses = Warehouse::count();
        $totalProductsInStock = Stock::distinct('product_id')->count();
        $totalStock = Stock::sum('stock');
        $lastMovementDate = Movement::latest('created_at')->value('created_at');
        return view('admin.warehouses.index', compact(
                                        'warehouses',
                                        'totalWarehouses',
                                        'totalProductsInStock',
                                        'totalStock',
                                        'lastMovementDate'
        ));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Поле "Название склада" обязательно для заполнения.',
            'name.string' => 'Поле "Название склада" должно быть строкой.',
            'name.max' => 'Поле "Название склада" не должно превышать 255 символов.',
        ]);

        Warehouse::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Склад успешно добавлен');
    }

}
