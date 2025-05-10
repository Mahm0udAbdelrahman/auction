<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
        public function __construct(public Question $question) {}

    public function index(string $lang = 'en' , $limit= null)
    {
        [$questionColumn, $answerColumn] = $this->getLanguageColumns($lang);

        return $this->question
            ->select('id', "$questionColumn as question", "$answerColumn as answer", 'created_at')
            ->paginate($limit);
    }

    public function show(int $id, string $lang = 'en')
    {
        [$questionColumn, $answerColumn] = $this->getLanguageColumns($lang);

        return $this->question
            ->select('id', "$questionColumn as question", "$answerColumn as answer", 'created_at')
            ->findOrFail($id);
    }

    private function getLanguageColumns(string $lang): array
    {
        return match ($lang) {
            default => ['question_en', 'answer_en'],
            'ru' => ['question_ru', 'answer_ru'],
            'ar' => ['question_ar', 'answer_ar'],
        };
    }
}
