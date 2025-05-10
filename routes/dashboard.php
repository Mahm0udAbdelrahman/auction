<?php

use App\Http\Controllers\Dashboard\ReturnPolicyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    AuthController,
    HomeController,
    UserController,
    RoleController,
    NotificationController,

    CountryController,
    SendNotificationController,
    MaintenanceCenterController,
    QuestionController,
    CarController,
    AuctionController,
    InsuranceController,
    BalanceInsuranceController,
    WithdrawMoneyController,
    SettingController,
    CarTypeController,
    TypePaymentController,
    ContactUsController,
    PrivacyPolicyController,
    TermsAndConditionController
};
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
        Route::post('/admin/login', [AuthController::class, 'loginAction'])->name('loginAction');

        Route::group(['middleware' => ['auth', 'notification', 'admin'], 'prefix' => 'admin', 'as' => 'Admin.'], function () {
            // home
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::get('/delete/{model}/{id}', [HomeController::class, 'confirmDelete'])->name('confirmDelete');
            Route::post('/products-orders-year/{year}', [HomeController::class, 'getByYear'])->name('getByYear');


            // notifications

            Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications');
            Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
            Route::get('/notifications/read-all', [NotificationController::class, 'ReadAll'])->name('notifications.markAllRead');
            Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');


            Route::resource('send_notifications', SendNotificationController::class);


            // roles
            Route::resource('roles', RoleController::class);

            // users
            Route::resource('users', UserController::class);
            Route::get('get_users_buyer_a', [UserController::class, 'getBuyerA'])->name('get_users_buyer_a');
            Route::get('get_users_buyer_b', [UserController::class, 'getBuyerB'])->name('get_users_buyer_b');
            Route::get('get_users_buyer_c', [UserController::class, 'getBuyerC'])->name('get_users_buyer_c');
            Route::get('get_users_vendor_a', [UserController::class, 'getVendorA'])->name('get_users_vendor_a');
            Route::get('get_users_vendor_b', [UserController::class, 'getVendorB'])->name('get_users_vendor_b');
            Route::get('get_users_vendor_c', [UserController::class, 'getVendorC'])->name('get_users_vendor_c');
            Route::get('/profile', [UserController::class, 'profile'])->name('profile');
            Route::put('/profile', [UserController::class, 'updateProfile'])->name('updateProfile');
            Route::get('/get_users', [UserController::class, 'dataTable'])->name('getUsers');



            // questions
            Route::resource('questions', QuestionController::class);

            //Insurances
            Route::resource('insurances', InsuranceController::class);

            // car_types
            Route::resource('car_types', CarTypeController::class);
            // cars
            Route::resource('cars', CarController::class);

            // type payment
            Route::resource('type_payment', TypePaymentController::class);


            //countries
            Route::resource('countries', CountryController::class);

            //Balance Insurance
            Route::resource('balance_insurances', BalanceInsuranceController::class);


            // Maintenance Center
            Route::resource('maintenance_centers', MaintenanceCenterController::class);


            // Withdraw Money
            Route::resource('withdraw_money', WithdrawMoneyController::class);

            //feedback
            Route::resource('feedback', ContactUsController::class);

            //auctions
            Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
            Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auctions.show');
            Route::post('/auctions/{id}', [AuctionController::class, 'update'])->name('auctions.update');
            Route::delete('/auctions/{id}', [AuctionController::class, 'destroy'])->name('auctions.destroy');



            // privacy_policy
            Route::resource('privacy_policy', PrivacyPolicyController::class);

            //return_policy
            Route::resource('return_policy', ReturnPolicyController::class);

            //terms_condition
            Route::resource('terms_condition', TermsAndConditionController::class);


            //Route::resource('privacy_policy', PrivacyPolicyController::class);
            // Route::put('privacy_policy/update', [PrivacyPolicyController::class, 'update'])->name('privacy_policy.update');

            //setting
            Route::get('setting/show', [SettingController::class, 'show'])->name('setting.show');
            Route::put('setting/update', [SettingController::class, 'update'])->name('setting.update');

            //return_policy
            // Route::get('return_policy/show', [ReturnPolicyController::class, 'show'])->name('return_policy.show');
            // Route::put('return_policy/update', [ReturnPolicyController::class, 'update'])->name('return_policy.update');

            // logout
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        });
    }
);

    // Route::get('/get-governorates/{countryId}', function ($countryId) {
    //     $governorates = Governorate::where('country_id', $countryId)->get();
    //     return response()->json($governorates);
    // });


// solve wallet iframe with package => done
// solve wallet id , response method and callback or response with package with intention!! => done
// reomve from package file => done

// order => one provider or many ?! if many solve shipping ?! => done
// dashboard manage orders status, delivery and dropshipping. => in progress

// carts => every cart has product and total so this is one provider of the first cart => done
//       => in dashboard order profile manage this view and every provider has its own from this order. => done

// dashboard users crud => done
// dashboard roles crud => done
// dashboard categories crud => done
// dashboard shipping crud => done
// dashboard orders crud => in progress