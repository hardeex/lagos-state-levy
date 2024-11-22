<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use ReflectionFunctionAbstract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

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

        // Get the necessary data from the session
        $email = Session::get('business_email');
        $password = Session::get('business_password');
        $industry = Session::get('lindustry');   // Get industry from session
        $subsector = Session::get('lsubsector'); // Get subsector from session

        // Check if industry or subsector is missing, log a warning if necessary
        if (!$industry || !$subsector) {
            Log::warning('Industry or subsector not found in session', [
                'email' => $email,
                'industry' => $industry,
                'subsector' => $subsector,
            ]);
        }

        // Log the session data for verification
        Log::info('Session data for declaration page', [
            'email' => $email,
            'industry' => $industry,
            'subsector' => $subsector,
        ]);

        // echo nl2br("Email: $email\n");
        // echo nl2br("Password: $password\n");
        // echo nl2br("Industry: $industry\n");
        // echo nl2br("Subsector: $subsector\n");
        // exit();


        // Fetch building types from API using session data
        $buildingTypes = $this->getBuildingTypesFromAPI($email, $password, $industry, $subsector);

        //api call to building type
        $responseCon = Http::get(env('API_REGISTER_URL') . '/business/buildingtype', [
            'email' => $email,
            'password' => $password,
            'lindustry' => $industry,
            'lsubsector' => $subsector
        ]);

        // print_r($responseCon['data']) ;


        // Fetch the business profile to get the industry and subsector
        $this->getBusinessProfile();

        // Return the view and pass the necessary data
        return view('auth.declaration', compact('branches', 'industry', 'subsector', 'email', 'password', 'buildingTypes', 'responseCon'));
    }


    public function getBuildingTypesFromAPI($email, $password, $industry, $subsector)
    {
        // Prepare API client
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/buildingtype';

        try {
            // Send POST request to Building Types API
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'lindustry' => $industry,
                    'lsubsector' => $subsector
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Log and handle successful response
            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return $responseData['data'] ?? [];
            }

            // Log and handle unexpected response format
            Log::warning('Unexpected response format from Building Types API', [
                'response' => $responseData
            ]);
            return [];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('ClientException while fetching Building Types', [
                'url' => $apiUrl,
                'exception' => $e->getMessage()
            ]);
            return [];
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            Log::error('ServerException while fetching Building Types', [
                'url' => $apiUrl,
                'exception' => $e->getMessage()
            ]);
            return [];
        } catch (\Exception $e) {
            Log::error('Unexpected error while fetching Building Types', [
                'exception' => $e->getMessage()
            ]);
            return [];
        }
    }




    private function fetchBranches($batch = 1)
    {
        //
        try {

            // Retrieve credentials from the session
            $email = Session::get('business_email');
            $password = Session::get('business_password');
            // echo "==========================" . $password ; exit() ;

            // Log current session data for debugging
            Log::info('Fetching branches - Current session data:', [
                'email' => $email,
                'password' => $password,
                'session_data' => Session::all() // Log the entire session for more context
            ]);

            if (!$email || !$password) {
                Log::warning('No stored credentials found for fetching branches');
                return Session::get('cached_branches', []); // Return cached branches
            }

            $apiUrl = config('api.base_url') . '/business/businessviewbranch';
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

            Log::info('Branch API Raw Response:', [
                'status_code' => $statusCode,
                'response_structure' => array_keys($responseBody ?? []),
                'response_type' => gettype($responseBody)
            ]);

            if ($statusCode === 200) {
                $branches = [];

                // Check for the correct response structure
                if (isset($responseBody['data']) && is_array($responseBody['data'])) {
                    $branches = $responseBody['data'];
                } elseif (isset($responseBody['branches']) && is_array($responseBody['branches'])) {
                    $branches = $responseBody['branches'];
                }
                // print_r($branches) ; exit() ;
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
            return Session::get('cached_branches', []); // Return cached branches in case of failure
        } catch (\Exception $e) {
            Log::error('Error fetching branches', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return Session::get('cached_branches', []); // Return cached branches in case of error
        }
    }



    public function finalDeclarationORIGINAL(Request $request)
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
                'branches' => $branches
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

            // Get the status code and response body
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log the full response from the API
            Log::info('Final declaration response:', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            // Check if the response status is success (200 OK)
            if ($statusCode === 200) {
                // Log all the response data to see everything
                Log::info('Final Declaration Successful. Full Data:', $responseBody);

                // Clear cached branches after successful submission
                Session::forget('cached_branches');

                // Set session variable to indicate declaration completed
                Session::put('declaration_completed', true);

                return response()->json([
                    'status' => 'success',
                    'message' => $responseBody['message'] ?? 'Declarations registered successfully!',
                    'branch_count' => count($branches),
                    'data' => $responseBody // Return the full data from the response here
                ]);
            }

            // If the status code is not 200, return an error message with the status code
            return response()->json([
                'status' => 'error',
                'message' => $responseBody['message'] ?? 'Failed to process declaration',
                'response' => $responseBody
            ], $statusCode);
        } catch (\Exception $e) {
            // Log any exceptions
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

            // Fetch and verify branches
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

            // Proceed with final declaration API call
            $apiUrl = config('api.base_url') . '/business/finaldeclearation';
            $payload = [
                'email' => $email,
                'password' => $password,
                'branches' => $branches
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
                // Log success
                Log::info('Final Declaration Successful. Full Data:', $responseBody);

                // Set session flag to indicate declaration completed
                Session::put('declaration_completed', true);

                // Clear cached branches after successful submission
                Session::forget('cached_branches');

                return response()->json([
                    'status' => 'success',
                    'message' => $responseBody['message'] ?? 'Declarations registered successfully!',
                    'branch_count' => count($branches),
                    'data' => $responseBody // Return the full data from the response here
                ]);
            }

            // If the status code is not 200, return an error message
            return response()->json([
                'status' => 'error',
                'message' => $responseBody['message'] ?? 'Failed to process declaration',
                'response' => $responseBody
            ], $statusCode);
        } catch (\Exception $e) {
            // Log any exceptions
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

        Log::info('Business declaration method is called', [
            'session_has_email' => Session::has('business_email'),
            'session_has_password' => Session::has('business_password')
        ]);

        try {
            $validatedData = $request->validate([
                'building_type' => ['required', 'string'],
                'branchName' => ['required', 'string', 'max:255'],
                'branchAddress' => ['required', 'string', 'max:255'],
                'lga' => ['required', 'string', 'max:255'],
                'contactPerson' => ['required', 'string', 'max:255'],
                'designation' => ['required', 'string', 'max:255'],
                'contactPhone' => ['required', 'string'],
                'staffcount' => ['required', 'integer']
            ]);


            // Get stored credentials from session
            $storedEmail = Session::get('business_email');
            $storedPassword = Session::get('business_password');

            if (!$storedEmail || !$storedPassword) {
                Log::warning('No stored credentials found in session', [
                    'session_data' => Session::all()
                ]);
                return redirect()->route('login')
                    ->withErrors(['error' => 'Session expired. Please login again.']);
            }

            $payload = [
                'locationType' => ucwords(strtolower($validatedData['building_type'])),
                'branchName' => $validatedData['branchName'],
                'branchAddress' => $validatedData['branchAddress'],
                'lga' => $validatedData['lga'],
                'contactPerson' => $validatedData['contactPerson'],
                'designation' => $validatedData['designation'],
                'contactPhone' => $validatedData['contactPhone'],
                'staffcount' => (string)$validatedData['staffcount'],
                'email' => $storedEmail,
                'password' => $storedPassword
            ];

            Log::info('Sending declaration request', [
                'email' => $storedEmail,
                'payload' => array_merge($payload, ['password' => '[REDACTED]'])
            ]);

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
                default:
                    return redirect()->route('auth.declaration')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Failed to add business location'])
                        ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Unexpected error in declaration', [
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
            'lphone' => ['required', 'string'],
            'lemail' => ['required', 'email'],
            'lpw' => ['required', 'string'],
            'lcpw' => ['required', 'string', 'same:lpw'],
            'lregno' => ['required', 'string'],
            'ltaxid' => ['required', 'string'],
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

        // Store industry and subsector in the session for later use
        Session::put('selected_industry', $validatedData['lindustryone']);
        Session::put('selected_subsector', $validatedData['lsubsectorone']);



        // Log basic information to track user data, including industry and subsector
        Log::info('Register attempt started for email:', [
            'email' => $validatedData['lemail'],
            'industry' => $validatedData['lindustryone'],
            'subsector' => $validatedData['lsubsectorone']
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/registeremailphoneverify';

        // Log the request payload being sent for debugging purposes
        Log::info('API Request Payload', ['url' => $apiUrl, 'data' => $validatedData]);

        try {
            // Send the API request
            $response = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $validatedData,
            ]);

            // Decode response data
            $responseData = json_decode($response->getBody(), true);

            // Check the response and handle accordingly
            if (isset($responseData['status'])) {
                if ($responseData['status'] === 'success') {
                    Log::info('API request successful', ['response' => $responseData]);

                    // Store email in session and redirect to next step
                    session(['business_email' => $validatedData['lemail']]);
                    session('selected_industry', $validatedData['lindustryone']);
                    session('selected_subsector', $validatedData['lsubsectorone']);
                    return redirect()->route('auth.user-otp-verify')->with('success', $responseData['message']);
                } else {
                    // Log error and return feedback to user
                    Log::warning('API returned failure', ['response' => $responseData]);
                    return redirect()->back()->withErrors(['error' => $responseData['message']]);
                }
            } else {
                Log::error('Unexpected response structure', ['response' => $responseData]);
                return redirect()->back()->withErrors(['error' => 'Unable to process your request. Please try again later.']);
            }
        } catch (RequestException $e) {
            // Log specific request error details
            Log::error('Request Exception occurred', [
                'message' => $e->getMessage(),
                'request' => (string) $e->getRequest()->getBody(),
                // 'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
                'payload' => $validatedData,
            ]);
            return redirect()->back()->withErrors(['error' => 'There was an issue connecting to the server. Please try again later.']);
        } catch (\Exception $e) {
            // Log any other general errors
            Log::error('General exception occurred', [
                'exception' => $e->getMessage(),
                'request' => $validatedData,
            ]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
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


        Log::info('Incoming login request data', ['request' => $request->except('lpw')]);

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

            // Store credentials in session before handling response
            Session::put('business_email', $validatedData['lemail']);
            Session::put('business_password', $validatedData['lpw']);



            // Log the credentials storage
            Log::info('Credentials stored in session', [
                'email' => $validatedData['lemail'],
                'session_has_email' => Session::has('business_email'),
                'session_has_password' => Session::has('business_password'),
            ]);

            // Fetch business profile to get the industry and subsector
            if (isset($responseData['data'])) {
                $profile_data = $responseData['data'];

                // Store the industry and subsector in the session
                // Session::put('lindustry', $profile_data['lindustry']);
                // Session::put('lsubsector', $profile_data['lsubsector']);


                // Log::info('Industry and Subsector stored in session', [
                //     'lindustry' => $profile_data['lindustry'],
                //     'lsubsector' => $profile_data['lsubsector'],
                // ]);
            }

            // To prevent users having issues with the declaration, check if the required payload is available first
            if (!Session::has('business_email') || !Session::has('business_password') || !Session::has('lindustry') || !Session::has('lsubsector')) {
                // Log that session has expired
                Log::warning('Session expired or missing required data', [
                    'email' => Session::get('business_email'),
                    'industry' => Session::get('lindustry'),
                    'subsector' => Session::get('lsubsector')
                ]);

                // Redirect to login page with an expired session message
                return redirect()->route('auth.login-user')
                    ->with('error', 'Your session has expired. Please log in again.');
            }


            // Handle the response based on status codes and response data
            return $this->handleLoginResponse($responseData, $validatedData['lemail']);
        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $responseBody = $e->hasResponse() ? json_decode($e->getResponse()->getBody(), true) : null;

            // Log the error with detailed information
            Log::error('Login request failed', [
                'status_code' => $statusCode,
                'request' => array_merge($payload, ['password' => '[REDACTED]']),
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
                    // Store credentials before redirecting to declaration
                    if ($responseBody && $responseBody['message'] === 'Business declaration required!') {
                        Session::put('business_email', $validatedData['lemail']);
                        Session::put('business_password', $validatedData['lpw']);

                        // Log that credentials are stored before declaration
                        Log::info('Storing credentials before declaration redirect', [
                            'email' => $validatedData['lemail'],
                            'session_has_email' => Session::has('business_email'),
                            'session_has_password' => Session::has('business_password')
                        ]);

                        // Fetch the business profile to get the industry and subsector
                        $this->getBusinessProfile();
                        return redirect()->route('auth.declaration')
                            ->with('info', 'Please complete the business declaration process to access your account.');
                    }
                    return redirect()->back()
                        ->withErrors(['error' => $responseBody['message'] ?? 'Access denied.'])
                        ->withInput($request->except('lpw'));

                default:
                    return redirect()->back()
                        ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                        ->withInput($request->except('lpw'));
            }
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
        Log::info('Processing login response', [
            'email' => $email,
            'status' => $responseData['status'] ?? 'unknown',
            'has_token' => isset($responseData['token']),
            'has_user' => isset($responseData['user'])
        ]);

        if (!isset($responseData['status'])) {
            Log::error('Unexpected response format from login API', [
                'response' => array_keys($responseData)
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Unexpected response from the server.'])
                ->withInput();
        }

        if ($responseData['status'] === 'success') {
            // Store all necessary session data
            if (isset($responseData['token'])) {
                Session::put('auth_token', $responseData['token']);
            }

            if (isset($responseData['user'])) {
                Session::put('user', $responseData['user']);
            }

            if (isset($responseData['data']['balance'])) {
                Session::put('balance', $responseData['data']['balance']);
            }

            // Verify all required session data is present
            Log::info('Session data after login', [
                'has_auth_token' => Session::has('auth_token'),
                'has_user_data' => Session::has('user'),
                'has_balance' => Session::has('balance'),
                'has_business_email' => Session::has('business_email'),
                'has_business_password' => Session::has('business_password'),
                'has_lindustry' => Session::has('lindustry'),
                'has_lsubsector' => Session::has('lsubsector')
            ]);

            return redirect()->route('auth.billing')
                ->with('success', $responseData['message'] ?? 'Login successful!');
        }

        // If business declaration is required
        if (isset($responseData['message']) && $responseData['message'] === 'Business declaration required!') {
            Log::info('Redirecting to business declaration', [
                'email' => $email,
                'has_stored_credentials' => Session::has('business_email') && Session::has('business_password')
            ]);

            return redirect()->route('auth.declaration')
                ->with('info', 'Please complete the business declaration process.');
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




    // public function getBusinessProfile()
    // {
    //     Log::info('Fetching business profile');

    //     // Ensure the user is logged in or has a valid session
    //     $email = Session::get('business_email');
    //     $password = Session::get('business_password'); // Retrieve password from session

    //     // If email or password is missing, log and return an error response
    //     if (!$email || !$password) {
    //         Log::warning('User not logged in or missing credentials');
    //         return response()->json(['error' => 'User not logged in or missing credentials'], 401);
    //     }

    //     // Create the API client
    //     $client = new Client();
    //     $apiUrl = config('api.base_url') . '/business/profile';

    //     // Prepare the payload to send to the API
    //     $payload = [
    //         'email' => $email,
    //         'password' => $password
    //     ];

    //     // Prepare headers for the request
    //     $headers = [
    //         'Content-Type' => 'application/json',
    //         'Accept' => 'application/json',
    //     ];

    //     try {
    //         // Send the request to the API with the payload and headers
    //         $response = $client->post($apiUrl, [
    //             'headers' => $headers,
    //             'json' => $payload // Send email and password in the JSON body
    //         ]);

    //         // Decode the response from the API
    //         $responseData = json_decode($response->getBody(), true);

    //         // Check if the response is valid
    //         if (isset($responseData['status']) && $responseData['status'] === 'success') {
    //             // Save the whole response in the profile_data variable
    //             $profile_data = $responseData['data'];

    //             // Save the industry and subsector in session separately
    //             Session::put('lindustry', $profile_data['lindustry']);
    //             Session::put('lsubsector', $profile_data['lsubsector']);

    //             // Log the data being stored in session
    //             Log::info('Saved profile data to session', [
    //                 'lindustry' => $profile_data['lindustry'],
    //                 'lsubsector' => $profile_data['lsubsector'],
    //                 'Full profile data' => $profile_data
    //             ]);

    //             // Return the successful response
    //             return response()->json($responseData, 200); // Return success data
    //         } else {
    //             Log::warning('Failed to retrieve business profile', ['response' => $responseData]);
    //             return response()->json(['error' => 'Failed to retrieve business profile'], 500);
    //         }
    //     } catch (\Exception $e) {
    //         // Log any errors or exceptions
    //         Log::error('Error fetching business profile', ['exception' => $e->getMessage()]);
    //         return response()->json(['error' => 'An error occurred while fetching the profile'], 500);
    //     }
    // }



    public function getBusinessProfile()
    {
        Log::info('Fetching business profile');

        // Ensure the user is logged in or has a valid session
        $email = Session::get('business_email');
        $password = Session::get('business_password'); // Retrieve password from session

        // If email or password is missing, log and return an error response
        if (!$email || !$password) {
            Log::warning('User not logged in or missing credentials');
            return null; // Return null if no credentials
        }

        // Create the API client
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/profile';

        // Prepare the payload to send to the API
        $payload = [
            'email' => $email,
            'password' => $password
        ];

        // Prepare headers for the request
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        try {
            // Send the request to the API with the payload and headers
            $response = $client->post($apiUrl, [
                'headers' => $headers,
                'json' => $payload // Send email and password in the JSON body
            ]);

            // Decode the response from the API
            $responseData = json_decode($response->getBody(), true);

            // Check if the response is valid
            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                // Save the profile data and other necessary details to session
                $profile_data = $responseData['data'];

                // Save the industry and subsector in session separately
                Session::put('lindustry', $profile_data['lindustry']);
                Session::put('lsubsector', $profile_data['lsubsector']);

                // Log the data being stored in session
                Log::info('Saved profile data to session', [
                    'lindustry' => $profile_data['lindustry'],
                    'lsubsector' => $profile_data['lsubsector'],
                    'Full profile data' => $profile_data
                ]);

                // Return the profile data
                return $profile_data; // Return data directly, not a JsonResponse
            } else {
                Log::warning('Failed to retrieve business profile', ['response' => $responseData]);
                return null; // Return null if API call failed
            }
        } catch (\Exception $e) {
            // Log any errors or exceptions
            Log::error('Error fetching business profile', ['exception' => $e->getMessage()]);
            return null; // Return null if there's an error
        }
    }


    public function logoutUser(Request $request)
    {

        Session::flush();


        return redirect('/');
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
        $apiUrl = config('api.base_url') . '/forgot-password'; // end-point to be confirmed

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
            Log::info('Raw Sub-Industry Sector API response', [
                'response' => $responseData
            ]);


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




    public function getBuildingTypes(Request $request)
    {
        // Get the industry and sub-sector from the session
        $selectedIndustry = session('selected_industry');
        $selectedSubsector = session('selected_subsector');
        $email = Session::get('business_email');
        $password = Session::get('business_password');

        // Check if all required session data is present
        if (empty($selectedIndustry) || empty($selectedSubsector) || empty($email) || empty($password)) {
            Log::error('Missing required session data', [
                'selectedIndustry' => $selectedIndustry,
                'selectedSubsector' => $selectedSubsector,
                'email' => $email,
                'password' => $password
            ]);
            return response()->json(['message' => 'Missing required session data'], 400);
        }

        Log::info('User requested Building Types data', [
            'industry' => $selectedIndustry,
            'subsector' => $selectedSubsector,
            'request_data' => $request->all()
        ]);

        try {
            // Prepare API client
            $client = new Client();
            $apiUrl = config('api.base_url') . '/business/buildingtype';

            // Log the request being sent to the API (without sensitive data)
            Log::info('Sending request to Building Types API', [
                'url' => $apiUrl,
                'payload' => [
                    'email' => $email,
                    'password' => '******', // Masked password
                    'lindustry' => $selectedIndustry,
                    'lsubsector' => $selectedSubsector
                ]
            ]);

            // Send POST request to API
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'lindustry' => $selectedIndustry,
                    'lsubsector' => $selectedSubsector
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            Log::info('Response data', ['data' => $responseData]);

            // Handle successful response
            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            // Log and handle unexpected response format
            Log::warning('Unexpected response format from Building Types API', [
                'response' => $responseData
            ]);
            return response()->json(['message' => 'Unexpected response format from API'], 500);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('ClientException while fetching Building Types', [
                'url' => $apiUrl,
                'exception' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Client error occurred'], 400);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            Log::error('ServerException while fetching Building Types', [
                'url' => $apiUrl,
                'exception' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Server error occurred'], 500);
        } catch (\Exception $e) {
            Log::error('Unexpected error while fetching Building Types', [
                'exception' => $e->getMessage()
            ]);
            return response()->json(['message' => 'An unexpected error occurred'], 500);
        }
    }

    // building type
    public function getBuildingTypes33(Request $request)
    {
        // Get the industry and sub-sector from the session
        $selectedIndustry = session('selected_industry');
        $selectedSubsector = session('selected_subsector');

        // Retrieve credentials from the session
        $email = Session::get('business_email');
        $password = Session::get('business_password');

        Log::info('User requested Building Types data', [
            'industry' => $selectedIndustry,
            'subsector' => $selectedSubsector,
            'request_data' => $request->all()
        ]);

        try {
            // Validate the request
            // $validated = $request->validate([
            //     'email' => 'required|email',
            //     'password' => 'required|string',
            // ]);

            $client = new Client();
            $apiUrl = config('api.base_url') . '/business/buildingtype';

            // Log the request being sent to the API
            Log::info('Sending request to Building Types API', [
                'url' => $apiUrl,
                'payload' => [
                    'email' => $email,
                    'password' => $password,
                    'lindustry' => $selectedIndustry,
                    'lsubsector' => $selectedSubsector
                ]
            ]);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'lindustry' => $selectedIndustry,
                    'lsubsector' => $selectedSubsector
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            Log::info('Response data', ['data' => $responseData]);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json($responseData['data'] ?? []);
            }

            Log::warning('Unexpected response format from Building Types API', [
                'response' => $responseData
            ]);

            return view('auth.declaration', compact('selectedIndustry', 'selectedSubsector'));
        } catch (\Exception $e) {
            Log::error('Failed to load Building Types data: ' . $e->getMessage(), [
                'url' => $apiUrl ?? null,
                'industry' => $selectedIndustry ?? null,
                'subsector' => $selectedSubsector ?? null,
                'exception' => $e,
            ]);

            $statusCode = 500;
            if ($e instanceof \GuzzleHttp\Exception\ClientException) {
                $statusCode = $e->getResponse()->getStatusCode();
            }

            return response()->json([
                'message' => 'Failed to load building types: ' . $e->getMessage()
            ], $statusCode);
        }
    }


    public function calendar()
    {
        return view('auth.calendar');
    }

    public function visitationsList()
    {
        Log::info('Attempting to fetch visitation list');

        // Retrieve the email and password from the session
        $email = session('business_email');
        $password = session('business_password');

        // Check if email and password exist in session
        if (!$email || !$password) {
            return redirect()->route('auth.login')->withErrors(['error' => 'You must be logged in to access the visitation list.']);
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/visitationlist';

        try {
            $payload = [
                'email' => $email,
                'password' => $password,
            ];

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            // Decode the response
            $responseData = json_decode($responseBody, true);

            // Check the response status
            if ($statusCode === 200 && isset($responseData['status']) && $responseData['status'] === 'success') {
                Log::info('Visitation list fetched successfully', ['data' => $responseData['message']]);
                return view('auth.visitation-list', ['message' => $responseData['message']]);
            }

            // Handle other error status codes
            if ($statusCode === 401) {
                Log::warning('Unauthorized access', ['response' => $responseData]);
                return redirect()->route('auth.login')->withErrors(['error' => 'Unauthorized access. Please login again.']);
            }

            if ($statusCode === 422) {
                Log::warning('Validation error from API', ['response' => $responseData]);
                return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Validation failed']);
            }

            // Handle other unexpected statuses
            Log::error('Unexpected status code', ['status_code' => $statusCode, 'response' => $responseBody]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        } catch (\Exception $e) {
            Log::error('Unexpected error while fetching visitation list', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }


    public function scheduleVisitationDate(Request $request)
    {
        Log::info('Attempting to schedule visitation date');

        // Retrieve credentials from the session
        $email = session('business_email');
        $password = session('business_password');

        // Check if email and password exist in session
        if (!$email || !$password) {
            return redirect()->route('auth.login')->withErrors(['error' => 'You must be logged in to schedule a visitation.']);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'schedule_date' => ['required', 'date_format:d/m/Y'],
            'branchid' => ['required', 'string'],
        ]);

        // Retrieve the branch ID and schedule date from the validated request data
        $branchId = $validatedData['branchid'];
        $scheduleDate = $validatedData['schedule_date'];

        // Log the data we're going to send
        Log::info('Scheduling visitation', [
            'email' => $email,
            'branchid' => $branchId,
            'schedule_date' => $scheduleDate
        ]);

        // Prepare the payload for the API request
        $payload = [
            'email' => $email,
            'password' => $password,
            'branchid' => $branchId,
            'schedule_date' => $scheduleDate,
        ];

        // Call the API to schedule the visitation
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/shedulevisitationdate';

        try {
            // Make the POST request to the API
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log the response from the API
            Log::info('API Response for scheduling visitation', [
                'statusCode' => $statusCode,
                'response' => $responseBody
            ]);

            // Handle the response based on the status code
            if ($statusCode === 200) {
                // Success - Visitation scheduled successfully
                return redirect()->route('auth.calendar')->with('success', 'Visitation scheduled successfully.');
            }

            // Handle unauthorized access
            if ($statusCode === 401) {
                return redirect()->route('auth.login')->withErrors(['error' => 'Unauthorized access. Please log in again.']);
            }

            // Handle validation errors from the API
            if ($statusCode === 422) {
                return redirect()->back()->withErrors(['error' => $responseBody['message'] ?? 'Validation failed']);
            }

            // Handle other unexpected statuses
            Log::error('Unexpected error when scheduling visitation', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        } catch (\Exception $e) {
            // Log any exception that occurs during the API request
            Log::error('Unexpected error scheduling visitation', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }


    public function uploadDocument(Request $request)
    {
        Log::info('Attempting to upload document');

        // Validate incoming request data
        $validatedData = $request->validate([
            'docimage' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'imgsource' => ['required', 'string'],
            'author' => ['required', 'email'],
            'bizemail' => ['required', 'email'],
            'comment' => ['required', 'string'],
            'docid' => ['required', 'string'],
            'documenttype' => ['required', 'in:Financial,Technical'],
            'password' => ['required', 'string'],
        ]);

        // Retrieve user credentials from the session
        $email = session('business_email');
        $password = session('business_password');

        // Check if credentials exist in session
        if (!$email || !$password) {
            return redirect()->route('auth.login')->withErrors(['error' => 'You must be logged in to upload a document.']);
        }

        // Retrieve the uploaded file from the request
        $file = $request->file('docimage');

        // Prepare the file for upload
        $filePath = $file->getRealPath();
        $fileName = $file->getClientOriginalName();
        $fileMimeType = $file->getMimeType();

        // Prepare the payload for the API request
        $payload = [
            'imgsource' => $validatedData['imgsource'],
            'author' => $validatedData['author'],
            'bizemail' => $validatedData['bizemail'],
            'comment' => $validatedData['comment'],
            'docid' => $validatedData['docid'],
            'documenttype' => $validatedData['documenttype'],
            'password' => $validatedData['password'],
        ];

        // Create a new Guzzle HTTP client to make the API call
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/documentupload';

        try {
            // Make the POST request to the API with the file
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'multipart' => [
                    [
                        'name' => 'docimage',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                        'headers'  => [
                            'Content-Type' => $fileMimeType
                        ]
                    ],
                    [
                        'name' => 'imgsource',
                        'contents' => $payload['imgsource']
                    ],
                    [
                        'name' => 'author',
                        'contents' => $payload['author']
                    ],
                    [
                        'name' => 'bizemail',
                        'contents' => $payload['bizemail']
                    ],
                    [
                        'name' => 'comment',
                        'contents' => $payload['comment']
                    ],
                    [
                        'name' => 'docid',
                        'contents' => $payload['docid']
                    ],
                    [
                        'name' => 'documenttype',
                        'contents' => $payload['documenttype']
                    ],
                    [
                        'name' => 'password',
                        'contents' => $payload['password']
                    ]
                ]
            ]);

            // Get the response status code and body
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log the API response
            Log::info('Document upload response', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            // Handle the response based on status code
            if ($statusCode === 200) {
                // Document uploaded successfully
                return redirect()->route('auth.document-list')->with('success', 'Document uploaded successfully.');
            }

            // Handle error from the API
            Log::error('Document upload failed', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);
            return redirect()->back()->withErrors(['error' => $responseBody['message'] ?? 'An unexpected error occurred.']);
        } catch (\Exception $e) {
            // Log any exception that occurs during the API request
            Log::error('Unexpected error during document upload', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }


    public function getDoc(Request $request)
    {
        Log::info('Attempting to fetch document');

        // Retrieve user credentials from the session 
        $email = session('business_email');
        $password = session('business_password');

        // Check if email and password exist in the session
        if (!$email || !$password) {
            return redirect()->route('auth.login')->withErrors(['error' => 'You must be logged in to fetch the document.']);
        }

        // Validate incoming request data (docid is required)
        $validatedData = $request->validate([
            'docid' => ['required', 'string'],
        ]);

        // Prepare the payload for the API request
        $payload = [
            'docid' => $validatedData['docid'],
            'bizemail' => $email,
            'password' => $password,
        ];

        // Create a new Guzzle HTTP client to make the API call
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/getdoc';

        try {
            // Make the POST request to the API
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Get the response status code and body
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log the API response
            Log::info('API Response for getdoc', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            // Handle the response based on status code
            if ($statusCode === 200) {
                // Document fetched successfully
                $document = $responseBody['data'] ?? null;
                if ($document) {
                    return view('auth.document-view', compact('document'))->with('success', 'Document fetched successfully.');
                } else {
                    return redirect()->back()->withErrors(['error' => 'Document not found.']);
                }
            }

            // Handle error from the API
            $errorMessage = $responseBody['message'] ?? 'An unexpected error occurred';
            Log::error('Failed to fetch document', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        } catch (\Exception $e) {
            // Log any exception that occurs during the API request
            Log::error('Unexpected error while fetching document', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
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

            $apiUrl = config('api.base_url') . '/business/businessbranchdelete';

            $payload = [
                'email' => $email,
                'password' => $password,
                'branchid' => (int)$validatedData['branch_id']
            ];

            // Log the request payload for debugging
            Log::info('Deleting branch with payload:', [
                'email' => $email,
                'branchid' => $payload['branchid']
            ]);

            $response = $this->client->delete($apiUrl, [
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
                return view('auth.declaration', ['branches' => $responseData['data']]);
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
        // Get the business profile data
        $profile = $this->getBusinessProfile();

        // Check if profile data was retrieved successfully
        if ($profile) {
            // Pass the profile data to the view
            return view('auth.billing', [
                'businessName' => $profile['lbizname'],
                'businessEmail' => $profile['lemail'],
                'businessPhone' => $profile['lphone'],
                'businessTaxId' => $profile['ltaxid'],
                'businessAddress' => $profile['ladd'],
                'businessIndustry' => $profile['lindustry'],
                'businessIncorporation' => $profile['lincorporation'],
                'businessSector' => $profile['lindustry'],
                'businessLocations' => $profile['lregno'],
                'outstandingReturns' => $profile['ldeclarations'],
                'nextVisitation' => $profile['lfirstvisitation'],
                'businessStatus' => $profile['lstatus'],
            ]);
        } else {
            // Handle the error if profile is not retrieved
            return redirect()->route('auth.declaration')->with('error', 'Failed to retrieve business profile');
        }
    }


    // public function accountHistory()
    // {
    //     return view('auth.account-history');
    // }

    public function accountHistory(Request $request)
    {
        Log::info('Fetch account history method is called');

        try {
            // Retrieve email and password from session
            $email = Session::get('business_email');
            $password = Session::get('business_password');

            // Validate that email and password are available in session
            if (!$email || !$password) {
                Log::warning('No email or password found in session');
                return redirect()->route('login')->withErrors(['error' => 'Please log in first.']);
            }

            // Prepare the payload for the API
            $payload = [
                'email' => $email,
                'password' => $password,
            ];

            // Log the final payload to inspect the data being sent
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            // Initialize Guzzle client
            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            // Define the API URL
            $apiUrl = config('api.base_url') . '/business/businessaccthistory';
            Log::debug('Attempting API call to: ' . $apiUrl);

            // Make the POST request to the API
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log the API response
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            // Check the response status code
            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);

                // Save the retrieved account history data in the session
                if (isset($responseData['data']) && is_array($responseData['data'])) {
                    Session::put('account_history', $responseData['data']);
                    Log::info('Account history retrieved successfully', ['data' => $responseData['data']]);
                    return view('auth.account-history', ['accountHistory' => $responseData['data']]);
                } else {
                    Log::warning('No account history data found', ['response' => $responseData]);
                    return redirect()->back()->withErrors(['error' => 'No account history found.']);
                }
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

    public function officialReturns()
    {
        return  view('auth.official-returns');
    }



    public function invoiceList()
    {
        $invoices = Session::get('invoices', []);
        $balance = Session::get('balance', 0);

        print_r($invoices);
        exit();

        return view('auth.invoice-list', compact('invoices', 'balance'));
    }


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

            // Prepare payload
            $payload = [
                'email' => $email,
                'password' => $password
            ];

            // API endpoint URL
            $apiUrl = config('api.base_url') . '/business/business_invoicelist';

            // Make the API request
            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            // Get response status code and body
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Check for different response statuses
            if ($statusCode === 200) {
                // Calculate accumulated sum of the invoice amounts
                $invoices = $responseBody['data'] ?? [];
                $totalBalance = 0;

                // Sum up the 'lamount' for each invoice
                foreach ($invoices as $invoice) {
                    $totalBalance += $invoice['lamount'] ?? 0;
                }

                // Pass the invoices and total balance to the view
                return redirect()->route('auth.invoice-list')
                    ->with('invoices', $invoices)
                    ->with('balance', $totalBalance);
            }

            // Handle various error statuses
            $errorMessage = $responseBody['message'] ?? 'Unexpected error occurred';

            switch ($statusCode) {
                case 401:
                    // Handle invalid credentials
                    Log::warning('Invalid credentials for invoice list', [
                        'email' => $email
                    ]);
                    return redirect()->route('auth.login')
                        ->withErrors(['error' => 'Invalid credentials. Please login again.']);

                case 422:
                    // Handle validation errors
                    Log::warning('Validation failed for invoice list', [
                        'response' => $responseBody
                    ]);
                    return redirect()->route('auth.invoice-list')
                        ->withErrors(['error' => $responseBody['message'] ?? 'Validation failed']);

                default:
                    // Handle all other errors
                    Log::error('Failed to fetch invoices', [
                        'response' => $responseBody,
                        'status_code' => $statusCode
                    ]);
                    return redirect()->route('auth.invoice-list')
                        ->withErrors(['error' => $errorMessage]);
            }
        } catch (\Exception $e) {
            // Catch any unexpected exceptions and log them
            Log::error('Unexpected error in invoice list', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('auth.invoice-list')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }


    public function viewInvoice($invoiceId)
    {
        // Fetch the invoices from the session
        $invoices = Session::get('invoices', []);

        // Print out the invoices array to verify that it's being retrieved correctly
        // print_r($invoices); 
        // exit(); 

        // Find the invoice with the provided id
        $invoice = collect($invoices)->firstWhere('id', $invoiceId);

        // Print the found invoice to verify if it's being retrieved correctly
        //print_r($invoice); 
        //exit(); 

        // If invoice is not found
        if (!$invoice) {
            return redirect()->route('auth.invoice-list')->with('error', 'Invoice not found');
        }

        // Pass the invoice data to the view
        return view('auth.invoice-view', compact('invoice'));
    }



    public function payInvoice(Request $request)
    {
        Log::info('Attempting to pay invoice');

        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'invoiceid' => ['required', 'string']
            ]);

            // Retrieve the email and password from the session
            $email = session('business_email');
            $password = session('business_password');

            // Check if email and password exist in session
            if (!$email || !$password) {
                return redirect()->route('auth.login')->withErrors(['error' => 'You must be logged in to make a payment.']);
            }

            // Prepare the payload for the API
            $payload = [
                'email' => $email,
                'password' => $password,
                'invoiceid' => $validatedData['invoiceid'],
            ];

            // Log the final payload to inspect the data being sent
            Log::info('Final payload being sent to API', ['payload' => $payload]);

            $client = new Client([
                'timeout' => 30,
                'connect_timeout' => 5,
                'http_errors' => false,
                'verify' => false
            ]);

            // Define the API URL
            $apiUrl = config('api.base_url') . '/business/invoicepaydemo';
            Log::debug('Attempting API call to: ' . $apiUrl);

            // Make the POST request to the API
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log the API response
            Log::info('API Response', [
                'statusCode' => $statusCode,
                'body' => $responseBody
            ]);

            // Check the response status code
            if ($statusCode === 200) {
                $responseData = json_decode($responseBody, true);
                Log::info('Payment processed successfully', ['data' => $responseData['data']]);

                // Handle success - you can redirect to an invoice list or payment confirmation page
                return redirect()->route('auth.invoice-list')
                    ->with('success', $responseData['message'] ?? 'Payment was successful.');
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




    // public function viewInvoice33($invoiceId)
    // {


    //     // Get the invoices from session
    //     $invoices = Session::get('invoices', []);
    //     $inv = [];

    //     foreach ($invoices as $invoice) {
    //         if ($invoice['id'] == $invoiceId) {
    //             $inv = $invoice;
    //         }
    //     }

    //     print_r($inv);
    //     exit();

    //     // print_r($invoices);
    //     // exit();
    //     // Find the specific invoice by its ID
    //     $invoice = collect($invoices)->firstWhere('id', $inv);

    //     // Check if the invoice exists
    //     // if (!$invoice) {
    //     //     return redirect()->route('auth.invoice-list')->withErrors(['error' => 'Invoice not found']);
    //     // }

    //     // Return the invoice-view with the selected invoice data
    //     return view('auth.invoice-view', compact('inv'));
    // }






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

                // Dump the responseData to inspect its structure
                //dd($responseData);
                // Store invoice data in session to be accessed later
                session(['invoices_data' => $responseData['data']]);

                return view('auth.invoice', [
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
        // Check if declaration has been completed
        if (!Session::get('declaration_completed', false)) {
            return redirect()->route('auth.declaration')->with('error', 'You must complete the final declaration before accessing the dashboard.');
        }

        return view('auth.dashboard');
    }



    public function safetyConsultantLogin()
    {
        return view('auth.safety-consultant-login');
    }
}
