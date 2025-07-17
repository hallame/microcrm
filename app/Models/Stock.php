<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model {
    use HasFactory;
    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'stock',
    ];

    /**
     * Остаток связан с определённым товаром.
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }

    /**
     * Остаток связан с определённым складом.
     */
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

}
