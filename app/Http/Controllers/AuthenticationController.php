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
            'lregno' => ['required', 'string', 'regex:/^RC\d{6}$/'],
            'ltaxid' => ['required', 'string', 'regex:/^TAX\d{6}$/'],
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
                        'data' => $validatedData,
                        'response' => $responseData
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


        return view('auth.user-otp-verify');
    }
    public function verifyOTPSubmit(Request $request)
    {
        Log::info('OTP verification method called');

        // Validate the request
        $validatedData = $request->validate([
            'verification_method' => ['required', 'in:email,phone'],
            'otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
            'business_email' => ['required', 'email'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/changeotps';

        try {
            // Log the validated data
            Log::info('Validated data:', $validatedData);

            // Prepare the payload based on verification method
            $payload = [
                'business_email' => $validatedData['business_email']
            ];

            // Set the appropriate OTP field based on verification method
            if ($validatedData['verification_method'] === 'email') {
                $payload['email_otp'] = $validatedData['otp'];
                $payload['phone_otp'] = '000000'; // dummy value for unused method
            } else {
                $payload['phone_otp'] = $validatedData['otp'];
                $payload['email_otp'] = '000000'; // dummy value for unused method
            }

            // Log the payload before making the API call
            Log::info('Payload for API request:', $payload);

            $response = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload,
            ]);

            // Log the API response
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response received:', $responseData);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->route('auth.login-user')
                    ->with('success', 'Account verified successfully!');
            }

            // Log the error message if verification fails
            Log::warning('Verification failed:', [
                'error_message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload
            ]);

            return redirect()->back()
                ->withErrors(['error' => $responseData['message'] ?? 'Verification failed.'])
                ->withInput();
        } catch (RequestException $e) {
            Log::error('OTP verification failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to verify OTP. Please try again.'])
                ->withInput();
        }
    }


    public function resendOTP(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'verification_method' => ['required', 'in:email,phone'],
            'business_email' => ['required', 'email'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/resendotp';

        try {
            $payload = [
                'business_email' => $validatedData['business_email'],
                'verification_method' => $validatedData['verification_method'],
            ];

            $response = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload,
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->back()
                    ->with('success', 'OTP has been resent successfully.');
            }

            return redirect()->back()
                ->withErrors(['error' => $responseData['message'] ?? 'Failed to resend OTP.']);
        } catch (RequestException $e) {
            Log::error('OTP resend failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to resend OTP. Please try again.']);
        }
    }

    public function loginUser()
    {
        return view('auth.login-user');
    }

    public function storeLoginUser(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'lemail' => ['required', 'email'],
            'lpw' => ['required', 'string'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/login'; // I will be validating the API endpoint with Mr. James

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
                    // Log the successful login attempt
                    Log::info('Login successful', [
                        'email' => $validatedData['lemail']
                    ]);

                    // Store any necessary session data
                    if (isset($responseData['token'])) {
                        session(['auth_token' => $responseData['token']]);
                    }

                    if (isset($responseData['user'])) {
                        session(['user' => $responseData['user']]);
                    }

                    // Redirect to dashboard or home page after successful login
                    return redirect()->route('dashboard')
                        ->with('success', $responseData['message'] ?? 'Login successful!');
                } else {
                    // Log failed login attempt
                    Log::warning('Login failed', [
                        'email' => $validatedData['lemail'],
                        'message' => $responseData['message']
                    ]);

                    return redirect()->back()
                        ->withErrors(['error' => $responseData['message'] ?? 'Invalid credentials.'])
                        ->withInput($request->except('lpw'));
                }
            } else {
                Log::error('Unexpected response from login API: ', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => 'Unexpected response from the server.'])
                    ->withInput($request->except('lpw'));
            }
        } catch (RequestException $e) {
            Log::error('Login request failed: ' . $e->getMessage(), [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                ->withInput($request->except('lpw'));
        } catch (\Exception $e) {
            Log::error('General login error occurred: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred.'])
                ->withInput($request->except('lpw'));
        }
    }


    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function storeForgotPassword(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'lemail' => ['required', 'email'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/forgot-password'; // en-point to be confirmed

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
                    // Log the successful password reset request
                    Log::info('Password reset requested', [
                        'email' => $validatedData['lemail']
                    ]);

                    return redirect()->route('auth.change-password')
                        ->with('success', $responseData['message'] ?? 'Password reset link has been sent to your email.');
                } else {
                    Log::warning('Password reset request failed', [
                        'email' => $validatedData['lemail'],
                        'message' => $responseData['message']
                    ]);

                    return redirect()->back()
                        ->withErrors(['error' => $responseData['message'] ?? 'Unable to process password reset request.'])
                        ->withInput();
                }
            } else {
                Log::error('Unexpected response from forgot password API: ', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => 'Unexpected response from the server.'])
                    ->withInput();
            }
        } catch (RequestException $e) {
            Log::error('Forgot password request failed: ' . $e->getMessage(), [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                ->withInput();
        } catch (\Exception $e) {
            Log::error('General forgot password error occurred: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred.'])
                ->withInput();
        }
    }


    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function storeChangePassword(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'token' => ['required', 'string'],
            'lemail' => ['required', 'email'],
            'lpw' => ['required', 'string', 'min:8'],
            'lcpw' => ['required', 'string', 'same:lpw'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/reset-password'; // end-point to be confirmed

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
                    // Log the successful password change
                    Log::info('Password changed successfully', [
                        'email' => $validatedData['lemail']
                    ]);

                    return redirect()->route('auth.login-user')
                        ->with('success', $responseData['message'] ?? 'Password has been reset successfully.');
                } else {
                    Log::warning('Password change failed', [
                        'email' => $validatedData['lemail'],
                        'message' => $responseData['message']
                    ]);

                    return redirect()->back()
                        ->withErrors(['error' => $responseData['message'] ?? 'Unable to reset password.'])
                        ->withInput($request->except(['lpw', 'lcpw']));
                }
            } else {
                Log::error('Unexpected response from reset password API: ', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => 'Unexpected response from the server.'])
                    ->withInput($request->except(['lpw', 'lcpw']));
            }
        } catch (RequestException $e) {
            Log::error('Reset password request failed: ' . $e->getMessage(), [
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                ->withInput($request->except(['lpw', 'lcpw']));
        } catch (\Exception $e) {
            Log::error('General reset password error occurred: ' . $e->getMessage(), [
                'exception' => $e,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred.'])
                ->withInput($request->except(['lpw', 'lcpw']));
        }
    }

    // loading local government end-point

    public function loadLGALCDA()
    {
        Log::info('The user requested LGA/LCDA data');
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadlgalcda';

        try {
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            // Log the full response for debugging
            Log::info('LGA/LCDA API response received', [
                'url' => $apiUrl,
                'response' => (string) $response->getBody(),
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from LGA/LCDA API', [
                'response' => $responseData
            ]);
            return response()->json([], 500);
        } catch (\Exception $e) {
            Log::error('Failed to load LGA/LCDA data: ' . $e->getMessage(), [
                'url' => $apiUrl,
                'exception' => $e,
            ]);
            return response()->json([], 500);
        }
    }

    // load industry options for registration form
    // Controller Method
    public function loadIndustry()
    {
        Log::info('The user requested Industry Sector data');
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadindustry';

        try {
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            // Log the full response for debugging
            Log::info('Industry Sector API response received', [
                'url' => $apiUrl,
                'response' => (string) $response->getBody(),
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from Industry Sector API', [
                'response' => $responseData
            ]);
            return response()->json([], 500);
        } catch (\Exception $e) {
            Log::error('Failed to load Industry Sector data: ' . $e->getMessage(), [
                'url' => $apiUrl,
                'exception' => $e,
            ]);
            return response()->json([], 500);
        }
    }

    // sub sector options for registration form
    // Controller Method
    public function loadSubSectorUSINGGET()
    {
        Log::info('The user requested Sub-Sector data');
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadsubsector';

        try {
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            // Log the full response for debugging
            Log::info('Sub-Sector API response received', [
                'url' => $apiUrl,
                'response' => (string) $response->getBody(),
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from Sub-Sector API', [
                'response' => $responseData
            ]);
            return response()->json([], 500);
        } catch (\Exception $e) {
            Log::error('Failed to load Sub-Sector data: ' . $e->getMessage(), [
                'url' => $apiUrl,
                'exception' => $e,
            ]);
            return response()->json([], 500);
        }
    }

    // Controller Method
    public function loadSubSector()
    {
        Log::info('The user requested Sub-Sector data');
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadsubsector';

        try {
            $response = $client->post($apiUrl, [  // Changed from get to post
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);

            // Log the full response for debugging
            Log::info('Sub-Sector API response received', [
                'url' => $apiUrl,
                'response' => (string) $response->getBody(),
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from Sub-Sector API', [
                'response' => $responseData
            ]);
            return response()->json([], 500);
        } catch (\Exception $e) {
            Log::error('Failed to load Sub-Sector data: ' . $e->getMessage(), [
                'url' => $apiUrl,
                'exception' => $e,
            ]);
            return response()->json([], 500);
        }
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




    public function dashboard()
    {
        return view('auth.dashboard');
    }

    public function safetyConsultantLogin()
    {
        return view('auth.safety-consultant-login');
    }
}
