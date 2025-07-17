<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Stock;
use Illuminate\Http\Request;

class MovememntController extends Controller {
    public function addStock(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Mise à jour du stock
        $stock = Stock::firstOrCreate([
            'product_id' => $request->product_id,
            'warehouse_id' => $request->warehouse_id,
        ], [
            'stock' => 0
        ]);

        $stock->increment('stock', $request->quantity);

        // Enregistrement du mouvement
        Movement::create([
            'product_id' => $request->product_id,
            'warehouse_id' => $request->warehouse_id,
            'quantity' => $request->quantity,
            'type' => 'add'
        ]);

        return back()->with('success', 'Запас успешно пополнен');
    }

}
