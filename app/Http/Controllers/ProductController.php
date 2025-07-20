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

    public function addForm(){
        $warehouses = Warehouse::with(['stocks.product'])->get();
        return view('admin.products.add', compact('warehouses'));
    }


    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stocks' => 'required|array|min:1',
            'stocks.*.warehouse_id' => 'required|exists:warehouses,id',
            'stocks.*.stock' => 'required|numeric|min:0',
        ]);

        $selectedWarehouses = [];
        foreach ($request->stocks as $index => $stockData) {
            $wid = $stockData['warehouse_id'];
            if (in_array($wid, $selectedWarehouses)) {
                return back()->withErrors([
                    "stocks.$index.warehouse_id" => "Склад уже выбран. Пожалуйста, выберите разные склады.",
                ])->withInput();
            }
            $selectedWarehouses[] = $wid;
        }


        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        foreach ($request->stocks as $stockData) {
            if (!empty($stockData['warehouse_id']) && $stockData['stock'] > 0) {
                Stock::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $stockData['warehouse_id'],
                    'stock' => $stockData['stock'],
                ]);

                // Добавление записи движения
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $stockData['warehouse_id'],
                    'quantity' => $stockData['stock'],
                    'type' => 'create',
                    'reason' => "Создание товара «{$product->name}» на складе",
                ]);
            }
        }
        return back()->with('success', 'Продукт успешно добавлен с несколькими остатками.');
    }

    public function edit($id) {
        $product = Product::with('stocks')->findOrFail($id);
        $warehouses = Warehouse::all();

        return view('admin.products.edit', compact('product', 'warehouses'));
    }


  public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stocks' => 'required|array|min:1',
            'stocks.*.warehouse_id' => 'required|exists:warehouses,id',
            'stocks.*.stock' => 'required|numeric|min:0',
        ]);

        $selectedWarehouses = [];

        foreach ($request->stocks as $index => $stockData) {
            $wid = $stockData['warehouse_id'];
            if (in_array($wid, $selectedWarehouses)) {
                return back()->withErrors([
                    "stocks.$index.warehouse_id" => "Склад уже выбран. Пожалуйста, выберите разные склады.",
                ])->withInput();
            }
            $selectedWarehouses[] = $wid;
        }

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        // Удалить старые запасы
        $product->stocks()->delete();

        // Повторно вставьте новые запасы
        foreach ($request->stocks as $stockData) {
            if (!empty($stockData['warehouse_id']) && $stockData['stock'] > 0) {
                Stock::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $stockData['warehouse_id'],
                    'stock' => $stockData['stock'],
                ]);

                // Добавить запись движения
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $stockData['warehouse_id'],
                    'quantity' => $stockData['stock'],
                    'type' => 'update',
                    'reason' => "Обновление продукта #{$product->id}",
                ]);
            }
        }
        return back()->with('success', 'Продукт успешно обновлён.');
    }

    public function delete($id) {
        $product = Product::with('stocks')->findOrFail($id);
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'Нельзя удалить продукт, используемый в заказах.');
        }
        foreach ($product->stocks as $stock) {
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
