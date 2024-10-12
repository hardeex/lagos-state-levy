@extends('base.base')
@section('title', 'Register')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-500 via-green-400 to-yellow-300 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div
                class="bg-white bg-opacity-90 rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-300">
                <div class="px-4 py-5 sm:p-6">
                    <h2
                        class="text-4xl font-extrabold text-center mb-8 bg-clip-text text-transparent bg-gradient-to-r from-red-500 via-blue-500 to-green-500">
                        Lagos FSLC Registration
                    </h2>
                    <form action="{{ route('auth.register-user') }}" method="POST" class="space-y-8" id="registrationForm">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <!-- Business Phone -->
                            <div class="relative group">
                                <input type="tel" name="business_phone" id="business_phone" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    placeholder="Business Phone" value="{{ old('business_phone') }}">
                                <label for="business_phone"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Business Phone
                                </label>
                                @error('business_phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="relative group">
                                <input type="email" name="email" id="email" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    placeholder="Email" value="{{ old('email') }}">
                                <label for="email"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Email
                                </label>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Reg No -->
                            <div class="relative group">
                                <input type="text" name="business_reg_no" id="business_reg_no" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    placeholder="Business Reg No (CAC)" value="{{ old('business_reg_no') }}">
                                <label for="business_reg_no"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Business Reg No (CAC)
                                </label>
                                @error('business_reg_no')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tax Payer ID -->
                            <div class="relative group">
                                <input type="text" name="tax_payer_id" id="tax_payer_id" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    placeholder="Tax Payer ID" value="{{ old('tax_payer_id') }}">
                                <label for="tax_payer_id"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Tax Payer ID
                                </label>
                                @error('tax_payer_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Name -->
                            <div class="relative group sm:col-span-2">
                                <input type="text" name="business_name" id="business_name" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    placeholder="Business Name" value="{{ old('business_name') }}">
                                <label for="business_name"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Business Name
                                </label>
                                @error('business_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="relative group sm:col-span-2">
                                <textarea name="address" id="address" rows="3" required
                                    class="peer w-full bg-transparent text-gray-800 border-2 border-gray-300 rounded-md focus:outline-none focus:border-blue-500 placeholder-transparent transition-all p-2"
                                    placeholder="Address">{{ old('address') }}</textarea>
                                <label for="address"
                                    class="absolute left-2 -top-3 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-gray-600 peer-focus:text-sm bg-white px-1">
                                    Address
                                </label>
                                @error('address')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- LGA/LCDA -->
                            <div class="relative group">
                                <select name="lga_lcda" id="lga_lcda" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 transition-all appearance-none">
                                    <option value="">Select LGA/LCDA</option>
                                    <option value="ALIMOSHO" {{ old('lga_lcda') == 'ALIMOSHO' ? 'selected' : '' }}>ALIMOSHO
                                    </option>
                                    <!-- Add more options here -->
                                </select>
                                <label for="lga_lcda"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    LGA/LCDA
                                </label>
                                @error('lga_lcda')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="relative group">
                                <select name="state" id="state" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 transition-all appearance-none">
                                    <option value="LAGOS" selected>LAGOS</option>
                                </select>
                                <label for="state"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    State
                                </label>
                            </div>

                            <!-- Date of Incorporation -->
                            <div class="relative group">
                                <input type="date" name="date_of_incorporation" id="date_of_incorporation" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 placeholder-transparent transition-all"
                                    value="{{ old('date_of_incorporation') }}">
                                <label for="date_of_incorporation"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Date of Incorporation
                                </label>
                                @error('date_of_incorporation')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Industry Sector -->
                            <div class="relative group">
                                <select name="industry_sector" id="industry_sector" required
                                    class="peer w-full h-10 bg-transparent text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-500 transition-all appearance-none">
                                    <option value="">Select Industry Sector</option>
                                    <option value="Technology"
                                        {{ old('industry_sector') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <!-- Add more options here -->
                                </select>
                                <label for="industry_sector"
                                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                                    Industry Sector
                                </label>
                                @error('industry_sector')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8">
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
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-500 via-yellow-500 to-green-500 hover:from-red-600 hover:via-yellow-600 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
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
        document.addEventListener('DOMContentLoaded', (event) => {
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

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                // Add custom form submission logic here
                // For example, you could use AJAX to submit the form
                alert('Form submitted successfully!');
            });
        });
    </script>
@endpush
