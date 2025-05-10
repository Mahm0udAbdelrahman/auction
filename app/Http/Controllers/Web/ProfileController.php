<?php
namespace App\Http\Controllers\Web;

use App\Services\ProfileService;
// use App\Http\Requests\Web\Login\ProfileRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Login\ProfileRequest;

class ProfileController extends Controller
{

    public function __construct(public ProfileService $profileService)
    {}
    public function profile()
    {
        $user = $this->profileService->profile();
        return view('web.auth.profile');


    }

    public function updateProfile(ProfileRequest $profileRequest)
    {
        $user = $this->profileService->updateProfile($profileRequest->validated());
        return back();
    }
}
