<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OTPEmail;
use App\Traits\HasImage;
use App\Helpers\OTPHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\InsuranceNotFoundException;

class RegisterService
{
    use HasImage;
    public function __construct(public User $user)
    {}

    public function register($data)
    {

        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'user');
        } else {
            $data['image'] =  asset('default/default.png');
        }


        $data['password'] = Hash::make($data['password']);
        $data['code'] = rand(1000, 9999);
        $data['expire_at'] = Carbon::now()->addMinutes(5);


        //    OTPHelper::sendOtp($data['email'], $data['code']);
        Mail::to($data['email'])->send(new OTPEmail($data['code']));
        return $this->user->create($data);
    }



    public function verify($data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            throw new InsuranceNotFoundException(__('Email not registered', [], request()->header('Accept-language')), 400);

        }

        if ($user->email_verified_at) {
            throw new InsuranceNotFoundException(__('The user account has already been verified', [], request()->header('Accept-language')), 400);
        }

        if ($user->code !== $data['otp']) {
            throw new InsuranceNotFoundException(__('Wrong OTP code', [], request()->header('Accept-language')), 400);
        }

        if (Carbon::parse($user->expire_at)->lt(Carbon::now())) {
            throw new InsuranceNotFoundException(__('The OTP code has expired', [], request()->header('Accept-language')), 400);
        }

        $token = $user->createToken("API TOKEN")->plainTextToken;
        $user->update([
            'email_verified_at' => Carbon::now(),
            'active' => 1,
            'code' => null,
            'expire_at' => null
        ]);

        Auth::login($user);

        return[$user , $token];
    }

    public function otp($data)
    {
        $user = User::where('email', $data['email'])
                    ->whereNotNull('code')
                    ->whereNotNull('expire_at')
                    ->first();

        if ($user) {
            if (now()->greaterThan($user->expire_at)) {
                $newCode = rand(1000, 9999);
                $user->update([
                    'code' => $newCode,
                    'expire_at' => now()->addMinutes(5)
                ]);
            }
        }
    Mail::to($data['email'])->send(new OTPEmail($user->code));

        return $user;
    }




}
