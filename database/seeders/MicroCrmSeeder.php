<?php

namespace Database\Seeders;

use App\Models\Movement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MicroCrmSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // 1. Создаем склады
        $warehouses = Warehouse::factory()->count(10)->create();
        // 2. Создаем продукты
        $products = Product::factory()->count(100)->create();

        // 3. Заполняем остатки (stocks)
        foreach ($warehouses as $warehouse) {
            foreach ($products as $product) {
                Stock::create([
                    'warehouse_id' => $warehouse->id,
                    'product_id' => $product->id,
                    'stock' => rand(10, 100)
                ]);
            }
        }

        // 4. Создаем несколько заказов
        for ($i = 0; $i < 205; $i++) {
            $warehouse = $warehouses->random();

            $order = Order::create([
                'customer' => 'Клиент ' . Str::random(5),
                'warehouse_id' => $warehouse->id,
                'status' => collect(['active', 'canceled', 'completed'])->random(),
                'created_at' => now(),
            ]);

            // 2–3 позиции в заказе
            $selectedProducts = $products->random(rand(2, 3));

            foreach ($selectedProducts as $product) {
                $count = rand(1, 5);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'count' => $count
                ]);

                // Обновляем складской остаток
                $stock = Stock::where('warehouse_id', $warehouse->id)
                              ->where('product_id', $product->id)
                              ->first();

                if ($stock) {
                    $stock->stock -= $count;
                    $stock->save();
                }
            }
        }

        //
        $products = Product::all();
        $warehouses = Warehouse::all();

        foreach ($products as $product) {
            foreach ($warehouses as $warehouse) {
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => rand(1, 50),
                    'type' => collect(['order', 'create', 'cancel', 'update', 'reactivate', 'complete', 'delete'])->random(),
                    'reason' => 'Автоматически генерируемое движение'
                ]);
            }
        }
    }
}
