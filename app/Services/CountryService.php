<?php

namespace App\Services;

use App\Models\User;
use App\Models\Auction;
use App\Models\Country;
use App\Models\CommitCar;
use App\Models\Insurance;
use App\Events\AuctionEvent;
use App\Models\CommitAuction;
use Illuminate\Support\Facades\DB;
use App\Helpers\SendNotificationHelper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DBFireBaseNotification;
use App\Exceptions\InsuranceNotFoundException;

class CountryService
{
    public function __construct(public Country $country){}

    public function index(string $lang = 'en')
    {
        [$nameColumn] = $this->getLanguageColumns($lang);

        return $this->country
            ->select('id', "$nameColumn as name", 'created_at')
            ->get();
    }

    private function getLanguageColumns(string $lang): array
    {
        return match ($lang) {
            default => ['name_en'],
            'ru' => ['name_ru'],
            'ar' => ['name_ar'],
        };
    }
}
