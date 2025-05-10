<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\WithdrawMoneyService;
use App\Http\Resources\WithdrawMoneyResource;
use App\Http\Requests\Api\WithdrawMoney\WithdrawMoneyRequest;


class WithdrawMoneyController extends Controller
{

    use HttpResponse;

    public function __construct(public WithdrawMoneyService $withdrawMoneyService){}

    public function index()
     {
         $limit = request()->get('limit', 10);
         $withdrawMoney = $this->withdrawMoneyService->index($limit);
         return $this->paginatedResponse($withdrawMoney, WithdrawMoneyResource::class);
     }

    public function store(WithdrawMoneyRequest $request): JsonResponse
    {
        $user = Auth::user();
        $withdrawMoney = $this->withdrawMoneyService->store($user, $request->validated());

        return $this->okResponse(WithdrawMoneyResource::make($withdrawMoney), __('Withdrawal request submitted successfully.', [], Request()->header('Accept-language')));
    }

    public function show($id): JsonResponse
    {
        $withdrawMoney = $this->withdrawMoneyService->show($id);

        return $this->okResponse(WithdrawMoneyResource::make($withdrawMoney), __('Withdrawal request submitted successfully.', [], Request()->header('Accept-language')));
    }
}
