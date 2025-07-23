<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class MovementController extends Controller {


    public function index(Request $request) {
        return view('admin.movements', [
            'products' => Product::all(),
            'warehouses' => Warehouse::all(),
        ]);
    }



    // public function index(Request $request) {
    //     $query = Movement::with(['product', 'warehouse']);

    //     if ($request->filled('product_id')) {
    //         $query->where('product_id', $request->product_id);
    //     }

    //     if ($request->filled('warehouse_id')) {
    //         $query->where('warehouse_id', $request->warehouse_id);
    //     }

    //     if ($request->filled('from')) {
    //         $query->whereDate('created_at', '>=', $request->from);
    //     }

    //     if ($request->filled('to')) {
    //         $query->whereDate('created_at', '<=', $request->to);
    //     }

    //     $perPage = $request->input('per_page', 10);
    //     $movements = $query->orderBy('created_at', 'desc')->paginate($perPage);

    //     return view('admin.movements.index', [
    //         'movements' => $movements,
    //         'products' => Product::all(),
    //         'warehouses' => Warehouse::all(),
    //         'filters' => $request->only(['product_id', 'warehouse_id', 'from', 'to', 'per_page']),
    //     ]);
    // }
}
