<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BalanceInsuranceService;
use App\Http\Resources\BalanceInsuranceResource;

class BalanceInsuranceController extends Controller
{
    use HttpResponse;
    public function __construct(public BalanceInsuranceService $balanceInsurance){}


    public function index()
    {
        $balanceInsurance = $this->balanceInsurance->index();
        return $this->okResponse(new BalanceInsuranceResource($balanceInsurance), __('balance Insurance  successfully', [], request()->header('Accept-language')));
    }

}
