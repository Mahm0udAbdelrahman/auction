<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'users-index','users-show','users-create','users-update','users-delete',
            'roles-index','roles-show','roles-create','roles-update','roles-delete',
            'vendors-index','vendors-show','vendors-create','vendors-update','vendors-delete',
            'buyers-index','buyers-show','buyers-create','buyers-update','buyers-delete',
            'notifications-index','notifications-show','notifications-create','notifications-update','notifications-delete',
            'privacy_policy-update',
            'send_notifications-index','send_notifications-show','send_notifications-create','send_notifications-update','send_notifications-delete',
            'cars-index','cars-show','cars-create','cars-update','cars-delete',
            'maintenance_centers-index','maintenance_centers-show','maintenance_centers-create','maintenance_centers-update','maintenance_centers-delete',
            'questions-index','questions-show','questions-create','questions-update','questions-delete',
            'auctions-index','auctions-show','auctions-create','auctions-update','auctions-delete',
            'countries-index','countries-show','countries-create','countries-update','countries-delete',
            'insurances-index','insurances-show','insurances-create','insurances-update','insurances-delete',
            'balance_insurances-index','balance_insurances-show','balance_insurances-create','balance_insurances-update','balance_insurances-delete',
            'withdraw_money-index','withdraw_money-show','withdraw_money-create','withdraw_money-update','withdraw_money-delete',
            'setting-update',
            'profile-update',
            'car_types-index','car_types-show','car_types-create','car_types-update','car_types-delete',
            'type_payment-index','type_payment-show','type_payment-create','type_payment-update','type_payment-delete',
            'feedback-index','feedback-show','feedback-create','feedback-update','feedback-delete',

            
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
