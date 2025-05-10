<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'description_ar',
        'description_en',
        'description_ru',
        'country_id',
        'phone',
        'email',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'whatsapp',
        'telegram',
        'key',
        'value',
        'type',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
