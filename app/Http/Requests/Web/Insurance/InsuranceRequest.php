<?php

namespace App\Http\Requests\Web\Insurance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
class InsuranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'balance' => 'required|numeric',
           'payment_method'=> 'nullable|string|in:card,wallet',
           'type' => 'nullable|in:web,app',
           'payment_type' => 'required|integer|exists:type_payments,id',
        ];
    }



}
