@extends('base.base')
@section('title', 'OTP Verification')
@section('content')
    <div class="bg-gray-100">
        <div class="max-w-md mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Verification Required</h2>

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

            <form action="{{ route('auth.otp-verify-submit') }}" method="POST">
                @csrf
                {{-- <div class="mb-4">
                    <label for="business_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Business Email
                    </label>
                    <input type="email" id="business_email" name="business_email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required value="{{ old('business_email') }}">
                </div> --}}

                <div class="mb-4">
                    <label for="business_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Business Email
                    </label>
                    <input type="email" id="business_email" name="business_email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required value="{{ old('business_email', $businessEmail) }}" readonly>
                </div>
                <div class="mb-4">
                    <label for="verification_method" class="block text-sm font-medium text-gray-700 mb-2">
                        Select Verification Method
                    </label>
                    <select id="verification_method" name="verification_method"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="email" {{ old('verification_method') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="phone" {{ old('verification_method') == 'phone' ? 'selected' : '' }}>Phone</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2" id="otpLabel">Enter
                        OTP</label>
                    <input type="text" id="otp" name="otp" maxlength="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="000000" required pattern="[0-9]{6}" title="Please enter a 6-digit number"
                        value="{{ old('otp') }}">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    Verify OTP
                </button>
            </form>

            <p class="mt-4 text-sm text-gray-600 text-center">
                Didn't receive the OTP?
                <a href="#" class="text-blue-500 hover:underline" id="resend-link">Resend OTP</a>
            </p>

            <form id="resend-form" action="{{ route('auth.resend-otp') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="verification_method" id="resend_verification_method" value="email">
                <input type="hidden" name="business_email" id="resend_business_email" value="">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const verificationMethod = document.getElementById('verification_method');
            const otpLabel = document.getElementById('otpLabel');
            const resendForm = document.getElementById('resend-form');
            const resendLink = document.getElementById('resend-link');
            const businessEmail = document.getElementById('business_email');
            const resendBusinessEmail = document.getElementById('resend_business_email');
            const resendVerificationMethod = document.getElementById('resend_verification_method');

            // Update OTP label when verification method changes
            verificationMethod.addEventListener('change', function() {
                otpLabel.textContent = this.value === 'email' ? 'Enter Email OTP' : 'Enter Phone OTP';
                resendVerificationMethod.value = this.value;
            });

            // Handle resend OTP
            resendLink.addEventListener('click', function(e) {
                e.preventDefault();

                // Update business email in resend form
                resendBusinessEmail.value = businessEmail.value;

                if (!businessEmail.value) {
                    alert('Please enter your business email first');
                    return;
                }

                // Disable the link temporarily
                resendLink.style.pointerEvents = 'none';
                resendLink.textContent = 'Sending...';

                // Submit the resend form
                resendForm.submit();
            });

            // Add input validation for OTP
            const otpInput = document.getElementById('otp');
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
            });
        });
    </script>
@endsection
