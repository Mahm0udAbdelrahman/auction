<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContantUs extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
