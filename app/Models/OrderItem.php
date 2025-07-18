<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderItem extends Model {
    use HasFactory;
    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'count',
    ];

    /**
     * Позиция относится к заказу.
     */
    public function order() {
        return $this->belongsTo(Order::class);
    }

    /**
     * Позиция ссылается на конкретный товар.
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }



}
