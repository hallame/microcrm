<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function index() {
        $products = Product::with('stocks')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function stocks() {
        $products = Product::with(['stocks.warehouse'])->get();

        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stocks' => $product->stocks->map(function ($stock) {
                    return [
                        'warehouse' => $stock->warehouse->name,
                        'stock' => $stock->stock,
                    ];
                }),
            ];
        });
    }
}
