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
Route::post('/admin/warehouse-add', [WarehouseController::class, 'add'])->name('admin.warehouse.add');
// Route::post('/admin/warehouse/status-update/{id}', [WarehouseController::class, 'updateStatus']);
Route::delete('/admin/warehouse-delete/{id}', [WarehouseController::class, 'delete'])->name('admin.warehouse.delete');


// WAREHOUSE CONTROLLER
Route::get('/admin/movements', [WarehouseController::class, 'movements'])->name('admin.movements');


// PRODUCTS CONTROLLER
Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');

Route::get('/products/stocks', [ProductController::class, 'stocks']);

// ORDERS CONTROLLER
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
Route::put('/admin/orders/{order}', [OrderController::class, 'update']);
Route::post('/admin/orders/{order}/complete', [OrderController::class, 'complete']);
Route::post('/admin/orders/{order}/cancel', [OrderController::class, 'cancel']);
Route::post('/admin/orders/{order}/resume', [OrderController::class, 'resume']);

