<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $fillable =
    [
        'message_ar',
        'message_ru',
        'message_en',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
