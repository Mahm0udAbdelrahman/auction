<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypePaymentResource;
use App\Services\TypePaymentService;

class TypePaymentController extends Controller
{
    use HttpResponse;
    public function __construct(public TypePaymentService $typePaymentService){}

    public function index()
    {
        $typePayments = $this->typePaymentService->index();
        return $this->simpleResponse($typePayments, TypePaymentResource::class);

    }
}
