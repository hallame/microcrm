<?php

namespace Database\Seeders;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $products = Product::all();
        $warehouses = Warehouse::all();

        foreach ($products as $product) {
            foreach ($warehouses as $warehouse) {
                Movement::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'quantity' => rand(1, 50),
                    'type' => collect(['add', 'remove', 'cancel', 'order'])->random(),
                    'reason' => 'Автоматически генерируемое движение'
                ]);
            }
        }
    }
}
