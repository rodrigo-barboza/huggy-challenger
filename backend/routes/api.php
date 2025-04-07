<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInsightsController;
use App\Http\Controllers\HuggyController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register',[AuthController::class, 'register'])->name('auth.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/contacts', ContactController::class)
        ->only('index', 'store', 'update', 'destroy');
    Route::get('/contacts/insights', ContactInsightsController::class)->name('contacts.insights');
    Route::post('auth/logout',[AuthController::class,'logout'])->name('auth.logout');
});

Route::get('/test', HuggyController::class);
Route::get('/auth/huggy/login', [LoginController::class, 'login'])->name('auth.huggy.login');
