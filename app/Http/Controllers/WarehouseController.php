<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller {
    public function index() {
        return Warehouse::all();
    }
}
