<?php

namespace App\Http\Controllers\Web;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Http\Requests\Web\Register\CodeRequest;
use App\Http\Requests\Web\Register\RegisterRequest;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    public function __construct(public RegisterService $registerService)
    {}
    public function showForm()
    {
        $countries = Country::all();
        return view('web.auth.register',compact('countries'));
    }



    public function register(RegisterRequest $request)
    {

        $data = $this->registerService->register($request->validated());
        session()->put('email', request('email'));
        Session::flash('message', ['type' => 'success', 'text' => __('Check your email for verification code')]);

        return redirect()->route('web.register_otp');
    }

    public function otp()
    {
        return view('web.auth.otp');
    }
    public function verify(CodeRequest $codeRequest)
    {
        [$user, $token] = $this->registerService->verify($codeRequest->validated());
        Session::flash('message', ['type' => 'success', 'text' => __('Welcome Home!')]);
        return redirect()->route('web.home');
    }

}
