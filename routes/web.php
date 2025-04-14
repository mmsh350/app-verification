<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->away('https://usseytech.com.ng/auth/login');
});

Route::post('/palmpay/webhook', [PaymentWebhookController::class, 'handlePalmPay']);

Route::group(['as' => 'auth.', 'prefix' => 'auth', 'middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');

    Route::post('register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// User Routes
Route::middleware(['auth', 'user.active'])->group(function () {
    // User dashboard
    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/verify-user', [VerificationController::class, 'verifyUser'])->name('verify-user');

        Route::middleware(['user.active', 'user.is_kyced'])->group(function () {
            Route::get('/verify-nin', [VerificationController::class, 'ninVerify'])->name('verify-nin');
            Route::get('/verify-bvn', [VerificationController::class, 'bvnVerify'])->name('verify-bvn');
            Route::get('/nin-personalize', [VerificationController::class, 'index'])->name('nin-personalize');

            //Wallet
            Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
            Route::get('claim-bonus/{id}', [WalletController::class, 'claimBonus'])->name('claim-bonus');

            //Transactions -----------------------------------------------------------------------------------------------------
            Route::get('/receipt/{referenceId}', [TransactionController::class, 'reciept'])->name('reciept');

            //Verification-----------------------------------------------------------------------------------------------------
            Route::post('/nin-retrieve', [VerificationController::class, 'ninRetrieve'])->name('ninRetrieve');
            Route::post('/bvn-retrieve', [VerificationController::class, 'bvnRetrieve'])->name('bvnRetrieve');

            //PDF Downloads -----------------------------------------------------------------------------------------------------
            Route::get('/standardBVN/{id}', [VerificationController::class, 'standardBVN'])->name("standardBVN");
            Route::get('/premiumBVN/{id}', [VerificationController::class, 'premiumBVN'])->name("premiumBVN");
             Route::get('/plasticBVN/{id}', [VerificationController::class, 'plasticBVN'])->name("plasticBVN");
            
            Route::get('/regularSlip/{id}', [VerificationController::class, 'regularSlip'])->name("regularSlip");
            Route::get('/standardSlip/{id}', [VerificationController::class, 'standardSlip'])->name("standardSlip");
            Route::get('/premiumSlip/{id}', [VerificationController::class, 'premiumSlip'])->name("premiumSlip");

            //Whatsapp API Support--------------------------------------------------------------------------
            Route::get('/support', function () {
                $phoneNumber = env('phoneNumber');
                $message = urlencode(env('message'));
                $url = env('API_URL') . "{$phoneNumber}&text={$message}";
                return redirect($url);
            })->name('support');
        });
    });
    // Logout Route
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// // Admin Routes
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_active', 'admin']], function () {
//     Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
//  Route::get('/admin/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
//     Route::put('/admin/settings', [SiteSettingController::class, 'update'])->name('settings.update');
// });
