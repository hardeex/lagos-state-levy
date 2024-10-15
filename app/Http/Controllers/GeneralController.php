<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function home()
    {
        $quickLinks = [
            [
                'title' => 'Payment Status',
                'description' => 'Check the status of your recent levy payments and view payment history.',
                'url' => route('welcome'),
                'icon' => '<i class="fas fa-credit-card"></i>',
                'iconColor' => 'text-blue-500',
            ],
            [
                'title' => 'Verify Certificate',
                'description' => 'Validate the authenticity of your levy payment certificate.',
                'url' => route('welcome'),
                'icon' => '<i class="fas fa-file-alt"></i>',
                'iconColor' => 'text-green-500',
            ],
            [
                'title' => 'FAQs',
                'description' => 'Find answers to commonly asked questions about government levies.',
                'url' => route('welcome'),
                'icon' => '<i class="fas fa-question-circle"></i>',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'title' => 'Contact Support',
                'description' => 'Get in touch with our support team for personalized assistance.',
                'url' => route('user.contact'),
                'icon' => '<i class="fas fa-comments"></i>',
                'iconColor' => 'text-purple-500',
            ],
        ];

        return view('welcome', compact('quickLinks'));
    }


    public function contact()
    {
        return view('user.contact');
    }

    public function training()
    {
        return view('user.training');
    }
}
