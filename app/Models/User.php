<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // use HasFactory, Notifiable;
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable =
    [
        'name',
        'address',
        'phone',
        'national_number',
        'image',
        'service',
        'country_id',
        'category',
        'email',
        'password',
        'code',
        'verify',
        'auction',
        'active',
        'expire_at',
        'fcm_token',
        'terms_and_conditions',
        'email_verified_at',





    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function wonAuctions()
{
    return $this->hasMany(Auction::class, 'winner_id');
}


    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }

    public function commitAuctions()
    {
        return $this->hasMany(CommitAuction::class);
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function getIsVendorAttribute()
    {
        return $this->service === 'vendor';
    }

    public function getIsBuyerAttribute()
    {
        return $this->service === 'buyer';
    }

    public function getIsDealerAttribute()
    {
        return $this->category === 'dealer';
    }

    public function getIsMyAttribute()
    {
        return $this->category === 'my';
    }


}
