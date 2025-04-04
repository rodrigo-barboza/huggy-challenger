<?php

use App\Http\Controllers\HuggyController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', HuggyController::class);
Route::get('/auth/huggy/login', [LoginController::class, 'login'])->name('auth.huggy.login');

