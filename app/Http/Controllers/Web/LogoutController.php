<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\LogoutService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    public function logout()
    {
        Auth::logout();
        return redirect()->route('web.home');
    }
}
