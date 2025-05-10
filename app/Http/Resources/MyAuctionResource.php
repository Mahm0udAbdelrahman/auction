<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->auction->car->user->name,
            'user_service' => $this->auction->car->user->service,
            'user_image' => $this->auction->car->user->image,
            'car_name' => $this->auction->car->name,
            'car_color' => $this->auction->car->color,
            'car_kilometer' => $this->auction->car->kilometer,
            'car_license_year' => $this->auction->car->license_year,
            'car_type' => $this->auction->car->carType->{'name_'.request()->header('Accept-Language')} ?? $this->auction->car->carType->name_en ,
            'report' => $this->auction->car->report,
            'description' => $this->auction->car->description,
            'end_date' => $this->auction->end_date,
            'price' => $this->price,
            'status' => $this->auction->status,
            'commit' => count($this->auction->commitAuctions),
            'phone_winner' => $this->auction->status === 'won' ? $this->auction->winner->phone : null,
            'created_at' => $this->auction->created_at,
            'images' => $this->auction->car->carImages
            
            
        ];
    }
}
