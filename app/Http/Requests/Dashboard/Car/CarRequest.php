<?php

namespace App\Http\Requests\Dashboard\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'name'=> 'required|string|max:255',
            'car_type_id' => 'required|exists:car_types,id',
            'country_id' => 'required|exists:countries,id',
            'model'=> 'required|string|max:255',
            'color'=> 'required|string|max:255',
            'kilometer'=> 'required|string|max:255',
            'price'=> 'required|string|max:255',
            'license_year' => 'required|string|max:255',
            'description'=> 'required|string|max:1000',
            'image_license'=> 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            'images'=> 'nullable|array',
            'images.*'=> 'nullable|image',
            'report' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }
}
