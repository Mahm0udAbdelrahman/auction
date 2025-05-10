<?php

use Illuminate\Database\Eloquent\BroadcastsEventsAfterCommit;
use Pusher\Pusher;
use App\Events\MyEvent;
use App\Events\AuctionEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CarController;
use App\Http\Controllers\Web\HomeContoller;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\FaqsController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Web\AuctionController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\PasswordController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\InsuranceController;
use App\Http\Controllers\Web\MyAuctionController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\CommitAuctionController;
use App\Http\Controllers\Web\PrivacyPolicyController;
use App\Http\Controllers\Web\WithdrawMoneyController;
use App\Http\Controllers\Web\MaintenanceCenterController;
use App\Http\Controllers\Web\ContactUsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('test', function () {
    MyEvent::dispatch('asadas');
    // event(new MyEvent('hello world'));
    return view('test');
});

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::group(['middleware' => ['not_admin']], function () {
            Route::get('/', function () {
                return redirect()->route('web.home');
            })->middleware('guest');
            //Home
            Route::get('/web/home', [HomeContoller::class, 'index'])->name('web.home');
            //Terms
            Route::get('/web/terms', [PrivacyPolicyController::class, 'show'])->name('web.terms');
            Route::get('/web/terms_condition', [PrivacyPolicyController::class, 'showTerms'])->name('web.terms_condition');
            Route::get('/web/return_policy', [PrivacyPolicyController::class, 'show_return_policy'])->name('web.return_policy');
            //Faqs
            Route::get('/web/faqs', [FaqsController::class, 'index'])->name('web.faqs');
            //Auction
            Route::get('/web/autions', [AuctionController::class, 'index'])->name('web.autions');
            Route::get('/web/aution_details/{id}', [AuctionController::class, 'show'])->middleware('notification')->name('web.aution_details');

            //Register
            Route::get('web/register', [RegisterController::class, 'showForm'])->name('web.register.form');
            Route::post('web/register/store', [RegisterController::class, 'register'])->name('web.register_store');
            Route::get('web/register/otp', [RegisterController::class, 'otp'])->name('web.register_otp');
            Route::post('/verify', [RegisterController::class, 'verify'])->name('web.verify');

            //Password
            Route::get('web/forget-password', [PasswordController::class, 'forgetPasswordView'])->name('web.forget_password');
            Route::post('web/forgetPassword', [PasswordController::class, 'forgetPassword'])->name('web.forgetPassword');
            Route::get('web/reset_password', [PasswordController::class, 'OTPView'])->name('web.otp_view');
            Route::post('web/otp_code', [PasswordController::class, 'resetPassword'])->name('web.reset_password');

            //Filter
            Route::get('/cars/filter', [AuctionController::class, 'filter'])->name('cars.filter');
            //Login
            Route::get('/web/login', [AuthController::class, 'login'])->name('web.loginView')->middleware('guest');
            Route::post('/web/login', [AuthController::class, 'loginAction'])->name('web.login')->middleware('guest');
            Route::get('/web/MaintenanceCenter', [MaintenanceCenterController::class, 'index'])->name('web.maintenance_center');
            //notification
            Route::get('web/notifications', [NotificationController::class, 'index'])->middleware('notification')->name('web.notifications');
        });

        Route::group(['middleware' => ['web_auth', 'notification', 'not_admin'], 'prefix' => 'web', 'as' => 'web.'], function () {
            //Logout
            Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
            //Profile
            Route::get('/profile/my', [ProfileController::class, 'profile'])->name('profile.my');
            Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

            //Auction
            Route::post('/commit_update_status/{id}', [AuctionController::class, 'UpdateStatusAuction'])->name('commit_update_status');
            Route::get('/finish_auction/{id}', [AuctionController::class, 'finishAuction'])->name('finish_auction');
            //My Auction
            Route::get('/my_autions', [MyAuctionController::class, 'getMyAuction'])->name('my_autions');
            //Commit Auction
            Route::get('/my_commit_autions', [CommitAuctionController::class, 'getMyCommitAuctions'])->name('my_commit_autions');
            Route::post('/commit_auction/{id}', [CommitAuctionController::class, 'commitAuction'])->name('commit_auction');
            //insurance
            Route::get('/insurance', [InsuranceController::class, 'index'])->name('insurance');
            Route::post('/insurance/store', [InsuranceController::class, 'store'])->name('store_insurance');
            //car
            Route::get('cars', [CarController::class, 'index'])->name('cars_index');
            Route::post('car/create', [CarController::class, 'store'])->name('cars');
            //feedback
            Route::get('feedback', [ContactUsController::class, 'create'])->name('feddback.create');
            Route::post('feedback', [ContactUsController::class, 'store'])->name('feddback.store');

            //withdraw_money
            Route::get('withdraw_money', [WithdrawMoneyController::class, 'index'])->name('withdraw_money');
            Route::post('withdraw_money/store', [WithdrawMoneyController::class, 'store'])->name('withdraw_money_store');
        });
    }
);

Route::get('/callback', [InsuranceController::class, 'callback']);

require __DIR__ . '/dashboard.php';
