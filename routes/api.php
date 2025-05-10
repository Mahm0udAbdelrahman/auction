<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\AuctionController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\InsuranceController;
use App\Http\Controllers\Api\MyAuctionController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\CommitAuctionController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\WithdrawMoneyController;
use App\Http\Controllers\Api\ChangeLanguageController;
use App\Http\Controllers\Api\MaintenanceCenterController;
use App\Http\Controllers\Api\BalanceInsuranceController;
use App\Http\Controllers\Api\StripeWebhookController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TypePaymentController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\DeleteAccountController;







// register
Route::post("/register", [RegisterController::class ,'register']);

// verify
Route::post('/verify', [RegisterController::class, 'verify']);
Route::post('/otp', [RegisterController::class, 'otp']);
//login
Route::post("/login", [LoginController::class ,'login']);
//forget-password
Route::post('/forget-password', [PasswordController::class, 'forgetPassword']);
//confirmationOtp
Route::post('/confirmation-otp', [PasswordController::class, 'confirmationOtp']);
//reset-password
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
// All Auction
Route::get('/auction', [AuctionController::class, 'index']);
//Details Auction
Route::get('/auction/{id}', [AuctionController::class, 'show']);
//country
Route::get('/country',[CountryController::class,'index']);

//filler Car
Route::get('car/filter',[CarController::class,'filter']);
//type Car
Route::get('/type', [CarController::class, 'type']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    // user
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
    Route::post('/change-password', [PasswordController::class, 'changePassword']);
    Route::post('/logout', [LogoutController::class, 'logout']);

    // car
    Route::get('/car', [CarController::class, 'index']);
    Route::post('/car', [CarController::class, 'store']);
    Route::get('/car/{id}', [CarController::class, 'show']);
    Route::post('/car/{id}', [CarController::class, 'update']);
    Route::delete('/car/{id}', [CarController::class, 'destroy']);
    Route::get('/car_pending', [CarController::class, 'getCarStatusPending']);
    Route::get('/car_approved', [CarController::class, 'getCarStatusApproved']);
    Route::get('/car_rejected', [CarController::class, 'getCarStatusRejected']);



    // insurance
    Route::post('/insurance', [InsuranceController::class, 'store']);
    //contact_us
    Route::post('/contact_us', [ContactUsController::class, 'store']);
    //balance_insurance
    Route::get('/balance_insurance', [BalanceInsuranceController::class, 'index']);


    //withdrawMoney
    Route::get('/withdraw_money', [WithdrawMoneyController::class, 'index']);
    Route::get('/withdraw_money/{id}', [WithdrawMoneyController::class, 'show']);
    Route::post('/withdraw_money', [WithdrawMoneyController::class, 'store']);

     // notifications
     Route::get('/notifications', [NotificationController::class, 'index']);

    //change_language
    Route::post('change_language/update', [ChangeLanguageController::class, 'update']);

    //privacy-policy
    Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show']);

    //questions
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{id}', [QuestionController::class, 'show']);
    Route::get('/type_payment', [TypePaymentController::class, 'index']);



    //maintenance_center
    Route::get('/maintenance_center', [MaintenanceCenterController::class, 'index']);
    Route::get('/maintenance_center/{id}', [MaintenanceCenterController::class, 'show']);




    //My Auction
    Route::get('/my-auctions', [MyAuctionController::class, 'getMyAuction']);
    //Commit Auction
    Route::post('/auction/{id}', [CommitAuctionController::class, 'commitAuction']);
    Route::get('/my-commit-auctions', [CommitAuctionController::class, 'getMyCommitAuctions']);
    //Auction
    Route::post('/auction/{id}/UpdateStatusAuction', [AuctionController::class, 'UpdateStatusAuction']);
    //delete_account
        Route::get('delete_account', [DeleteAccountController::class, 'deleteAccount']);

});
Route::get('/callback', [InsuranceController::class, 'callback']);
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
