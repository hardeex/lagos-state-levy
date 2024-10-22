<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionFunctionAbstract;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;


class AuthenticationController extends Controller
{
    public function registerUser()
    {
        return view('auth.register-user');
    }




    public function storeRegisterUser(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'lphone' => ['required', 'string', 'regex:/^\+\d{10,15}$/'],
            'lemail' => ['required', 'email'],
            'lpw' => ['required', 'string'],
            'lcpw' => ['required', 'string', 'same:lpw'],
            'lregno' => ['required', 'string', 'regex:/^RC\d{6}$/'], // Matches format like "RC123456"
            'ltaxid' => ['required', 'string', 'regex:/^TAX\d{6}$/'], // Matches format like "TAX123456"
            'lbizname' => ['required', 'string', 'max:255'],
            'ladd' => ['required', 'string', 'max:255'],
            'llga' => ['required', 'string', 'max:255'],
            'lstate' => ['required', 'string', 'max:255'],
            'lcountry' => ['required', 'string', 'max:255'],
            'lindustryone' => ['required', 'string', 'max:255'],
            'lagree' => ['required', 'in:yes'],
            'lincorporation' => ['required', 'integer', 'between:1900,' . date('Y')],
            'lsubsectorone' => ['required', 'string', 'max:255'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/registeremailphoneverify';

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $validatedData,
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status'])) {
                if ($responseData['status'] === 'success') {
                    // Log the success response data and message
                    Log::info('API request successful', [
                        'data' => $validatedData, // Log the validated data sent
                        'response' => $responseData // Log the full response from the API
                    ]);
                    return redirect()->route('auth.user-otp-verify')->with('success', $responseData['message']);
                } else {
                    return redirect()->back()->withErrors(['error' => $responseData['message']]);
                }
            } else {
                Log::error('Unexpected response from API: ', ['response' => $responseData]);
                return redirect()->back()->withErrors(['error' => 'Unexpected response from the server.']);
            }
        } catch (RequestException $e) {
            Log::error('Guzzle request failed: ' . $e->getMessage(), [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                'payload' => $validatedData,
            ]);
            return redirect()->back()->withErrors(['error' => 'An error occurred while connecting to the server.']);
        } catch (\Exception $e) {
            Log::error('General error occurred: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $validatedData,
            ]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred.']);
        }
    }

        public function verifyOTP()
        {
            // If no registration data in session, redirect back to register
            if (!session()->has('registration_data')) {
                return redirect()->route('auth.register-user')->withErrors(['error' => 'Please complete registration first']);
            }
            
            return view('auth.user-otp-verify');
        }
    
        public function verifyOTPSubmit(Request $request)
        {
            // Validate the incoming request
            $validatedData = $request->validate([
                'email_otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
                'phone_otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
            ]);
    
            $client = new Client();
            $apiUrl = config('api.base_url') . '/changeotps';
    
            try {
                // Get the registration data from session
                $registrationData = session('registration_data', []);
                
                // Prepare the payload according to API specifications
                $payload = [
                    'email_otp' => $validatedData['email_otp'],
                    'phone_otp' => $validatedData['phone_otp'],
                    'business_email' => $registrationData['lemail'] ?? null,
                ];
    
                $response = $client->post($apiUrl, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $payload,
                ]);
    
                $responseData = json_decode($response->getBody(), true);
    
                if (isset($responseData['status']) && $responseData['status'] === 'success') {
                    // Clear the registration session data
                    session()->forget('registration_data');
                    
                    // Log successful verification
                    Log::info('OTP verification successful', [
                        'business_email' => $payload['business_email']
                    ]);
    
                    return redirect()->route('auth.login-user')
                        ->with('success', 'Account verified successfully. Please login.');
                }
    
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Verification failed']);
    
            } catch (RequestException $e) {
                Log::error('OTP verification request failed: ' . $e->getMessage(), [
                    'request' => (string) $e->getRequest()->getBody(),
                    'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                ]);
    
                return redirect()->back()
                    ->withErrors(['error' => 'Failed to verify OTP. Please try again.']);
            }
        }
    
        public function resendOTP(Request $request)
        {
            $client = new Client();
            $apiUrl = config('api.base_url') . '/resend-otp';
    
            try {
                // Get the registration data from session
                $registrationData = session('registration_data', []);
                
                $payload = [
                    'business_email' => $registrationData['lemail'] ?? null,
                ];
    
                $response = $client->post($apiUrl, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $payload,
                ]);
    
                $responseData = json_decode($response->getBody(), true);
    
                if (isset($responseData['status']) && $responseData['status'] === 'success') {
                    return redirect()->back()
                        ->with('success', 'OTPs have been resent successfully.');
                }
    
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Failed to resend OTPs']);
    
            } catch (RequestException $e) {
                Log::error('Resend OTP request failed: ' . $e->getMessage(), [
                    'request' => (string) $e->getRequest()->getBody(),
                    'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                ]);
    
                return redirect()->back()
                    ->withErrors(['error' => 'Failed to resend OTPs. Please try again.']);
            }
        }
    

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function calendar()
    {
        return view('auth.calendar');
    }

    public function declaration()
    {
        return view('auth.declaration');
    }

    public function clearance()
    {
        return view('auth.clearance');
    }

    public function billing()
    {
        return view('auth.billing');
    }

    public function accountHistory()
    {
        return view('auth.account-history');
    }

    public function officialReturns()
    {
        return  view('auth.official-returns');
    }

    public function invoiceList()
    {
        return view('auth.invoice-list');
    }

    public function receipt()
    {
        return view('auth.receipt');
    }

    public function uploadReceipt()
    {
        return view('auth.upload-receipt');
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
