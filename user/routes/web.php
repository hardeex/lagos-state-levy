<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SafetyConsultantController;

// Authentication Routes
Route::get('/register', [AuthenticationController::class, 'registerUser'])->name('auth.register-user');
Route::post('/register', [AuthenticationController::class, 'storeRegisterUser'])->name('auth.register-submit');
Route::get('/business/load-lga-lcda', [AuthenticationController::class, 'loadLGALCDA'])->name('business.load-lga-lcda');
Route::get('/api/business/load-industry', [AuthenticationController::class, 'loadIndustry']);
Route::post('/api/business/load-subsector', [AuthenticationController::class, 'loadSubSector']);

// OTP verification routes
Route::get('/register/otp-verify', [AuthenticationController::class, 'verifyOTP'])->name('auth.user-otp-verify');
Route::post('/api/verify-otp', [AuthenticationController::class, 'verifyOTPSubmit'])->name('auth.otp-verify-submit');
Route::post('/api/resend-otp', [AuthenticationController::class, 'resendOTP'])->name('auth.resend-otp');

// user authentication routes
Route::get('/login', [AuthenticationController::class, 'loginUser'])->name('auth.login-user');
Route::post('/api/login', [AuthenticationController::class, 'storeLoginUser'])->name('auth.login-submit');
Route::get('/user-logout', [AuthenticationController::class, 'logoutUser'])->name('auth.logout-user');

Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::post('/api/forgot-password', [AuthenticationController::class, 'storeForgotPassword'])->name('auth.forgot-password-submit');
Route::get('/change-password', [AuthenticationController::class, 'changePassword'])->name('auth.change-password');
Route::post('/api/change-password', [AuthenticationController::class, 'initiatePasswordReset'])->name('auth.change-password-submit');

// declaration routes
Route::get('/declaration', [AuthenticationController::class, 'declaration'])->name('auth.declaration');
Route::post('/api/declaration', [AuthenticationController::class, 'storeDeclaration'])->name('auth.declaration-submit');
Route::delete('/delete-branch', [AuthenticationController::class, 'deleteBranch'])->name('auth.delete-branch');
Route::post('/final-declaration', [AuthenticationController::class, 'finalDeclaration'])->name('auth.final-declaration');
Route::post('/api/business/building-types', [AuthenticationController::class, 'getBuildingTypes']);
Route::get('/business/profile', [AuthenticationController::class, 'getBusinessProfile'])->name('business.profile');


Route::get('/view-branches', [AuthenticationController::class, 'viewBranchesForm'])->name('auth.viewBranches');
Route::post('/api/view-branches', [AuthenticationController::class, 'viewBranches'])->name('auth.viewBranches-submit');


Route::get('/accounting', [AuthenticationController::class, 'billing'])->name('auth.billing');
Route::get('/official-returns', [AuthenticationController::class, 'officialReturns'])->name('auth.official-returns');
Route::get('/receipt', [AuthenticationController::class, 'receipt'])->name('auth.receipt');
Route::get('/upload-receipt', [AuthenticationController::class, 'uploadReceipt'])->name('auth.upload-receipt');
Route::get('/invoice-list', [AuthenticationController::class, 'invoiceList'])->name('auth.invoice-list');
Route::get('/api/invoice-list', [AuthenticationController::class, 'storeInvoiceList'])->name('auth.generate-invoice');
Route::get('/invoice/view/{invoiceId}', [AuthenticationController::class, 'viewInvoice'])->name('invoice.view');
Route::post('/invoice/pay', [AuthenticationController::class, 'payInvoice'])->name('auth.invoice-pay');



Route::get('/account-history', [AuthenticationController::class, 'accountHistory'])->name('auth.account-history');
Route::get('/visitation', [AuthenticationController::class, 'calendar'])->name('auth.calendar');
Route::get('/clearance', [AuthenticationController::class, 'clearance'])->name('auth.clearance');






// ashboard routes
Route::get('/dashboard', [AuthenticationController::class, 'dashboard'])->name('auth.dashboard');



// Generic page route
Route::get('/', [GeneralController::class, 'home'])->name('welcome');
Route::get('/contact', [GeneralController::class, 'contact'])->name('user.contact');
Route::post('/contact-send-message', [GeneralController::class, 'sendMessage'])->name('user.send-message');
Route::get('/training', [GeneralController::class, 'training'])->name('user.training');
Route::get('/consultant-carde', [GeneralController::class, 'carde'])->name('user.carde');


// unconfirmed routes
Route::get('/support', [GeneralController::class, 'support'])->name('user.support');
Route::get('apply-for-certificate', [GeneralController::class, 'applyCertificate'])->name('user.certtificate');



// safety consultant routes
// auth routes for the safety consultant
Route::get('/safety-consultant/register', [SafetyConsultantController::class, 'safetyConsultantRegister'])->name('auth.safety-consultant-register');
Route::post('/api/safety-consultant/register', [AuthenticationController::class, 'storeSafetyConsultantRegister'])->name('auth.safety-consultant-register-submit');
Route::get('/safety-consultant/login', [AuthenticationController::class, 'safetyConsultantLogin'])->name('auth.safety-consultant-login');
Route::post('/api/safety-consultant/login', [AuthenticationController::class, 'storeSafetyConsultantLogin'])->name('auth.safety-consultant-login-submit');
Route::get('/safety-consultant-logout', [AuthenticationController::class, 'safetyConsultantLogout'])->name('auth.safety-consultant-logout');

// safety consultant dashboard routes
Route::get('/safety-consultant/dashboard', [SafetyConsultantController::class, 'dashboard'])->name('safety-consultant.dashboard');