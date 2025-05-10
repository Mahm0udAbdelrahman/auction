<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMoney extends Model
{
    protected $fillable =
    [
        'money',
        'phone',
        'user_id',
        'status',
        'image'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
