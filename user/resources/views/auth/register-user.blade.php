@extends('base.base')
@section('title', 'Register')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
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

        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div id="taxIdModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">

            <div class="bg-white rounded-lg shadow-md p-6 w-11/12 max-w-md">
                @if ($errors->any())
                    <div class="text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                <h2 class="text-2xl font-semibold text-center mb-4">Enter Tax ID</h2>
                <input type="text" id="taxIdInput" placeholder="TAX123456"
                    class="w-full h-10 border border-gray-300 rounded-md p-2 mb-4">
                <div class="flex justify-between mb-4">
                    <button id="submitTaxId" class="bg-blue-600 text-white rounded-md px-4 py-2">Submit</button>
                    <button id="closeModal" class="bg-gray-300 text-gray-800 rounded-md px-4 py-2">Cancel</button>
                </div>
                <div class="text-center">
                    <a href="#" class="text-blue-600 hover:underline">Generate New Payer ID</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="text-green-600">
                {{ session('success') }}
            </div>
        @endif


        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-5 sm:p-6" id="registrationFormContainer" style="display: none;">
                    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                        Lagos FSLC Registration
                    </h2>
                    <form action="{{ route('auth.register-submit') }}" method="POST" class="space-y-6"
                        id="registrationForm">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <!-- Business Phone -->
                            <div class="relative group">
                                <input type="tel" name="lphone" id="lphone" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="eg +23481234567890" value="{{ old('lphone') }}">
                                <label for="lphone" class="label">Business Phone</label>
                                @error('lphone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="relative group">
                                <input type="email" name="lemail" id="lemail" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Email" value="{{ old('lemail') }}">
                                <label for="lemail" class="label">Email</label>
                                @error('lemail')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="lpw" class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="mt-1 relative">
                                    <input id="lpw" name="lpw" type="password" autocomplete="new-password"
                                        required
                                        class="appearance-none block w-full pr-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M10 3C5.58 3 1.66 6.29 1 10c.66 3.71 4.58 7 9 7s8.34-3.29 9-7c-.66-3.71-4.58-7-9-7zM10 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="lcpw" class="block text-sm font-medium text-gray-700">Confirm
                                    Password</label>
                                <div class="mt-1 relative">
                                    <input id="lcpw" name="lcpw" type="password" autocomplete="new-password"
                                        required
                                        class="appearance-none block w-full pr-10 px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <button type="button" id="toggleConfirmPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                        <svg id="confirmEyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M10 3C5.58 3 1.66 6.29 1 10c.66 3.71 4.58 7 9 7s8.34-3.29 9-7c-.66-3.71-4.58-7-9-7zM10 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Business Reg No -->
                            <div class="relative group">
                                <input type="text" name="lregno" id="lregno" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="RC123456" value="{{ old('lregno') }}">
                                <label for="lregno" class="label">Business Reg No (CAC)</label>
                                @error('lregno')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tax Payer ID -->
                            <div class="relative group">
                                <input type="text" name="ltaxid" id="ltaxid" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="TAX123456" value="{{ old('ltaxid') }}">
                                <label for="ltaxid" class="label">Tax Payer ID</label>
                                @error('ltaxid')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Name -->
                            <div class="relative group sm:col-span-2">
                                <input type="text" name="lbizname" id="lbizname" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Business Name" value="{{ old('lbizname') }}">
                                <label for="lbizname" class="label">Business Name</label>
                                @error('lbizname')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="relative group sm:col-span-2">
                                <textarea name="ladd" id="ladd" rows="3" required
                                    class="peer w-full bg-gray-50 text-gray-800 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-600 transition-all p-2"
                                    placeholder="Address">{{ old('ladd') }}</textarea>
                                <label for="ladd" class="label">Address</label>
                                @error('ladd')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- LGA/LCDA -->
                            <div class="relative group">
                                <select name="llga" id="llga" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all">

                                    <option value="">Select LGA/LCDA</option>
                                    <!-- Options will be populated via JavaScript -->
                                </select>
                                <label for="llga" class="label">LGA/LCDA</label>
                                @error('llga')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const lgaSelect = document.getElementById('llga');

                                    function loadLGALCDA() {
                                        lgaSelect.disabled = true; // Disable the dropdown while loading

                                        fetch('/business/load-lga-lcda', {
                                                method: 'GET',
                                                headers: {
                                                    'Accept': 'application/json',
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                }
                                            })
                                            .then(response => {
                                                if (!response.ok) {
                                                    throw new Error(`HTTP error! status: ${response.status}`);
                                                }
                                                return response.json();
                                            })
                                            .then(data => {
                                                // Clear existing options except the first one
                                                while (lgaSelect.options.length > 1) {
                                                    lgaSelect.remove(1);
                                                }

                                                // Populate options
                                                if (data && Array.isArray(data)) {
                                                    data.forEach(item => {
                                                        // Use llgalcda instead of name
                                                        const option = new Option(item.llgalcda, item.id);
                                                        lgaSelect.add(option);
                                                    });

                                                    // If there's an old value, select it
                                                    const oldValue = "{{ old('llga') }}";
                                                    if (oldValue) {
                                                        lgaSelect.value = oldValue;
                                                    }
                                                } else {
                                                    console.warn('Unexpected data format received:', data);
                                                    throw new Error('Invalid data format received');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error loading LGA/LCDA:', error);
                                                // Clear existing options except the first one
                                                while (lgaSelect.options.length > 1) {
                                                    lgaSelect.remove(1);
                                                }
                                                // Add error option
                                                const errorOption = new Option('Error loading LGA/LCDA', '');
                                                lgaSelect.add(errorOption);
                                            })
                                            .finally(() => {
                                                lgaSelect.disabled = false; // Re-enable the dropdown
                                            });
                                    }

                                    // Load the LGA/LCDA data when the page loads
                                    loadLGALCDA();
                                });
                            </script>


                            <!-- State -->
                            <div class="relative group">
                                <input type="text" name="lstate" id="lstate" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    value="Lagos" readonly>
                                <label for="lstate" class="label">State</label>
                            </div>

                            <!-- Country -->
                            <div class="relative group">
                                <input type="text" name="lcountry" id="lcountry" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    value="Nigeria" readonly>
                                <label for="lcountry" class="label">Country</label>
                            </div>

                            <!-- Date of Incorporation -->
                            <div class="relative group">
                                <input type="number" name="lincorporation" id="lincorporation" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Year of Incorporation" value="{{ old('lincorporation') }}"
                                    min="1900" max="{{ date('Y') }}">
                                <label for="lincorporation" class="label">Year of Incorporation</label>
                                @error('lincorporation')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- <!-- Industry Sector -->
                            <div class="relative group">
                                <input type="text" name="lindustryone" id="lindustryone" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Industry Sector" value="{{ old('lindustryone') }}">
                                <label for="lindustryone" class="label">Industry Sector</label>
                                @error('lindustryone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div> --}}


                            <!-- Industry Sector -->
                            <div class="relative group">
                                <select name="lindustryone" id="lindustryone" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all">
                                    <option value="">Select Industry Sector</option>
                                </select>
                                <label for="lindustryone" class="label">Industry Sector</label>
                                @error('lindustryone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Sub Industry Sector -->
                            <div class="relative group">
                                <select name="lsubsectorone" id="lsubsectorone" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all">
                                    <option value="">Select Sub Industry Sector</option>
                                </select>
                                <label for="lsubsectorone" class="label">Sub Industry Sector</label>
                                @error('lsubsectorone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const industrySelect = document.getElementById('lindustryone');
                                    const subSectorSelect = document.getElementById('lsubsectorone');

                                    // Function to load industry sectors
                                    function loadIndustrySector() {
                                        industrySelect.disabled = true;

                                        fetch('/api/business/load-industry', {
                                                method: 'GET',
                                                headers: {
                                                    'Accept': 'application/json',
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                }
                                            })
                                            .then(response => {
                                                if (!response.ok) {
                                                    throw new Error(`HTTP error! status: ${response.status}`);
                                                }
                                                return response.json();
                                            })
                                            .then(data => {
                                                // Clear existing options except the first one
                                                while (industrySelect.options.length > 1) {
                                                    industrySelect.remove(1);
                                                }

                                                if (data && Array.isArray(data)) {
                                                    // Sort industries alphabetically
                                                    data.sort();

                                                    // Populate options
                                                    data.forEach(industryName => {
                                                        const option = new Option(industryName, industryName);
                                                        industrySelect.add(option);
                                                    });

                                                    // If there's an old value, select it and load its subsectors
                                                    const oldValue = industrySelect.getAttribute('data-old-value') ||
                                                        "{{ old('lindustryone') }}";
                                                    if (oldValue) {
                                                        industrySelect.value = oldValue;
                                                        loadSubSectors(oldValue);
                                                    }
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error loading Industry Sectors:', error);
                                                const errorOption = new Option('Error loading Industry Sectors', '');
                                                industrySelect.add(errorOption);
                                            })
                                            .finally(() => {
                                                industrySelect.disabled = false;
                                            });
                                    }


                                    // Function to load subsectors for selected industry
                                    function loadSubSectors(industry) {
                                        if (!industry) {
                                            // Reset subsector select with just the default option
                                            subSectorSelect.innerHTML = '<option value="">Select Sub Industry Sector</option>';
                                            subSectorSelect.disabled = true;
                                            return;
                                        }

                                        subSectorSelect.disabled = true;

                                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content; // Optional chaining

                                        fetch('/api/business/load-subsector', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    ...(csrfToken ? {
                                                        'X-CSRF-TOKEN': csrfToken
                                                    } : {}) // Only add header if token exists
                                                },
                                                body: JSON.stringify({
                                                    industry: industry
                                                })
                                            })
                                            .then(response => {
                                                if (!response.ok) {
                                                    throw new Error(`HTTP error! status: ${response.status}`);
                                                }
                                                return response.json();
                                            })
                                            .then(data => {
                                                console.log(data); // Log data for debugging

                                                // Clear existing options
                                                subSectorSelect.innerHTML = '<option value="">Select Sub Industry Sector</option>';

                                                if (Array.isArray(data) && data.length > 0) {
                                                    // Sort subsectors by label if they have a 'lsubsector' property
                                                    data.sort((a, b) => (a.lsubsector || '').localeCompare(b.lsubsector || ''));

                                                    // Add subsector options
                                                    // data.forEach(subsector => {
                                                    //     const option = document.createElement('option');
                                                    //     option.value = subsector.id; 
                                                    //     option.textContent = subsector.lsubsector; 
                                                    //     subSectorSelect.appendChild(option);
                                                    // });

                                                    // Add subsector options
                                                    data.forEach(subsector => {
                                                        const option = document.createElement('option');
                                                        option.value = subsector.lsubsector; 
                                                        option.textContent = subsector.lsubsector; 
                                                        subSectorSelect.appendChild(option);
                                                    });


                                                    // Restore old value if it exists
                                                    const oldValue = "{{ old('lsubsectorone') }}";
                                                    if (oldValue) {
                                                        subSectorSelect.value = oldValue;
                                                    }
                                                } else {
                                                    subSectorSelect.innerHTML = '<option value="">No subsectors available</option>';
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error loading subsectors:', error);
                                                subSectorSelect.innerHTML =
                                                    '<option value="">Error loading Sub Industry Sectors</option>';
                                            })
                                            .finally(() => {
                                                subSectorSelect.disabled = false;
                                            });
                                    }



                                    // Event listener for industry selection change
                                    industrySelect.addEventListener('change', function() {
                                        loadSubSectors(this.value);
                                    });

                                    // Initialize
                                    loadIndustrySector();
                                });
                            </script>





                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <input id="lagree" name="lagree" type="checkbox" required value="yes"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="lagree" class="ml-2 block text-sm text-gray-900">
                                    I hereby reaffirm the information as provided
                                </label>
                            </div>
                        </div>

                        <div class="pt-5">
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Password visibility toggle logic
            const setupPasswordToggle = (inputId, toggleId, iconId) => {
                const input = document.getElementById(inputId);
                const toggle = document.getElementById(toggleId);
                const icon = document.getElementById(iconId);

                toggle?.addEventListener('click', () => {
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.setAttribute('d',
                            'M2 10c0 4.42 4.03 8 8 8s8-3.58 8-8-4.03-8-8-8-8 3.58-8 8z'
                        ); // open eye icon
                    } else {
                        input.type = 'password';
                        icon.setAttribute('d',
                            'M10 3C5.58 3 1.66 6.29 1 10c.66 3.71 4.58 7 9 7s8.34-3.29 9-7c-.66-3.71-4.58-7-9-7zM10 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8z'
                        ); // closed eye icon
                    }
                });
            };

            // Set up password visibility toggle for both password and confirm password
            setupPasswordToggle('lpw', 'togglePassword', 'eyeIcon');
            setupPasswordToggle('lcpw', 'toggleConfirmPassword', 'confirmEyeIcon');

            // Modal and form handling
            const hasErrors = document.querySelectorAll('.text-red-600').length > 0;
            const modal = document.getElementById('taxIdModal');
            const registrationFormContainer = document.getElementById('registrationFormContainer');

            // Show modal only if no errors
            if (!hasErrors) {
                modal.classList.remove('hidden');
                registrationFormContainer.style.display = 'none';
            } else {
                modal.classList.add('hidden');
                registrationFormContainer.style.display = 'block';
            }

            // Close modal
            document.getElementById('closeModal')?.addEventListener('click', () => {
                modal.classList.add('hidden');
                registrationFormContainer.style.display = 'block';
            });

            // Submit tax ID
            document.getElementById('submitTaxId')?.addEventListener('click', () => {
                const taxId = document.getElementById('taxIdInput').value;
                if (taxId) {
                    document.getElementById('ltaxid').value = taxId;
                    modal.classList.add('hidden');
                    registrationFormContainer.style.display = 'block';
                } else {
                    alert('Please enter a valid Tax ID.');
                }
            });

            // Form input animations
            const form = document.getElementById('registrationForm');
            if (form) {
                const inputs = form.querySelectorAll('input, select, textarea');

                inputs.forEach(input => {
                    input.addEventListener('focus', (e) => {
                        const group = e.target.closest('.group') || e.target.closest('.relative');
                        if (group) {
                            group.classList.add('scale-105', 'z-10');
                        }
                    });

                    input.addEventListener('blur', (e) => {
                        const group = e.target.closest('.group') || e.target.closest('.relative');
                        if (group) {
                            group.classList.remove('scale-105', 'z-10');
                        }
                    });
                });
            }
        });
    </script>
@endpush
