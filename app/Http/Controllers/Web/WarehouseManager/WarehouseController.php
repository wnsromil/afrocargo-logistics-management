<?php

namespace App\Http\Controllers\Web\WarehouseManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //
    public function index()
    {
        return view('warehouse-manager.warehouse.index');
    }
}
