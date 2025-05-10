<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Services\ContactUsService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Http\Requests\Api\ContactUs\ContactUsRequest;

class ContactUsController extends Controller
{
    use HttpResponse;
    public function __construct(public ContactUsService $contactUsService){}

    public function store(ContactUsRequest $request)
    {
        $data = $request->validated();

        $contactUs = $this->contactUsService->store($data);

        return $this->okResponse(new ContactUsResource($contactUs), __('Sent feedback successfully.', [], request()->header('Accept-language')));
    }
}
