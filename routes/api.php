<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovementApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\WarehouseApiController;

Route::get('/movements', [MovementApiController::class, 'index']);
