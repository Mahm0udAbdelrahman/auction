<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\MaintenanceCenter;
use App\Http\Controllers\Controller;

class MaintenanceCenterController extends Controller
{
    public function index()
    {
        $maintenance_centers = MaintenanceCenter::all();
        return view('web.pages.maintenance_centers',compact('maintenance_centers'));
    }
}
