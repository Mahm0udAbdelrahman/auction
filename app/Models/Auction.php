<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use SoftDeletes;
    protected $fillable =
    [
        'user_id',
        'car_id',
        'start_price',
        'start_date',
        'end_date',
        'winner_id',
        'winner_price',
        'winner_date',
        'status',
        'created_at',
        'updated_at'
    ];


    protected $casts = [
        'winner_date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopePending($query) {
        return $query->where('status', 'pending');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function commitAuctions()
    {
        return $this->hasMany(CommitAuction::class)->latest();
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id','id');
    }


public function scopeFilterAuctionDate($query, $auctionDate)
{
    $startDate = self::orderBy('created_at', 'asc')->value('created_at');

    if (!$startDate) {
        return $query;
    }

    switch ($auctionDate) {
        case 'first_week':
            case 1:
            $query->whereBetween('created_at', [
                $startDate->copy()->startOfWeek(),
                $startDate->copy()->endOfWeek()
            ]);
            break;

        case 'second_week':
            case 2:
            $query->whereBetween('created_at', [
                $startDate->copy()->addWeek()->startOfWeek(),
                $startDate->copy()->addWeek()->endOfWeek()
            ]);
            break;

        case 'third_week':
            case 3:
            $query->whereBetween('created_at', [
                $startDate->copy()->addWeeks(2)->startOfWeek(),
                $startDate->copy()->addWeeks(2)->endOfWeek()
            ]);
            break;

        case 'last_month':
            case 4:
            $query->whereBetween('created_at', [
                $startDate->copy()->addWeeks(3)->startOfWeek(),
                $startDate->copy()->addWeeks(3)->endOfWeek()
            ]);
            break;
    }

    return $query;
}

public function scopeFilter($query, array $filters)
{
    
    $query->when($filters['auction_date'] ?? null, function ($query, $auctionDate) {
        $query->filterAuctionDate($auctionDate);
    });

}



    public function scopeSort($query, array $sorts)
    {
        $sorts = $sorts['sort'] ?? 'id';
        $order = $sorts['order'] ?? 'asc';

        $query->when($sorts, fn($query, $sorts) => $query->orderBy($sorts, $order));
    }

    public function scopeStatus($query, $status)
    {
        $query->when($status, fn($query, $status) => $query->where('status', $status));
    }


}
