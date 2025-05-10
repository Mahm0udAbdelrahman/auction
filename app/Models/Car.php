<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'user_id',
        'car_type_id',
        'country_id',
        'name',
        'type',
        'model',
        'year',
        'color',
        'price',
        'description',
        'notes',
        'image',
        'status',
        'kilometer',
        'video',
        'deposit',
        'license_year',
        'image_license',
        'sold',
        'report'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }
    public function carImages()
    {
        return $this->hasMany(CarImage::class);
    }
    
     public function winner()
    {
        return $this->hasOneThrough(User::class, Auction::class, 'car_id', 'id', 'id', 'user_id');
    }
    
     public function auctions()
    {
        // return $this->hasMany(Auction::class);
            return $this->hasOne(Auction::class);

    }

    public function commitAuctions()
    {
        return $this->hasManyThrough(CommitAuction::class, Auction::class);
    }
    

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    // public function CommitAuctions()
    // {
    //     return $this->hasMany(CommitAuction::class);
    // }


public function scopeFilter($query, array $filters)
{
    $query->when($filters['color'] ?? null, fn($query, $color) => $query->where('color', $color));
    $query->when($filters['car_type_id'] ?? null, fn($query, $car_type_id) => $query->where('car_type_id', $car_type_id));
    $query->when($filters['kilometer'] ?? null, fn($query, $kilometer) => $query->where('kilometer', $kilometer));
    $query->when($filters['status'] ?? null, fn($query, $status) => $query->where('status', $status));
    $query->when($filters['model'] ?? null, fn($query, $model) => $query->where('model', $model));
    $query->when($filters['license_year'] ?? null, fn($query, $license_year) => $query->where('license_year', $license_year));

    $query->when(isset($filters['price_min']) || isset($filters['price_max']), function ($query) use ($filters) {
        $priceMin = $filters['price_min'] ?? null;
        $priceMax = $filters['price_max'] ?? null;

        if ($priceMin !== null && $priceMax !== null) {
            $query->whereBetween('price', [$priceMin, $priceMax]);
        } elseif ($priceMin !== null) {
            $query->where('price', '>=', $priceMin);
        } elseif ($priceMax !== null) {
            $query->where('price', '<=', $priceMax);
        }
    });
}



    public function scopePending($query) {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query) {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query) {
        return $query->where('status', 'rejected');
    }


protected $casts = [
        'image_license' => 'array',
    ];







}
