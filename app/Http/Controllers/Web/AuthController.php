<?php
namespace App\Http\Controllers\Web;

use App\Services\LoginService;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Web\Login\LoginRequest;

class AuthController extends Controller
{
    public function __construct(public LoginService $loginService)
    {}

    public function login()
    {
        return view('web.auth.login');
    }

    public function loginAction(LoginRequest $loginRequest)
    {
        if (Auth::attempt($loginRequest->validated())) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                Auth::logout();
                Session::flash('message', ['type' => 'error', 'text' => __('Admins cannot log in here!')]);
                return redirect()->back();
            }
            if ($user->email_verified_at === null) {
            Auth::logout();
            Session::flash('message', ['type' => 'error', 'text' => __('Account not activated!')]);
            return redirect()->back();
        }

            if ($user->service == 'vendor' || $user->service == 'buyer') {
                Session::flash('message', ['type' => 'success', 'text' => __('Welcome Home!')]);
                return redirect()->route('web.home');
            }

            Auth::logout();
            Session::flash('message', ['type' => 'error', 'text' => __('There are no invalid credentials!')]);
            return redirect()->back();
        }

        Session::flash('message', ['type' => 'error', 'text' => __('The data is incorrect!')]);
        return redirect()->back();
    }

}
