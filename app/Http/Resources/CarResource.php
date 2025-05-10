<?php

namespace App\Http\Resources;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\FormatTimeAgo;
use Illuminate\Support\Carbon;



class CarResource extends JsonResource
{
            use FormatTimeAgo;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        // $auction = $this->auctions; 
            $auction = Auction::where('car_id',$this->id)->first();

        return [
            "id"=> $this->id,
            'user_id' => $this->user_id,
            'user_name'=> $this->user->name,
            'user_service' => $this->user->service,
            'user_image' => $this->user->image,
            "name"=> $this->name,
            "car_type"=> $this->carType->{'name_' . app()->getLocale()},
            "country"=> $this->country->name_en,
            'model'=> $this->model,
            'color'=> $this->color,
            'kilometer'=> $this->kilometer,
            'price'=> $this->price,
            'license_year'=> $this->license_year,
            'description'=> $this->description,
            'image_license'=> $this->image_license,
            'images'=> $this->carImages->pluck('image'),
            'report'=> $this->report,
            'status' => $this->status,
            'sold'=> $this->sold,
            'auction_id' => $auction?->id,
            'created_at' =>  $this->formatTimeAgo($this->created_at),
            'week' => (int) Carbon::parse($this->created_at)->diffInWeeks(now()) + 1,

            'winner_name' => $auction?->winner?->name,
            'winner_phone' => $auction?->winner?->phone,
            // 'commit_auctions' => CommitAuctionResource::collection($auction->commitAuctions),
            'commit_auctions' => $auction?->commitAuctions->map(function ($commit) {
                return [
                    'id' => $commit->id,
                    'user_name' => $commit->user->name,
                    'user_image' => $commit->user->image,
                    'price' => $commit->price,
                    'created_at' => $this->formatTimeAgo($commit->created_at),
                ];
            }) ?? [],
        ];
    }
}
