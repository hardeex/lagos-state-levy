@extends('base.base')
@section('title', 'Register')
@section('content')
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Modal for Tax ID -->
        <div id="taxIdModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-md p-6 w-11/12 max-w-md">
                <h2 class="text-2xl font-semibold text-center mb-4">Enter Tax ID</h2>
                <input type="text" id="taxIdInput" placeholder="Tax ID"
                    class="w-full h-10 border border-gray-300 rounded-md p-2 mb-4">
                <div class="flex justify-between">
                    <button id="submitTaxId" class="bg-blue-600 text-white rounded-md px-4 py-2">Submit</button>
                    <button id="closeModal" class="bg-gray-300 text-gray-800 rounded-md px-4 py-2">Cancel</button>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-5 sm:p-6" id="registrationFormContainer" style="display: none;">
                    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
                        Lagos FSLC Registration
                    </h2>
                    <form action="{{ route('auth.register-user') }}" method="POST" class="space-y-6" id="registrationForm">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <!-- Business Phone -->
                            <div class="relative group">
                                <input type="tel" name="business_phone" id="business_phone" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Business Phone" value="{{ old('business_phone') }}">
                                <label for="business_phone" class="label">Business Phone</label>
                                @error('business_phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="relative group">
                                <input type="email" name="email" id="email" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Email" value="{{ old('email') }}">
                                <label for="email" class="label">Email</label>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Reg No -->
                            <div class="relative group">
                                <input type="text" name="business_reg_no" id="business_reg_no" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Business Reg No (CAC)" value="{{ old('business_reg_no') }}">
                                <label for="business_reg_no" class="label">Business Reg No (CAC)</label>
                                @error('business_reg_no')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tax Payer ID -->
                            <div class="relative group">
                                <input type="text" name="tax_payer_id" id="tax_payer_id" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Tax Payer ID" value="{{ old('tax_payer_id') }}">
                                <label for="tax_payer_id" class="label">Tax Payer ID</label>
                                @error('tax_payer_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Name -->
                            <div class="relative group sm:col-span-2">
                                <input type="text" name="business_name" id="business_name" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    placeholder="Business Name" value="{{ old('business_name') }}">
                                <label for="business_name" class="label">Business Name</label>
                                @error('business_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="relative group sm:col-span-2">
                                <textarea name="address" id="address" rows="3" required
                                    class="peer w-full bg-gray-50 text-gray-800 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-600 transition-all p-2"
                                    placeholder="Address">{{ old('address') }}</textarea>
                                <label for="address" class="label">Address</label>
                                @error('address')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- LGA/LCDA -->
                            <div class="relative group">
                                <select name="lga_lcda" id="lga_lcda" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all appearance-none">
                                    <option value="">Select LGA/LCDA</option>
                                    <option value="ALIMOSHO" {{ old('lga_lcda') == 'ALIMOSHO' ? 'selected' : '' }}>ALIMOSHO
                                    </option>
                                    <!-- Add more options here -->
                                </select>
                                <label for="lga_lcda" class="label">LGA/LCDA</label>
                                @error('lga_lcda')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="relative group">
                                <select name="state" id="state" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all appearance-none">
                                    <option value="LAGOS" selected>LAGOS</option>
                                </select>
                                <label for="state" class="label">State</label>
                            </div>

                            <!-- Date of Incorporation -->
                            <div class="relative group">
                                <input type="date" name="date_of_incorporation" id="date_of_incorporation" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all"
                                    value="{{ old('date_of_incorporation') }}">
                                <label for="date_of_incorporation" class="label">Date of Incorporation</label>
                                @error('date_of_incorporation')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Industry Sector -->
                            <div class="relative group">
                                <select name="industry_sector" id="industry_sector" required
                                    class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all appearance-none">
                                    <option value="">Select Industry Sector</option>
                                    <option value="Technology"
                                        {{ old('industry_sector') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <!-- Add more options here -->
                                </select>
                                <label for="industry_sector" class="label">Industry Sector</label>
                                @error('industry_sector')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <input id="agree_terms" name="agree_terms" type="checkbox" required
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="agree_terms" class="ml-2 block text-sm text-gray-900">
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
            // Show modal on page load
            const modal = document.getElementById('taxIdModal');
            modal.classList.remove('hidden');

            // Close modal
            document.getElementById('closeModal').addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Submit tax ID
            document.getElementById('submitTaxId').addEventListener('click', () => {
                const taxId = document.getElementById('taxIdInput').value;
                if (taxId) {
                    document.getElementById('tax_payer_id').value =
                    taxId; // Assign the value to the hidden field
                    modal.classList.add('hidden');
                    document.getElementById('registrationFormContainer').style.display =
                    'block'; // Show registration form
                } else {
                    alert('Please enter a valid Tax ID.');
                }
            });

            const form = document.getElementById('registrationForm');
            const inputs = form.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                input.addEventListener('focus', (e) => {
                    e.target.closest('.group').classList.add('scale-105', 'z-10');
                });

                input.addEventListener('blur', (e) => {
                    e.target.closest('.group').classList.remove('scale-105', 'z-10');
                });
            });
        });
    </script>
@endpush
