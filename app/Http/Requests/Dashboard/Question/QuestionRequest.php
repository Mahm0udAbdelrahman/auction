<?php

namespace App\Http\Requests\Dashboard\Question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'question_ru' => 'required|string|max:255',
            'answer_ar' => 'required|string|max:1000',
            'answer_en' => 'required|string|max:1000',
            'answer_ru' => 'required|string|max:1000',
        ];
    }
}
