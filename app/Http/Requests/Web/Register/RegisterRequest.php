<?php

namespace App\Http\Requests\Web\Register;

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
            'country_id' => 'required|exists:countries,id',
            'phone' => 'required|regex:/^[0-9]+$/|unique:users,phone',
            'service' => 'required|in:vendor,buyer',
            'national_number' => 'nullable|regex:/^[0-9]+$/|unique:users,national_number',
            'image' => 'nullable|image',
            'category' => 'required|in:dealer,my',
            'password' => 'required|string|min:8|confirmed',
            'terms_and_conditions'=> 'required|boolean',
        ];
    }


}
