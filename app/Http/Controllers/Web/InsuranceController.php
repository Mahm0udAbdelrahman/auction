<?php

namespace App\Http\Controllers\Web;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Services\InsuranceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TypePayment;
use App\Http\Requests\Web\Insurance\InsuranceRequest;

class InsuranceController extends Controller
{
    public function __construct(public InsuranceService $insuranceService){}

    public function index()
    {
        $balance = Insurance::where('user_id',Auth::user()->id)->value('balance');
        $paymet_types = TypePayment::all();
        return view('web.pages.insurance',compact('balance','paymet_types'));
    }

    public function store(InsuranceRequest $insuranceRequest)
    {
        $insuranceRequest['payment_method'] = 'card';
        $data=$insuranceRequest->validated();
        $data['type']='web';
        $response = $this->insuranceService->store($data);

        if (isset($response['redirect_url'])) {
            return redirect()->away($response['redirect_url']);
        }
    }

   

}
