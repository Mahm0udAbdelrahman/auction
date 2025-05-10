<?php
namespace App\Services;

use App\Models\BalanceInsurance;


class BalanceInsuranceService
{
    public function __construct(public BalanceInsurance $balanceInsurance){}

    public function index()
    {
        return $this->balanceInsurance->where('category',auth()->user()->category)->where('service',auth()->user()->service)->where('country_id',auth()->user()->country_id)->first();
    }
}
