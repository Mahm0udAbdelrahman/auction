<?php

namespace App\Http\Requests\Dashboard\WithdrawMoney;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawMoneyRequest extends FormRequest
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
            'image'=> 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }
}
