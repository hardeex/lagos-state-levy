@extends('base.base')
@section('title', 'OTP Verification')
@section('content')
    <div class="bg-gray-100">
        <div class="max-w-md mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Verification Required</h2>

            @if ($errors->any())
                <div class="text-red-600 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="text-green-600 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('auth.otp-verify-submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="business_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Business Email
                    </label>
                    <input type="email" id="business_email" name="business_email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required value="{{ old('business_email') }}">
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
