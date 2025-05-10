<?php
namespace App\Services;

use App\Models\TypePayment;


class TypePaymentService
{
    public function index()
    {
        return TypePayment::all();
    }
}
