<div class="container mx-auto px-4 py-8">

    <div class="space-y-4 max-w-2xl mx-auto p-4">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-red-800 font-medium">There were some errors with your submission</h3>
                </div>
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Billing System</h1>

    {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-xl font-semibold text-blue-600">Business Information</h2>
                <p class="text-gray-600">Business Name: $businessName</p>
                <p class="text-gray-600">Business Address: $businessAddress </p>
                <p class="text-gray-600">Business Sector: $businessSector</p>
                <p class="text-gray-600">No. of Business Locations: $businessLocations </p>
            </div>
            <div>
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    Outstanding: No
                </span>
                <p class="text-gray-600 mt-2">Outstanding Returns: $outstandingReturns </p>
                <p class="text-gray-600">Next Visitation: $nextVisitation </p>
            </div>
        </div>
    </div> --}}

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <!-- Business Information Section -->
        <div class="flex justify-between items-start space-x-8 mb-6">
            <div class="flex-1 space-y-4">
                <h2 class="text-2xl font-semibold text-blue-600">Business Profile</h2>

                <div class="space-y-2 text-gray-600">
                    <p><span class="font-semibold">Business Name:</span> {{ $businessName }}</p>
                    <p><span class="font-semibold">Business Email:</span> {{ $businessEmail }}</p>
                    <p><span class="font-semibold">Business Phone:</span> {{ $businessPhone }}</p>
                    <p><span class="font-semibold">Business Address:</span> {{ $businessAddress }}</p>
                    <p><span class="font-semibold">Industry:</span> {{ $businessIndustry }}</p>
                    <p><span class="font-semibold">Sub Sector:</span> {{ $businessSector }}</p>
                    <p><span class="font-semibold">Year of Incorporation:</span> {{ $businessIncorporation }}</p>
                    <p><span class="font-semibold">Business RC Number:</span> {{ $businessLocations }}</p>
                    <p><span class="font-semibold">Tax Identification Number:</span> {{ $businessTaxId }}</p>
                </div>
            </div>

            <!-- Business Status Section -->
            <div class="flex-1 space-y-4">
                <h2 class="text-2xl font-semibold text-blue-600">Business Status</h2>

                <div class="space-y-2 text-gray-600">
                    <p><span class="font-semibold">Outstanding Returns:</span>
                        <span
                            class="inline-block py-1 px-3 rounded-full text-white {{ $outstandingReturns === 'YES' ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ $outstandingReturns }}
                        </span>
                    </p>
                    <p><span class="font-semibold">First Visitation Status:</span> {{ $nextVisitation }}</p>
                    <p><span class="font-semibold">Business Status:</span>
                        <span
                            class="inline-block py-1 px-3 rounded-full text-white 
                        {{ $businessStatus === 'ENABLED' ? 'bg-green-500' : 'bg-gray-500' }}">
                            {{ $businessStatus }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-6 border-t-2 border-gray-300">


        <div class="space-y-4 text-gray-600">
            <h2 class="text-xl font-semibold text-blue-600">Additional Information</h2>
            <p class="text-gray-600 mt-2">Outstanding Returns: $outstandingReturns </p>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="{{ route('auth.official-returns') }}">
                <i class="fas fa-file-invoice text-4xl text-blue-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Official Returns</h3>
                <p class="text-gray-600">Manage and submit your official returns securely.</p>
            </a>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="{{ route('auth.invoice-list') }}">
                <i class="fas fa-credit-card text-4xl text-green-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Instant Online Payment</h3>
                <p class="text-gray-600">Make quick and secure online payments for your bills.</p>
            </a>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="#">
                <i class="fas fa-university text-4xl text-purple-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Goto Bank-Offline Payment</h3>
                <p class="text-gray-600">Generate payment slips for offline bank transactions.</p>
            </a>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="{{ route('auth.upload-receipt') }}">
                <i class="fas fa-upload text-4xl text-orange-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Upload Receipt</h3>
                <p class="text-gray-600">Upload and manage your payment receipts easily.</p>
            </a>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="{{ route('auth.account-history') }}">
                <i class="fas fa-history text-4xl text-indigo-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Account History</h3>
                <p class="text-gray-600">View your complete account and transaction history.</p>
            </a>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
            <a href="{{ route('auth.generate-invoice') }}">
                <i class="fas fa-file-alt text-4xl text-red-500 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Invoices/Bills</h3>
                <p class="text-gray-600">Access and download your invoices and bills.</p>
            </a>

        </div>
    </div>
</div>
