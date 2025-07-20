<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

// DASHBOARD CONTROLLER
Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

// WAREHOUSE CONTROLLER
Route::get('/admin/warehouses', [WarehouseController::class, 'index'])->name('admin.warehouses');
Route::post('/admin/warehouses/add', [WarehouseController::class, 'add'])->name('admin.warehouse.add');
Route::delete('/admin/warehouses/delete/{id}', [WarehouseController::class, 'delete'])->name('admin.warehouse.delete');
Route::put('/admin/warehouses/update/{id}', [WarehouseController::class, 'update'])->name('admin.warehouse.update');

// PRODUCTS CONTROLLER
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
Route::get('/admin/products/add/form', [ProductController::class, 'addForm'])->name('admin.product.add.form');
Route::post('/admin/products/add', [ProductController::class, 'add'])->name('admin.product.add');
Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');

// ORDERS CONTROLLER
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/add/form', [OrderController::class, 'addForm'])->name('admin.order.add.form');
Route::post('/admin/orders/add', [OrderController::class, 'add'])->name('admin.order.add');
Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
Route::put('/admin/orders/{id}/update', [OrderController::class, 'update'])->name('admin.order.update');
Route::post('/admin/orders/{id}/complete', [OrderController::class, 'complete'])->name('admin.order.complete');
Route::post('/admin/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.order.cancel');
Route::post('/admin/orders/{id}/reactivate', [OrderController::class, 'reactivate'])->name('admin.order.reactivate');
