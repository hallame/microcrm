<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementApiController extends Controller {

    
    public function index(Request $request) {
        $query = Movement::with(['product', 'warehouse']);

        // фильтры
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('warehouse_id')) {
            $query->where('warehouse_id', $request->warehouse_id);
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Пагинация
        $perPage = $request->input('per_page', 15);
        $movements = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json($movements);
    }
}
