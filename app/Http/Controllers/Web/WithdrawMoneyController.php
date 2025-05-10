<?php

namespace App\Http\Controllers\Web;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\WithdrawMoney;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\WithdrawMoneyService;
use App\Http\Requests\Api\WithdrawMoney\WithdrawMoneyRequest;

class WithdrawMoneyController extends Controller
{
    public function __construct(public WithdrawMoneyService $withdrawMoneyService){}
    public function index()
    {
        $insurance = Insurance::where('user_id',auth()->user()->id)->value('balance');
        $WithdrawMoney = WithdrawMoney::where('user_id', auth()->id())->where('status', 'pending')->exists();
        return view('web.pages.withdraw_money', compact('insurance','WithdrawMoney'));
    }


    public function store(WithdrawMoneyRequest $request)
    {
        $user = Auth::user();
        $withdrawMoney = $this->withdrawMoneyService->store($user, $request->validated());

        return redirect()->back()->with('success', 'Withdraw Money Successfully');
    }
}
