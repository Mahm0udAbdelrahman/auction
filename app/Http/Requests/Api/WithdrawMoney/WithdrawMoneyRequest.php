<?php

namespace App\Http\Requests\Api\WithdrawMoney;

use App\Models\Insurance;
// use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\InsuranceNotFoundException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class WithdrawMoneyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'money' => ['required', 'numeric', 'min:1'],
            'phone' => ['required', 'string'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $user = auth()->user();
            if($user->service !== 'vendor')
            {
                throw new InsuranceNotFoundException(__('No authorize available', [], Request()->header('Accept-language')), 400);
            }
            $insurance = Insurance::where('user_id', $user->id)->where('payment_status','paid')->first();

            if (!$insurance) {
                throw new InsuranceNotFoundException(__('No balance available.', [], Request()->header('Accept-language')), 400);

                return;
            }

            if ($this->money > $insurance->balance) {
                throw new InsuranceNotFoundException(__('The requested amount exceeds your available balance.', [], Request()->header('Accept-language')), 400);

            }
        });
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->first(),
                'type' => 'error',
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
