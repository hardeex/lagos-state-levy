<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Apply for Certificates</h1>
        <p class="text-gray-600">Complete the requirements and submit your application for business certificates</p>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Requirements Card -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">Requirements</h2>
                </div>
                <p class="text-sm text-gray-600 mt-1">Ensure you meet all requirements before applying</p>
            </div>

            <ul class="space-y-3">
                @php
                    $requirements = [
                        'Valid business registration in Lagos State',
                        'Up-to-date tax compliance',
                        'Proof of business address',
                        'Government-issued ID of business owner',
                        'Recent utility bill (not older than 3 months)',
                    ];
                @endphp

                @foreach ($requirements as $requirement)
                    <li class="flex items-start gap-2">
                        <span class="text-gray-400 mt-1">•</span>
                        <span class="text-gray-700">{{ $requirement }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Process Overview Card -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">Process Overview</h2>
                </div>
                <p class="text-sm text-gray-600 mt-1">What to expect after applying</p>
            </div>

            <ol class="space-y-3">
                @php
                    $processSteps = [
                        'Submit required documents',
                        'Pay processing fee',
                        'Undergo verification process',
                        'Receive digital certificate',
                        'Schedule physical certificate collection',
                    ];
                @endphp

                @foreach ($processSteps as $index => $step)
                    <li class="flex items-start gap-2">
                        <span class="min-w-6 text-gray-500">{{ $index + 1 }}.</span>
                        <span class="text-gray-700">{{ $step }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <!-- Application Button -->
    <div class="flex justify-center">
        <form action="#" method="POST">
            @csrf
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold flex items-center transition-colors">
                Start Application
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>

    <!-- Footer Information -->
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Processing time: 5-7 working days</p>
        <p>Need help? Contact our support team</p>
    </div>
</div>
