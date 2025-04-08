<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInsightsController;
use App\Http\Controllers\GetLeadsFromHuggyFlowController;
use App\Http\Controllers\HuggyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TwilioController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register',[AuthController::class, 'register'])->name('auth.register');

Route::post('/huggy-flow/leads', GetLeadsFromHuggyFlowController::class)->name('huggy.leads');

Route::post('/twilio/voice/{contactName}', [TwilioController::class, 'voiceResponse'])->name('twilio.voice');
Route::post('/twilio/call-status', [TwilioController::class, 'handleCallStatus'])->name('twilio.call.status');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/contacts', ContactController::class)->only('index', 'store', 'update', 'destroy');
    Route::get('/contacts/insights', ContactInsightsController::class)->name('contacts.insights');
    Route::post('/twilio/make-call/{contact}', [TwilioController::class, 'makeCall'])->name('twilio.make.call');
    Route::post('/auth/logout',[AuthController::class,'logout'])->name('auth.logout');
});

Route::get('/test', HuggyController::class);
Route::get('/auth/huggy/login', [LoginController::class, 'login'])->name('auth.huggy.login');
