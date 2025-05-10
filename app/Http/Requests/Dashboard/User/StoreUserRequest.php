<?php
namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'country_id'      => 'required|exists:countries,id',
            'email'           => ['required', 'email', Rule::unique('users')->whereNull('deleted_at')],
            'phone'           => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            'password'        => 'required|string|min:8',
            'service'         => ['nullable', 'in:vendor,buyer'],
            'national_number' => [
               'nullable',
                'string',
                'regex:/^[0-9]+$/',
                "unique:users,national_number,{$this->id},id,deleted_at,NULL",
            ],
            'category'        => ['nullable', 'in:dealer,my'],
            'role_id'         => ['nullable', 'exists:roles,id'],
            'image'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }

}
