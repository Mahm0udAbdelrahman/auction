<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ContactUsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Api\ContactUs\ContactUsRequest;

class ContactUsController extends Controller
{
    public function __construct(public ContactUsService $contactUsService){}
    public function create()
    {
        return view('web.pages.contact_us');

    }

    public function store(ContactUsRequest $request)
    {
        $data = $request->validated();

        $contactUs = $this->contactUsService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Sent feedback successfully.')]);

        return redirect()->back()->with('success', __('Sent feedback successfully.', [], request()->header('Accept-language')));

    }


}
