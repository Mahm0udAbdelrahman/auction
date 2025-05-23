<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            'name' =>  $this->name,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'national_number' => $this->national_number,
            'country'=> $this->country->{'name_' . app()->getLocale()},
            'image' => $this->image,
            'service' => $this->service,
            'active' => $this->active,
            'category' => $this->category,
        ];
    }
}
