<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $balance = $request->input('balance');
        $user_id = $request->input('user_id');

        $insurance = Insurance::where('user_id', $user_id)->first();

        if ($insurance) {

            $insurance->update(['balance' => $balance, 'payment_status' => 'paid']);

        }
        
        $url = route('web.home');

      return view('payment.success', compact('insurance','url'));
    }
    

    public function cancel()
    {
        return view('payment.cancel'); 
    }
}
