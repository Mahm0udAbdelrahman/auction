<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\PasswordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Register\SendCodeRequest;
use App\Http\Requests\Web\Login\ResetPasswordRequest;
use Illuminate\Support\Facades\Session;


class PasswordController extends Controller
{
    public function __construct(public PasswordService $passwordService){}

    public function forgetPasswordView()
    {
      return  view('web.auth.forget-password');
    }


    public function forgetPassword(SendCodeRequest $sendCodeRequest)
    {
       $user = $this->passwordService->forgetPassword($sendCodeRequest->validated());
       session()->put('email', request('email'));
       return redirect()->route('web.otp_view');

    }

    public function OTPView()
    {
        return view('web.auth.otp_code');
    }

    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        $user = $this->passwordService->resetPassword($resetPasswordRequest->validated());
        Session::flash('message', ['type' => 'success', 'text' => __('Welcome Home!')]);
        return redirect()->route('web.home');

    }
}
