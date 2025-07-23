<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movement extends Model {
    use HasFactory;
    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'reason',
        'quantity',
        'type',
        'moved_at'
    ];

    /**
     * Движение связано с товаром.
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }
    /**
     * Движение связано со складом.
     */
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

}
