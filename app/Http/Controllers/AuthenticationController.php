<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function registerUser()
    {
        return view('auth.register-user');
    }

    public function verifyOTP()
    {
        return view('auth.user-otp-verify');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function declaration()
    {
        return view('auth.declaration');
    }

    public function billing()
    {
        return view('auth.billing');
    }

    public function loginUser()
    {
        return view('auth.login-user');
    }


    public function dashboard()
    {
        return view('auth.dashboard');
    }

    public function safetyConsultantLogin()
    {
        return view('auth.safety-consultant-login');
    }
}
