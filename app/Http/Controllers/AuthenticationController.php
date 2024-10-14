<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function registerUser()
    {
        return view('auth.register-user');
    }

    public function loginUser()
    {
        return view('auth.login-user');
    }


    public function safetyConsultantLogin()
    {
        return view('auth.safety-consultant-login');
    }
}
