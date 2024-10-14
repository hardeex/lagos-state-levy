<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Route::get('/register', [AuthenticationController::class, 'registerUser'])->name('auth.register-user');
Route::post('/api/register', [AuthenticationController::class, 'storeRegisteruser'])->name('auth.register-submit');
Route::get('/login', [AuthenticationController::class, 'loginUser'])->name('auth.login-user');
Route::post('/api/login', [AuthenticationController::class, 'storeLoginUser'])->name('auth.login-submit');
Route::get('/safety-consultant/login', [AuthenticationController::class, 'safetyConsultantLogin'])->name('auth.safety-consultant-login');



// Generic page route
Route::get('/', [GeneralController::class, 'home'])->name('welcome');
Route::get('/contact', [GeneralController::class, 'contact'])->name('user.contact');
Route::post('/contact-send-message', [GeneralController::class, 'sendMessage'])->name('user.send-message');
