<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PrivacyPolicyService;
use App\Http\Resources\PrivacyPolicyResource;

class PrivacyPolicyController extends Controller
{
    use HttpResponse;
    public function __construct(public PrivacyPolicyService $privacyPolicyService){}

    public function show(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');
        $privacyPolicy = $this->privacyPolicyService->getPrivacyPolicyByLanguage($lang);

        // if (!$privacyPolicy) {
        //     return $this->errorResponse( __('Privacy policy not found.', [], Request()->header('Accept-language')));
        // }

        return $this->okResponse(PrivacyPolicyResource::make($privacyPolicy), __('Privacy Policy', [], Request()->header('Accept-language')));

    }

}
