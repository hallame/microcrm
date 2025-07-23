<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Console\Command;

class SeedData extends Command {


    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'seed:demo-data';

    // protected $signature = 'app:seed-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Наполнить справочники товарами, складами и остатками';

    /**
     * Execute the console command.
     */

    public function handle() {
        $this->info('Очистка таблиц...');
        Stock::truncate();
        Product::truncate();
        Warehouse::truncate();

        $this->info('Создание складов...');
        $warehouses = collect();
        foreach (range(1, 10) as $i) {
            $warehouses->push(Warehouse::create([
                'name' => 'Склад ' . $i,
            ]));
        }

        $this->info('Создание продуктов и остатков...');
        foreach (range(1, 10) as $i) {
            $product = Product::create([
                'name' => 'Продукт ' . $i,
                'price' => rand(100, 1000),
            ]);

            foreach ($warehouses as $warehouse) {
                Stock::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse->id,
                    'stock' => rand(0, 100),
                ]);
            }
        }

        $this->info('Данные успешно сгенерированы !');
        return Command::SUCCESS;
    }
}
