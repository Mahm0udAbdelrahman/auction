<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =
    [
        'question_ar',
        'question_en',
        'question_ru',
        'answer_ar',
        'answer_en',
        'answer_ru'
    ];

}
