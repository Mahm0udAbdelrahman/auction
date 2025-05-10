<?php

namespace App\Http\Controllers\Web;

use App\Models\Auction;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeContoller extends Controller
{
    public function index()
    {
        $auctions = Auction::with(['user', 'car'])->pending()->latest()->take(3)->get();
        $setting = Setting::first();

        return view('web.index',compact('auctions', 'setting'));
    }
}
