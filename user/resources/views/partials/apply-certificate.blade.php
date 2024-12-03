<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-center mb-4">
            <img src="/api/placeholder/80/80" alt="Lagos Fire Service Logo" class="h-20 w-20 object-contain" />
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2 text-center">Lagos State Fire Service Certificates</h1>
        <p class="text-gray-600 text-center">Apply for fire safety certificates and permits for your business premises
        </p>
    </div>

    <!-- Top Alert Section -->
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

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Requirements Card -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">Certificate Requirements</h2>
                </div>
                <p class="text-sm text-gray-600 mt-1">Essential documents needed for application</p>
            </div>

            <ul class="space-y-3">
                @php
                    $requirements = [
                        'Valid business registration with Lagos State',
                        'Current building layout/floor plan',
                        'Evidence of fire safety equipment installation',
                        'Recent photographs of premises (interior & exterior)',
                        'Proof of business address/tenancy agreement',
                        'Government-issued ID of business owner/representative',
                        'Tax clearance certificate',
                        'Previous fire certificate (for renewals)',
                    ];
                @endphp

                @foreach ($requirements as $requirement)
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 flex-shrink-0 mt-0.5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">{{ $requirement }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Certificate Categories Card -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-4">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">Available Certificates</h2>
                </div>
                <p class="text-sm text-gray-600 mt-1">Select the appropriate certificate type for your business</p>
            </div>

            <ul class="space-y-3">
                @php
                    $certificateTypes = [
                        'Fire Safety Certificate (New Business)',
                        'Fire Safety Certificate (Renewal)',
                        'Fire Safety Compliance Certificate',
                        'Fire Emergency Evacuation Plan Approval',
                        'Petroleum Products Storage Permit',
                        'Industrial Safety Certificate',
                    ];
                @endphp

                @foreach ($certificateTypes as $type)
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 flex-shrink-0 mt-0.5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">{{ $type }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Application Button -->
    {{-- <div class="flex justify-center">
        <form action="#" method="GET">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold flex items-center transition-colors duration-200 ease-in-out transform hover:scale-105">
                Start Application
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div> --}}

    <div class="flex justify-center">
        <form action="#" method="GET">
            @csrf
            <button type="button" id="openModalButton"
                class="bg-green-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold flex items-center transition-colors duration-200 ease-in-out transform hover:scale-105">
                Start Application
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>

    <!-- Modal -->
    <div id="modal"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none hidden">
        <div class="relative w-full max-w-lg mx-auto my-6">
            <div
                class="relative flex flex-col w-full bg-white border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-blueGray-200">
                    <h3 class="text-3xl font-semibold">
                        Application Form
                    </h3>
                    <button id="closeModalButton"
                        class="float-right p-1 ml-auto text-3xl font-semibold leading-none text-black bg-transparent border-0 outline-none opacity-5 focus:outline-none">
                        <span class="block w-6 h-6 text-2xl text-black bg-transparent opacity-5">
                            ×
                        </span>
                    </button>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('user.application') }}" method="POST">
                    @csrf
                    <div class="relative flex-auto p-6 space-y-4">
                        <!-- Year Input -->
                        <div class="mb-4">
                            <label for="lyear" class="block mb-2 text-sm font-bold text-gray-700">
                                Year
                            </label>
                            <input type="number" name="lyear" id="lyear" required
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                placeholder="Enter year">
                        </div>

                        <!-- Agency Input -->
                        <div class="mb-4">
                            <label for="lagency" class="block mb-2 text-sm font-bold text-gray-700">
                                Agency
                            </label>
                            <input type="text" name="lagency" id="lagency" required
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                placeholder="Enter agency">
                        </div>

                        <!-- Apply Type Input -->
                        <div class="mb-4">
                            <label for="applytype" class="block mb-2 text-sm font-bold text-gray-700">
                                Apply Type
                            </label>
                            <input type="text" name="applytype" id="applytype" required
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                placeholder="Enter apply type">
                        </div>

                        <!-- Comments Input -->
                        <div class="mb-4">
                            <label for="bcomment" class="block mb-2 text-sm font-bold text-gray-700">
                                Comments
                            </label>
                            <textarea name="bcomment" id="bcomment"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                placeholder="Enter comments"></textarea>
                        </div>

                        <!-- Hidden Inputs for Email and Password -->
                        <input type="hidden" name="lbizemail" value="{{ Session::get('business_email') }}">
                        <input type="hidden" name="password" value="{{ Session::get('business_password') }}">

                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-blueGray-200">
                        <button type="button" id="closeModalButton2"
                            class="px-6 py-2 mb-1 mr-1 text-sm font-bold text-red-500 uppercase transition-all duration-150 ease-linear outline-none background-transparent focus:outline-none">
                            Close
                        </button>
                        <button type="submit"
                            class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 ease-linear bg-green-500 rounded shadow outline-none active:bg-green-600 hover:shadow-lg focus:outline-none">
                            Submit Application
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Get modal and buttons
        const modal = document.getElementById("modal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButtons = document.querySelectorAll("#closeModalButton, #closeModalButton2");

        // Open modal when Start Application button is clicked
        openModalButton.addEventListener("click", function() {
            modal.classList.remove("hidden");
        });

        // Close modal when close button is clicked
        closeModalButtons.forEach(button => {
            button.addEventListener("click", function() {
                modal.classList.add("hidden");
            });
        });

        // Close modal when clicking outside the modal
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    </script>




    <!-- Important Information -->
    <div class="mt-8 text-center space-y-2">
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 inline-block text-left">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Processing time: 7-10 working days
                    </p>
                    <p class="text-sm text-yellow-700">
                        Physical inspection may be required
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Information -->
    <div class="mt-6 text-center text-sm text-gray-500">
        <p>For support or inquiries, contact:</p>
        <p class="font-semibold">Lagos State Fire Service Department</p>
        <p>Email: support@lagosstatefire.gov.ng</p>
        <p>Hotline: 0800-FIRE-SERVICE</p>
    </div>
</div>





{{-- 

<!-- Modal -->
<div
    class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
    <div @click.away="isOpen = false" class="relative w-full max-w-lg mx-auto my-6">
        <div
            class="relative flex flex-col w-full bg-white border-0 rounded-lg shadow-lg outline-none focus:outline-none">
            <!-- Modal Header -->
            <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-blueGray-200">
                <h3 class="text-3xl font-semibold">
                    Application Form
                </h3>
                <button @click="isOpen = false"
                    class="float-right p-1 ml-auto text-3xl font-semibold leading-none text-black bg-transparent border-0 outline-none opacity-5 focus:outline-none">
                    <span class="block w-6 h-6 text-2xl text-black bg-transparent opacity-5">
                        ×
                    </span>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="#" method="POST">
                @csrf
                <div class="relative flex-auto p-6 space-y-4">
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="lbizemail" class="block mb-2 text-sm font-bold text-gray-700">
                            Email
                        </label>
                        <input type="email" name="lbizemail" id="lbizemail" required
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter your email">
                    </div>

                    <!-- Year Input -->
                    <div class="mb-4">
                        <label for="lyear" class="block mb-2 text-sm font-bold text-gray-700">
                            Year
                        </label>
                        <input type="number" name="lyear" id="lyear" required
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter year">
                    </div>

                    <!-- Agency Input -->
                    <div class="mb-4">
                        <label for="lagency" class="block mb-2 text-sm font-bold text-gray-700">
                            Agency
                        </label>
                        <input type="text" name="lagency" id="lagency" required
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter agency">
                    </div>

                    <!-- Apply Type Input -->
                    <div class="mb-4">
                        <label for="applytype" class="block mb-2 text-sm font-bold text-gray-700">
                            Apply Type
                        </label>
                        <input type="text" name="applytype" id="applytype" required
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter apply type">
                    </div>

                    <!-- Comments Input -->
                    <div class="mb-4">
                        <label for="bcomment" class="block mb-2 text-sm font-bold text-gray-700">
                            Comments
                        </label>
                        <textarea name="bcomment" id="bcomment"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter comments"></textarea>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-700">
                            Password
                        </label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            placeholder="Enter password">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-blueGray-200">
                    <button type="button" @click="isOpen = false"
                        class="px-6 py-2 mb-1 mr-1 text-sm font-bold text-red-500 uppercase transition-all duration-150 ease-linear outline-none background-transparent focus:outline-none">
                        Close
                    </button>
                    <button type="submit"
                        class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 ease-linear bg-green-500 rounded shadow outline-none active:bg-green-600 hover:shadow-lg focus:outline-none">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
