<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceInsurance extends Model
{
    protected $fillable = [
        'service',
        'category',
        'min_balance',
        'country_id',
        'currency'
    ];
    
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
