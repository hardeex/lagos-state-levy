<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SafetyConsultantController extends Controller
{
    public function dashboard()
    {
        return view('safety-consultant.dashboard');
    }
}
