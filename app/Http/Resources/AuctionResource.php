<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Traits\FormatTimeAgo;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;



class AuctionResource extends JsonResource
{
    use FormatTimeAgo;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_service' => $this->user->service,
            'user_image' => $this->user->image,
            'created_at' =>  $this->formatTimeAgo($this->created_at),
            'car_name' => $this->car->name,
            'car_color' => $this->car->color,
            'car_kilometer' => $this->car->kilometer,
            'car_license_year' => $this->car->license_year,
            'car_type' => $this->car->carType->{'name_'.request()->header('Accept-Language')} ??$this->car->carType->name_en ,
            'sold' => $this->car->sold,
            'country' => $this->car->country->name_en,
            'start_price' => $this->start_price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->car->description,
            'report' => $this->car->report,
            'images' => $this->car->carImages,
            // 'who_commit_auction' => $this->commitAuctions,
            'who_commit_auction' => CommitAuctionResource::collection($this->commitAuctions),
            'commit' => count($this->commitAuctions),
           'week' => (int) Carbon::parse($this->created_at)->diffInWeeks(now()) + 1,
            'status' => $this->status,





        ];
    }
}
