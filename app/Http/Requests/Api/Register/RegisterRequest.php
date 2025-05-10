<?php

namespace App\Http\Requests\Api\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone'=> 'required|string|unique:users,phone',
            'service' => 'required|in:vendor,buyer',
            'country_id' => 'required|exists:countries,id',
            // 'national_number' => 'required_if:service,vendor|string|unique:users,national_number',
            'national_number' => 'nullable|string|unique:users,national_number',
            'image' => 'nullable|image',
            'category' => 'required|in:dealer,my',
            'password' => 'required|string|min:8|confirmed',
            'terms_and_conditions'=> 'required|boolean',
            'fcm_token'=> 'required|string'

        ];
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
    // 'errors' => $validator->errors(),
}
