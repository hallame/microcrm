<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model {
    use HasFactory;

    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'customer',
        'warehouse_id',
        'status',
        'created_at',
        'completed_at',
    ];

    /**
     * Заказ содержит множество позиций (товаров).
     */
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Заказ связан с конкретным складом.
     */
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
