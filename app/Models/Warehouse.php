<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Warehouse extends Model {
    use HasFactory;

    /**
     * Разрешённые к массовому заполнению поля.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Склад может содержать много остатков (товаров).
     */
    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    /**
     * Склад может быть связан с несколькими заказами.
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }
}


