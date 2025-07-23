<?php

namespace App\Console\Commands;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Console\Command;

class SeedData extends Command {

    protected $signature = 'seed:test-data';
    protected $description = 'Генерация тестовых данных: склады, товары, остатки и движения';

    public function handle() {
        $this->info('Генерация складов...');
        $warehouses = collect();
        foreach (range(1, 5) as $i) {
            $warehouses->push(Warehouse::create([
                'name' => 'Склад ' . $i,
            ]));
        }

        $this->info('Генерация продуктов...');
        $products = collect();
        foreach (range(1, 10) as $i) {
            $products->push(Product::create([
                'name' => 'Товар ' . $i,
                'price' => rand(100, 1000),
            ]));
        }

        $this->info('Генерация остатков и движений...');
        foreach ($products as $product) {
            foreach ($warehouses as $warehouse) {
                $quantity = rand(5, 50);

                // Stock
                Stock::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'stock' => $quantity,
                ]);

                // Movement
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => $quantity,
                    'type' => 'create',
                    'reason' => 'Начальная загрузка',
                    'moved_at' => now(),
                ]);
            }
        }

        $this->info('✅ Данные успешно сгенерированы.');
    }
}
