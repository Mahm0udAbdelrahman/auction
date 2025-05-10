<?php

namespace App\Http\Resources;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BalanceInsuranceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user();
        
        if (!$user) {
            return [
                'service' => $this->service,
                'category' => $this->category,
                'min_balance' => $this->min_balance,
                'currency' => $this->currency,
                'is_paid' => 0,
                'balance' => null,
            ];
        }

        $insurance = Insurance::where('user_id', $user->id)->first();

        return [
            'service' => $this->service,
            'category' => $this->category,
           'currency' => $this->currency,
            'min_balance' => $this->min_balance,
            
            'is_paid' => ($insurance && ($insurance->balance !== null && $insurance->balance > 0)) ? 1 : 0,
            'balance' => $insurance?->balance,
        ];
    }
}
