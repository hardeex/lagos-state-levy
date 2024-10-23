<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;


class TestingGroundController extends Controller
{
   
    /**
     * Load industry options for registration form
     */
    public function loadIndustry()
    {
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadindustry';

        try {
            $response = $client->get($apiUrl);
            return response()->json(json_decode($response->getBody(), true));
        } catch (\Exception $e) {
            Log::error('Failed to load industries: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load industries'], 500);
        }
    }

    /**
     * Load subsector options based on selected industry
     */
    public function loadSubSector(Request $request)
    {
        $validatedData = $request->validate([
            'industry_id' => ['required', 'numeric']
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadsubsector';

        try {
            $response = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $validatedData
            ]);
            return response()->json(json_decode($response->getBody(), true));
        } catch (\Exception $e) {
            Log::error('Failed to load subsectors: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load subsectors'], 500);
        }
    }

    /**
     * Load LGA/LCDA options --- CONSUMED
     */
    public function loadLGALCDA()
    {
        $client = new Client();
        $apiUrl = config('api.base_url') . '/loadlgalcda';

        try {
            $response = $client->get($apiUrl);
            return response()->json(json_decode($response->getBody(), true));
        } catch (\Exception $e) {
            Log::error('Failed to load LGA/LCDA: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load LGA/LCDA'], 500);
        }
    }

    /**
     * Add a new business branch
     */
    public function addBranch(Request $request)
    {
        $validatedData = $request->validate([
            'branch_name' => ['required', 'string', 'max:255'],
            'branch_address' => ['required', 'string', 'max:255'],
            'branch_lga' => ['required', 'string', 'max:255'],
            'branch_state' => ['required', 'string', 'max:255'],
            'branch_country' => ['required', 'string', 'max:255'],
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/businessaddbranch';

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
                'json' => $validatedData
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->back()->with('success', $responseData['message']);
            }

            return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Failed to add branch']);
        } catch (\Exception $e) {
            Log::error('Failed to add branch: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add branch']);
        }
    }

    /**
     * View business branches
     */
    public function viewBranches(Request $request)
    {
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/businessviewbranch';

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('auth_token')
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return view('business.branches', ['branches' => $responseData['data']]);
            }

            return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Failed to load branches']);
        } catch (\Exception $e) {
            Log::error('Failed to view branches: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to load branches']);
        }
    }

    /**
     * Delete a business branch
     */
    public function deleteBranch(Request $request)
    {
        $validatedData = $request->validate([
            'branch_id' => ['required', 'numeric']
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/businessbranchdelete';

        try {
            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
                'json' => $validatedData
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->back()->with('success', $responseData['message']);
            }

            return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Failed to delete branch']);
        } catch (\Exception $e) {
            Log::error('Failed to delete branch: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete branch']);
        }
    }

    /**
     * View business invoices
     */
    public function viewInvoices(Request $request)
    {
        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/business_invoicelist';

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('auth_token')
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return view('business.invoices', ['invoices' => $responseData['data']]);
            }

            return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Failed to load invoices']);
        } catch (\Exception $e) {
            Log::error('Failed to view invoices: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to load invoices']);
        }
    }

    /**
     * Submit final declaration
     */
    public function submitDeclaration(Request $request)
    {
        $validatedData = $request->validate([
            'declaration' => ['required', 'accepted']
        ]);

        $client = new Client();
        $apiUrl = config('api.base_url') . '/business/finaldeclearation';

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
                'json' => $validatedData
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->route('business.dashboard')->with('success', $responseData['message']);
            }

            return redirect()->back()->withErrors(['error' => $responseData['message'] ?? 'Failed to submit declaration']);
        } catch (\Exception $e) {
            Log::error('Failed to submit declaration: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to submit declaration']);
        }
    }
}

