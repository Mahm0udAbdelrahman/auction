<?php
namespace App\Services;

use App\Models\Auction;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class MyAuctionService
{
    public function __construct(public Car $car){}
    // public function getMyAuction($data,$limit)
    // {
    //     return $this->car->where('user_id', Auth::user()->id)->filter($data)->latest()->paginate($limit);
    //     // return $this->auction->where('user_id', Auth::user()->id)->with(['user', 'car'])->filter($data)
    //     // ->whereHas('car', function ($query) use ($data) {
    //     //     $query->filter($data);
    //     // })->latest()->paginate($limit);
    // }
    
     public function getMyAuction($data, $limit)
    {
        $cars = $this->car->where('user_id', Auth::id())
            ->filter($data)
            ->latest()
            ->paginate($limit);

        $cars->getCollection()->transform(function ($car) {
            $auction         = Auction::where('car_id', $car->id)->first();
            $car->auction_id = $auction ? $auction->id : null;
            return $car;
        });

        return $cars;

    }

}
