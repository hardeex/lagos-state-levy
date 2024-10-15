<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Route::get('/register', [AuthenticationController::class, 'registerUser'])->name('auth.register-user');
Route::post('/api/register', [AuthenticationController::class, 'storeRegisteruser'])->name('auth.register-submit');
Route::get('/register/otp-verify', [AuthenticationController::class, 'verifyOTP'])->name('auth.user-otp-verify');
Route::post('/api/verify-otp', [AuthenticationController::class, 'verifyOTPSubmit'])->name('auth.otp-verify-submit');
Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('auth.forgot-password');

Route::get('/declaration', [AuthenticationController::class, 'declaration'])->name('auth.declaration');
Route::post('/api/declaration', [AuthenticationController::class, 'storeDeclaration'])->name('auth.declaration-submit');
Route::get('/billing/business', [AuthenticationController::class, 'billing'])->name('auth.billing');

Route::get('/login', [AuthenticationController::class, 'loginUser'])->name('auth.login-user');
Route::post('/api/login', [AuthenticationController::class, 'storeLoginUser'])->name('auth.login-submit');
Route::get('/safety-consultant/login', [AuthenticationController::class, 'safetyConsultantLogin'])->name('auth.safety-consultant-login');


// ashboard routes
Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('auth.dashboard');



// Generic page route
Route::get('/', [GeneralController::class, 'home'])->name('welcome');
Route::get('/contact', [GeneralController::class, 'contact'])->name('user.contact');
Route::post('/contact-send-message', [GeneralController::class, 'sendMessage'])->name('user.send-message');
Route::get('/training', [GeneralController::class, 'training'])->name('user.training');
