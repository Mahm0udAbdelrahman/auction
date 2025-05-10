<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnPolicye extends Model
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
