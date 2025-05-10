<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverterService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('EXCHANGE_RATE_API_KEY'); 
    }

    public function getConversionRate($fromCurrency, $toCurrency)
    {
        $response = Http::get("https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$fromCurrency}");

        if ($response->successful()) {
            $data = $response->json();
            return $data['conversion_rates'][$toCurrency] ?? null;
        }

        return null;
    }
}
