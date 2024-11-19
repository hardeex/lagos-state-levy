{{-- resources/views/consultant/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultant Dashboard - Lagos Fire Service</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-red-800 text-white">
        <div class="flex items-center justify-center h-16 bg-red-900">
            <h1 class="text-xl font-bold">Fire Service Portal</h1>
        </div>
        <nav class="mt-8">
            <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-red-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-6 py-3 bg-red-700 text-white hover:bg-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Wallet
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-red-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Safety Equipment
            </a>
            <a href="#" class="flex items-center px-6 py-3 text-white hover:bg-red-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                My Profile
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Welcome, John Doe</h2>
                <p class="text-gray-600">Safety Consultant</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="bg-white p-2 rounded-full shadow hover:shadow-md">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full">
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Wallet Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Wallet</h3>
                        <div class="bg-red-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">Current Balance</p>
                        <p class="text-3xl font-bold text-gray-800">₦125,000.00</p>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Pending Charges</span>
                            <span class="text-red-600">₦15,000.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Last Charge</span>
                            <span class="text-gray-800">₦35,000.00</span>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                        View Transactions
                    </button>
                </div>
            </div>

            <!-- Safety Equipment Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Safety Equipment</h3>
                        <div class="bg-green-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @foreach (['Fire Extinguisher', 'Safety Helmet', 'Safety Boots', 'High-Vis Vest', 'Safety Goggles', 'First Aid Kit'] as $equipment)
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-gray-700">{{ $equipment }}</span>
                            </div>
                        @endforeach
                    </div>
                    <button class="mt-6 w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                        Register New Equipment
                    </button>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">My Profile</h3>
                        <div class="bg-blue-100 rounded-full p-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mb-6">
                        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="w-16 h-16 rounded-full">
                        <div>
                            <h4 class="font-semibold text-gray-800">John Doe</h4>
                            <p class="text-sm text-gray-600">Safety Consultant</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email</span>
                            <span class="text-gray-800">john.doe@example.com</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phone</span>
                            <span class="text-gray-800">+234 801 234 5678</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">License</span>
                            <span class="text-gray-800">LSF-2024-0123</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="text-green-600">Active</span>
                        </div>
                    </div>
                    <button class="mt-6 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
