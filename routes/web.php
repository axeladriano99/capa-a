<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/join/{code}', [App\Http\Controllers\HomeController::class, 'join']);

Route::middleware(['guest',])->group(function () {
    Route::get('/', function () {
        #return view('welcome');
        return redirect()->route('login');
    });
    Route::get('/register/{code}', [App\Http\Controllers\RegisterController::class, 'shoRegisterForm']);
    Route::post('/register/{code}', [App\Http\Controllers\RegisterController::class, 'register']);

    Route::get('/join-me/{campaign}/{user}', [App\Http\Controllers\RegisterController::class, 'shoRegisterFormUrl']);
    Route::post('/join-me/{campaign}/{user}', [App\Http\Controllers\RegisterController::class, 'registerUrl']);

});







Route::middleware(['auth',])->group(function () {
    Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('/payment-methods',App\Http\Controllers\PaymentMethodController::class);
    Route::resource('/campaigns',App\Http\Controllers\CampaignController::class);
    Route::resource('/roles',App\Http\Controllers\RoleController::class)->except(['create','show','destroy']);
    


    Route::get('/users/list', [App\Http\Controllers\UserController::class, 'list'])->name('users.list');
    Route::resource('/users', App\Http\Controllers\UserController::class);


    Route::resource('/campaign-invitations', App\Http\Controllers\CampaignInvitationController::class)->only(['destroy']);
    Route::resource('/campaign-referrals', App\Http\Controllers\CampaignReferralController::class)->only(['index', 'store']);


    //Route::resource('/networks', App\Http\Controllers\NetworkController::class)->only(['index']);
    Route::get('/networks/{campaign?}', [App\Http\Controllers\NetworkController::class, 'index'])->name('networks.index');

    Route::get('/payments/get-admin', [App\Http\Controllers\PaymentController::class, 'getAdmin']);
    Route::get('/payments/file/{payment}', [App\Http\Controllers\PaymentController::class, 'showFile'])->name('payments.file');
    Route::resource('/payments', App\Http\Controllers\PaymentController::class)->only(['index', 'store']);

    Route::get('payments/get-info/{campaign_referral}', [App\Http\Controllers\PaymentController::class, 'getInfo']);

    Route::get('payments/confirm/{payment}', [App\Http\Controllers\PaymentController::class, 'confirm']);

    Route::get('repayments/{repayment}', [App\Http\Controllers\PaymentController::class, 'getRepayment']);
    Route::post('repayments', [App\Http\Controllers\PaymentController::class, 'sendRepayment'])->name('repayments.store');

    Route::get('show-payments',[App\Http\Controllers\PaymentController::class, 'showPayments'])->name('show-payments');
});