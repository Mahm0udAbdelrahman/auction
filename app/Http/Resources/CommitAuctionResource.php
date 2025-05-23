<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\FormatTimeAgo;


class CommitAuctionResource extends JsonResource
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
            'car_name' => $this->auction->car->name,
            'price' => $this->price,
            // 'commit' => $this->commit ?? null,
            'created_at' =>  $this->formatTimeAgo($this->created_at),
        ];
    }
}
