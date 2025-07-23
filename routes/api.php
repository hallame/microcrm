<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovementApiController;

// MOVEMENTS API CONTROLLER
Route::get('/movements', [MovementApiController::class, 'index'])->name('api.movements');
