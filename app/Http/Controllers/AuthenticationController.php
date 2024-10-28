<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionFunctionAbstract;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'connect_timeout' => 5,
            'http_errors' => false,
            'verify' => false
        ]);
    }


    public function declaration()
    {
        // Fetch branches before displaying the page
        $branches = $this->fetchBranches();
        return view('auth.declaration', compact('branches'));
    }



    private function fetchBranches($batch = 1)
    {
        try {
            $email = Session::get('business_email');
            $password = Session::get('business_password');

            if (!$email || !$password) {
                Log::warning('No stored credentials found for fetching branches');
                return [];
            }

            $apiUrl = config('api.base_url') . '/business/businessviewbranch';
            // Enhanced logging for request
            Log::info('Fetching branches - Request:', [
                'email' => $email,
                'batch' => $batch,
                'url' => $apiUrl
            ]);

            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'batch' => $batch
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Enhanced response logging
            Log::info('Branch API Raw Response:', [
                'status_code' => $statusCode,
                'response_structure' => array_keys($responseBody ?? []),
                'response_type' => gettype($responseBody)
            ]);

            if ($statusCode === 200) {
                // Check both possible data structures
                $branches = [];
                if (isset($responseBody['data']) && is_array($responseBody['data'])) {
                    $branches = $responseBody['data'];
                } elseif (isset($responseBody['branches']) && is_array($responseBody['branches'])) {
                    $branches = $responseBody['branches'];
                }

                // Log the processed branches
                Log::info('Processed branch data:', [
                    'count' => count($branches),
                    'sample_keys' => $branches ? array_keys(reset($branches)) : [],
                    'first_branch' => $branches ? json_encode(reset($branches)) : 'no branches'
                ]);

                // Store branches in session for backup
                Session::put('cached_branches', $branches);

                return $branches;
            }

            Log::warning('Failed to fetch branches', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);
            return Session::get('cached_branches', []);
        } catch (\Exception $e) {
            Log::error('Error fetching branches', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return Session::get('cached_branches', []);
        }
    }


    public function finalDeclaration(Request $request)
    {
        Log::info('Business final declaration method is called');

        try {
            // Get stored credentials
            $email = Session::get('business_email');
            $password = Session::get('business_password');

            if (!$email || !$password) {
                Log::warning('No stored credentials found for final declaration');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Authentication required. Please log in again.'
                ], 401);
            }

            // First fetch and verify branches
            $branches = $this->fetchBranches();

            // Log branch verification
            Log::info('Verifying branches before final declaration:', [
                'branch_count' => count($branches),
                'cached_count' => count(Session::get('cached_branches', [])),
                'email' => $email
            ]);

            if (empty($branches)) {
                // Try to get from cache
                $branches = Session::get('cached_branches', []);
                if (empty($branches)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'No branches found. Please add at least one branch before submitting.'
                    ], 404);
                }
            }

            // Proceed with final declaration
            $apiUrl = config('api.base_url') . '/business/finaldeclearation';

            $payload = [
                'email' => $email,
                'password' => $password,
                'branches' => $branches  // adding the branches to the api request payload
            ];

            Log::info('Submitting final declaration:', [
                'email' => $email,
                'branch_count' => count($branches)
            ]);

            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            Log::info('Final declaration response:', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            if ($statusCode === 200) {
                // Clear cached branches after successful submission
                Session::forget('cached_branches');

                return response()->json([
                    'status' => 'success',
                    'message' => $responseBody['message'] ?? 'Declarations registered successfully!',
                    'branch_count' => count($branches)
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => $responseBody['message'] ?? 'Failed to process declaration'
            ], $statusCode);
        } catch (\Exception $e) {
            Log::error('Error in final declaration', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }


    public function storeDeclaration(Request $request)
    {
        Log::info('Business declaration method is called');

        try {
            $validatedData = $request->validate([
                'locationType' => ['required', 'string'],
                'branchName' => ['required', 'string', 'max:255'],
                'branchAddress' => ['required', 'string', 'max:255'],
                'lga' => ['required', 'string', 'max:255'],
                'contactPerson' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'contactPhone' => ['required', 'string'],
                'staffcount' => ['required', 'integer'],
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6']
            ]);

            $payload = [
                'locationType' => ucwords(strtolower($validatedData['locationType'])),
                'branchName' => $validatedData['branchName'],
                'branchAddress' => $validatedData['branchAddress'],
                'lga' => $validatedData['lga'],
                'contactPerson' => $validatedData['contactPerson'],
                'designation' => $validatedData['designation'],
                'contactPhone' => $validatedData['contactPhone'],
                'staffcount' => (string)$validatedData['staffcount'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password']
            ];

            // Store credentials in session for future branch fetching
            Session::put('business_email', $validatedData['email']);
            Session::put('business_password', $validatedData['password']);

            $apiUrl = config('api.base_url') . '/business/businessaddbranch';

            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            switch ($statusCode) {
                case 200:
                case 201:
                    // Fetch updated branches after successful addition
                    $branches = $this->fetchBranches();
                    return redirect()->route('auth.declaration')
                        ->with('success', 'Business location added successfully!')
                        ->with('branches', $branches);

                case 422:
                    return redirect()->route('auth.declaration')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Validation failed'])
                        ->withInput();

                case 500:
                    return redirect()->route('auth.declaration')
                        ->withErrors(['error' => 'Unable to process your request at this time. Please try again later.'])
                        ->withInput();

                default:
                    return redirect()->route('auth.declaration')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Failed to add business location'])
                        ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('auth.declaration')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        }
    }



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

        Log::info('Session store attempt', [
            'email' => $validatedData['lemail']
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/registeremailphoneverify';

        // Log the exact payload being sent
        Log::info('API request payload', [
            'url' => $apiUrl,
            'data' => $validatedData
        ]);


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
                    session(['business_email' => $validatedData['lemail']]);
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
        $businessEmail = session('business_email');
        return view('auth.user-otp-verify', compact('businessEmail'));
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

        Log::info('Session retrieve attempt', [
            'email' => session('business_email')
        ]);

        // Retrieve the email from the session
        $sessionEmail = session('business_email');

        // Ensure the email from the request matches the session email
        if ($validatedData['business_email'] !== $sessionEmail) {
            return redirect()->back()->withErrors(['error' => 'Email mismatch. Please try again.'])->withInput();
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/changeotps';

        try {
            // Log the validated data
            Log::info('Validated data:', $validatedData);

            // Prepare the payload based on verification method
            $payload = [
                'business_email' => $sessionEmail // Use the session email
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
        Log::info('Incoming request data', ['request' => $request->all()]);

        // Validate incoming request data
        $validatedData = $request->validate([
            'lemail' => ['required', 'email'],
            'lpw' => ['required', 'string'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/bloginaction';

        try {
            $payload = [
                'email' => $validatedData['lemail'],
                'password' => $validatedData['lpw'],
            ];

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Handle the response based on status codes and response data
            return $this->handleLoginResponse($responseData, $validatedData['lemail']);
        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $responseBody = $e->hasResponse() ? json_decode($e->getResponse()->getBody(), true) : null;

            // Log the error with detailed information
            Log::error('Login request failed', [
                'status_code' => $statusCode,
                'request' => $payload,
                'response' => $responseBody,
                'email' => $validatedData['lemail']
            ]);

            // Handle specific HTTP status codes
            switch ($statusCode) {
                case 401:
                    return redirect()->back()
                        ->withErrors(['error' => 'Invalid credentials.'])
                        ->withInput($request->except('lpw'));

                case 403:
                    // Handle business declaration requirement
                    if ($responseBody && $responseBody['message'] === 'Business declaration required!') {
                        return redirect()->route('auth.declaration')
                            ->withErrors(['error' => 'Please complete the business declaration process to access your account.']);
                    }
                    return redirect()->back()
                        ->withErrors(['error' => $responseBody['message'] ?? 'Access denied.'])
                        ->withInput($request->except('lpw'));

                case 422:
                    return redirect()->back()
                        ->withErrors(['error' => 'Please provide all required information.'])
                        ->withInput($request->except('lpw'));

                default:
                    return redirect()->back()
                        ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                        ->withInput($request->except('lpw'));
            }
        } catch (\Exception $e) {
            Log::error('General login error occurred', [
                'exception' => $e,
                'email' => $validatedData['lemail']
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred.'])
                ->withInput($request->except('lpw'));
        }
    }

    /**
     * Handle the login response from the API
     * 
     * @param array $responseData
     * @param string $email
     * @return \Illuminate\Http\RedirectResponse
     */
    private function handleLoginResponse(array $responseData, string $email)
    {
        if (!isset($responseData['status'])) {
            Log::error('Unexpected response format from login API', ['response' => $responseData]);
            return redirect()->back()
                ->withErrors(['error' => 'Unexpected response from the server.'])
                ->withInput();
        }

        if ($responseData['status'] === 'success') {
            Log::info('Login successful', ['email' => $email]);

            // Store session data
            if (isset($responseData['token'])) {
                session(['auth_token' => $responseData['token']]);
            }

            if (isset($responseData['user'])) {
                session(['user' => $responseData['user']]);
            }

            // Store balance if provided
            if (isset($responseData['data']['balance'])) {
                session(['balance' => $responseData['data']['balance']]);
            }

            return redirect()->route('auth.billing')
                ->with('success', $responseData['message'] ?? 'Login successful!');
        }

        // Handle error status
        Log::warning('Login failed', [
            'email' => $email,
            'message' => $responseData['message'] ?? 'Unknown error'
        ]);

        return redirect()->back()
            ->withErrors(['error' => $responseData['message'] ?? 'Login failed.'])
            ->withInput();
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

    public function initiatePasswordReset(Request $request)
    {
        Log::info('Initiate password reset method is called');

        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
            ]);

            // Prepare the payload for the API
            $payload = [
                'email' => $validatedData['email'],
            ];

            // Log the final payload to inspect the data being sent
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            $apiUrl = config('api.base_url') . '/business/initiatepasswordreset';
            Log::debug('Attempting API call to: ' . $apiUrl);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log API response for debugging
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);
                Log::info('Password reset email sent successfully', ['data' => $responseData['data']]);
                return redirect()->route('auth.login')
                    ->with('success', 'Password reset email sent successfully! Please check your inbox.');
            }

            if ($statusCode === 404) {
                $responseData = json_decode($responseBody, true);
                Log::warning('Email not found', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Email not found'])
                    ->withInput();
            }

            if ($statusCode === 500) {
                Log::error('Internal server error', ['response' => $responseBody]);
                return redirect()->back()
                    ->withErrors(['error' => 'Error sending password reset email. Please try again later.'])
                    ->withInput();
            }

            // Handle other unexpected statuses
            Log::error('Unexpected status code', ['status_code' => $statusCode, 'response' => $responseBody]);
            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        }
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

            $responseData = json_decode($response->getBody(), true);

            Log::info('Industry Sector API response received', [
                'url' => $apiUrl,
                'response' => $responseData
            ]);

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


    public function loadSubSector(Request $request)
    {
        Log::info('The user requested Sub-Industry Sector data', [
            'industry' => $request->industry,
            'request_data' => $request->all()
        ]);

        try {
            // Validate the request
            $validated = $request->validate([
                'industry' => 'required|string'
            ]);

            $client = new Client();
            $apiUrl = config('api.base_url') . '/loadsubsector';

            // Log the request being sent to the API
            Log::info('Sending request to Sub-Industry Sector API', [
                'url' => $apiUrl,
                'payload' => ['industry' => $validated['industry']]
            ]);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'industry' => $validated['industry']
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            Log::info('Sub-Industry Sector API response received', [
                'url' => $apiUrl,
                'industry' => $validated['industry'],
                'response' => $responseData
            ]);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                // Return the data array directly
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from Sub-Industry Sector API', [
                'response' => $responseData
            ]);

            return response()->json([
                'message' => $responseData['message'] ?? 'Failed to load sub-sectors'
            ], 500);
        } catch (\Exception $e) {
            Log::error('Failed to load Sub-Industry Sector data: ' . $e->getMessage(), [
                'url' => $apiUrl ?? null,
                'industry' => $request->industry ?? null,
                'exception' => $e,
            ]);

            return response()->json([
                'message' => 'Failed to load sub-sectors: ' . $e->getMessage()
            ], 500);
        }
    }

    // Controller Method

    public function calendar()
    {
        return view('auth.calendar');
    }

    public function declaration2()
    {
        return view('auth.declaration');
    }



    public function viewBranchesForm()
    {
        return view('auth.view');
    }


    public function viewBranches(Request $request)
    {
        Log::info('View branches method is called');

        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6'],
                'batch' => ['required', 'integer']
            ]);

            // Construct payload to match API specifications
            $payload = [
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'batch' => $validatedData['batch']
            ];

            // Log the final payload
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            $apiUrl = config('api.base_url') . '/business/businessviewbranch';
            Log::debug('Attempting API call to: ' . $apiUrl);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log API response
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            // Decode the JSON response
            $responseData = json_decode($responseBody, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decode error', [
                    'error' => json_last_error_msg(),
                    'raw_response' => $responseBody
                ]);
                throw new \RuntimeException('Invalid JSON response from API');
            }

            // Handle the response based on status code
            switch ($statusCode) {
                case 200:
                    Log::info('Branches retrieved successfully', ['response' => $responseData]);
                    return view('auth.view', ['branches' => $responseData['data']]); // Update the view path as necessary
                case 401:
                    Log::warning('Unauthorized access', ['response' => $responseData]);
                    return redirect()->route('auth.login')
                        ->withErrors(['error' => 'Invalid email or password'])
                        ->withInput();
                case 422:
                    Log::warning('Validation error from API', ['response' => $responseData]);
                    return redirect()->route('auth.viewBranches')
                        ->withErrors(['error' => $responseData['message'] ?? 'Validation failed'])
                        ->withInput();
                default:
                    $errorMessage = $responseData['message'] ?? 'Failed to retrieve branches';
                    Log::warning('Branch retrieval failed', [
                        'response' => $responseData,
                        'status_code' => $statusCode
                    ]);
                    return redirect()->route('auth.viewBranches')
                        ->withErrors(['error' => $errorMessage])
                        ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('auth.viewBranches')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        }
    }

    public function deleteBranch(Request $request)
    {
        Log::info('Business branch deletion method is called');

        try {
            // Get stored credentials from session
            $email = Session::get('business_email');
            $password = Session::get('business_password');

            if (!$email || !$password) {
                Log::warning('No stored credentials found for deleting branch');
                return redirect()->route('auth.declaration')
                    ->withErrors(['error' => 'Authentication required. Please log in again.']);
            }

            // Validate that branch_id is provided and is an integer
            $validatedData = $request->validate([
                'branch_id' => ['required', 'integer']
            ]);

            $apiUrl = config('api.base_url') . '/business/businessbranchdelete'; // Updated endpoint

            $payload = [
                'email' => $email,
                'password' => $password,
                'branchid' => (int)$validatedData['branch_id']  // Cast to integer as per API spec
            ];

            // Log the request payload for debugging
            Log::info('Deleting branch with payload:', [
                'email' => $email,
                'branchid' => $payload['branchid']
            ]);

            $response = $this->client->delete($apiUrl, [ // Changed to DELETE method
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log the complete response for debugging
            Log::info('Branch deletion API Response:', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            if ($statusCode === 200 && ($responseBody['status'] === 'success' || $responseBody['status'] === 'Success')) {
                // Fetch updated branches after successful deletion
                $branches = $this->fetchBranches();
                return redirect()->route('auth.declaration')
                    ->with('success', $responseBody['message'] ?? 'Business branch deleted successfully!')
                    ->with('branches', $branches);
            }

            // Handle error cases
            return redirect()->route('auth.declaration')
                ->withErrors(['error' => $responseBody['message'] ?? 'Failed to delete business branch']);
        } catch (\Exception $e) {
            Log::error('Error deleting branch', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('auth.declaration')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }


    public function fetchBranchList(Request $request)
    {
        Log::info('Fetch branch list method is called');

        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6'],
                'batch' => ['required', 'integer', 'min:1'], // Ensure batch is a positive integer
            ]);

            // Prepare the payload for the API
            $payload = [
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'batch' => (int)$validatedData['batch'],
            ];

            // Log the final payload to inspect the data being sent
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            $apiUrl = config('api.base_url') . '/business/businessviewbranch';
            Log::debug('Attempting API call to: ' . $apiUrl);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log API response for debugging
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);
                Log::info('Branches retrieved successfully', ['data' => $responseData['data']]);
                return view('your.view.name', ['branches' => $responseData['data']]);
            }

            if ($statusCode === 401) {
                $responseData = json_decode($responseBody, true);
                Log::warning('Unauthorized access', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Unauthorized access'])
                    ->withInput();
            }

            if ($statusCode === 422) {
                $responseData = json_decode($responseBody, true);
                Log::warning('Validation error from API', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Validation failed'])
                    ->withInput();
            }

            // Handle other unexpected statuses
            Log::error('Unexpected status code', ['status_code' => $statusCode, 'response' => $responseBody]);
            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        }
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

    public function invoiceList2()
    {
        return view('auth.invoice-list');
    }

    // In AuthenticationController.php

    public function storeInvoiceList(Request $request)
    {
        Log::info('Business invoice list method is called');

        try {
            // Get credentials from session
            $email = Session::get('business_email');
            $password = Session::get('business_password');

            if (!$email || !$password) {
                return redirect()->route('auth.login')
                    ->withErrors(['error' => 'Please login to access invoices']);
            }

            $payload = [
                'email' => $email,
                'password' => $password
            ];

            $apiUrl = config('api.base_url') . '/business/business_invoicelist';

            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            switch ($statusCode) {
                case 200:
                    return redirect()->route('auth.invoice-list')
                        ->with('invoices', $responseBody['data'])
                        ->with('balance', $responseBody['balance']);

                case 401:
                    return redirect()->route('auth.login')
                        ->withErrors(['error' => 'Invalid credentials. Please login again.']);

                case 422:
                    return redirect()->route('auth.invoice-list')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Validation failed']);

                default:
                    return redirect()->route('auth.invoice-list')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Failed to fetch invoices']);
            }
        } catch (\Exception $e) {
            Log::error('Unexpected error in invoice list', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('auth.invoice-list')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    public function invoiceList()
    {
        $invoices = Session::get('invoices', []);
        $balance = Session::get('balance', 0);

        return view('auth.invoice-list', compact('invoices', 'balance'));
    }

    public function fetchInvoiceList(Request $request)
    {
        Log::info('Fetch invoice list method is called');

        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            // Prepare the payload for the API
            $payload = [
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
            ];

            // Log the final payload to inspect the data being sent
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            $apiUrl = config('api.base_url') . '/business/business_invoicelist';
            Log::debug('Attempting API call to: ' . $apiUrl);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log API response for debugging
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);
                Log::info('Invoices retrieved successfully', ['data' => $responseData['data'], 'balance' => $responseData['balance']]);
                return view('your.view.name', [
                    'invoices' => $responseData['data'],
                    'balance' => $responseData['balance']
                ]);
            }

            if ($statusCode === 401) {
                $responseData = json_decode($responseBody, true);
                Log::warning('Unauthorized access', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Unauthorized access'])
                    ->withInput();
            }

            if ($statusCode === 422) {
                $responseData = json_decode($responseBody, true);
                Log::warning('Validation error from API', ['response' => $responseData]);
                return redirect()->back()
                    ->withErrors(['error' => $responseData['message'] ?? 'Validation failed'])
                    ->withInput();
            }

            // Handle other unexpected statuses
            Log::error('Unexpected status code', ['status_code' => $statusCode, 'response' => $responseBody]);
            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])
                ->withInput();
        }
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
