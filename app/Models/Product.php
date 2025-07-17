<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Продукт может иметь множество остатков на складах.
     */
    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    /**
     * Продукт может находиться в нескольких заказах.
     */
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function movements() {
        return $this->hasMany(Movement::class);
    }
}
