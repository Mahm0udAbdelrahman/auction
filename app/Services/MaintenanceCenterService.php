<?php

namespace App\Services;

use App\Models\MaintenanceCenter;

class MaintenanceCenterService
{
        public function __construct(public MaintenanceCenter $maintenanceCenter) {}

    public function index(string $lang = 'en',$limit = 10)
    {
        [$nameColumn, $addressColumn] = $this->getLanguageColumns($lang);

        return $this->maintenanceCenter
            ->select('id', "$nameColumn as name", "$addressColumn as address", 'phone','created_at')
            ->paginate($limit);
    }

    public function show(int $id, string $lang = 'en')
    {
        [$nameColumn, $addressColumn] = $this->getLanguageColumns($lang);

        return $this->maintenanceCenter
            ->select('id', "$nameColumn as name", "$addressColumn as address", 'created_at')
            ->findOrFail($id);
    }

    private function getLanguageColumns(string $lang): array
    {
        return match ($lang) {
            default => ['name_en', 'address_en'],
            'ru' => ['name_ru', 'address_ru'],
            'ar' => ['name_ar', 'address_ar'],
        };
    }
}
