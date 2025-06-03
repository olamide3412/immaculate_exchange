<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsAppController;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return inertia('Home');
})->name('home');

Route::inertia('/about-us','About')->name('about');
Route::inertia('/rate','Rate')->name('rate');
Route::inertia('/faq','FAQ')->name('faq');

Route::inertia('/login','Auth/Login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/whatsapp-webhook',[WhatsAppController::class,'handleIncomingMessage']);

Route::middleware(['auth', 'admin'])->group(function (){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/whatsapp-responses', [WhatsAppController::class, 'index'])->name('whatsAppResponse.index');
    Route::get('/whatsapp-responses/{whatsAppResponse}', [WhatsAppController::class, 'show'])->name('whatsAppResponse.show');
    Route::post('/whatsapp-responses', [WhatsAppController::class, 'store'])->name('whatsAppResponse.store');
    Route::put('/whatsapp-responses/{whatsAppResponse}', [WhatsAppController::class, 'update'])->name('whatsAppResponse.update');
    Route::delete('/whatsapp-responses/{whatsAppResponse}', [WhatsAppController::class, 'destroy'])->name('whatsAppResponse.destroy');

    Route::get('/exchange-rate', [ExchangeRateController::class, 'index'])->name('exchangeRate.index');
    Route::get('/exchange-rate/{exchangeRate}', [ExchangeRateController::class, 'show'])->name('exchangeRate.show');
    Route::post('/exchange-rate', [ExchangeRateController::class, 'store'])->name('exchangeRate.store');
    Route::put('/exchange-rate/{exchangeRate}', [ExchangeRateController::class, 'update'])->name('exchangeRate.update');
    Route::delete('/exchange-rate/{exchangeRate}', [ExchangeRateController::class, 'destroy'])->name('exchangeRate.destroy');

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class,'show'])->name('users.show');
    Route::patch('/users/{user}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class,'destroy'])->name('users.destroy');
    Route::post('/users/reset-password/{user}', [UserController::class,'resetPassword'])->name('users.resetPassword');
    Route::post('/users/update-password/{user}', [UserController::class,'updatePassword'])->name('users.updatePassword');
    Route::get('/profile', [UserController::class,'profile'])->name('users.profile');

    Route::get('/logs', [LogController::class, 'index'])->name('log.index');

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});

Route::prefix('admin')->middleware('guest')->group(function (){
    //Route::inertia('/register', 'Auth/Register')->name('register');
    //Route::post('/register', [AuthController::class, 'register']);



});

//Git test
