<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WhatsAppController;
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
Route::post('/waapi-webhook',[WhatsAppController::class,'handleWaApiMsg']);

Route::middleware(['auth', 'admin'])->group(function (){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});

Route::prefix('admin')->middleware('guest')->group(function (){
    //Route::inertia('/register', 'Auth/Register')->name('register');
    //Route::post('/register', [AuthController::class, 'register']);



});
