<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

// DASHBOARD CONTROLLER
Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/clients', [DashboardController::class, 'clients'])->name('admin.clients');


// WAREHOUSE CONTROLLER
Route::get('/admin/warehouses', [WarehouseController::class, 'index'])->name('admin.warehouses');
Route::post('/admin/warehouses/add', [WarehouseController::class, 'add'])->name('admin.warehouse.add');
Route::delete('/admin/warehouses/delete/{id}', [WarehouseController::class, 'delete'])->name('admin.warehouse.delete');
Route::put('/admin/warehouses/update/{id}', [WarehouseController::class, 'update'])->name('admin.warehouse.update');


// PRODUCTS CONTROLLER
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
Route::post('/admin/products/add', [ProductController::class, 'add'])->name('admin.product.add');
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');




// ORDERS CONTROLLER
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/add/form', [OrderController::class, 'addForm'])->name('admin.order.add.form');
Route::post('/admin/orders/add', [OrderController::class, 'add'])->name('admin.order.add');
Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('admin.order.update');


Route::delete('/admin/orders/delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
Route::post('/admin/orders/{order}/complete', [OrderController::class, 'complete']);
Route::post('/admin/orders/{order}/cancel', [OrderController::class, 'cancel']);
Route::post('/admin/orders/{order}/resume', [OrderController::class, 'resume']);
