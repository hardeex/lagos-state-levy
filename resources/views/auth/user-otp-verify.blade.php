@extends('base.base')
@section('title', 'Register- OTP Verification')
@section('content')

    <div class="bg-gray-100">
        <div class="max-w-md mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Verification Required</h2>

            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="verification_method" class="block text-sm font-medium text-gray-700 mb-2">Select
                        Verification Method</label>
                    <select id="verification_method" name="verification_method"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">Enter 6-digit OTP</label>
                    <input type="text" id="otp" name="otp" maxlength="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="000000" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Verify
                    OTP</button>
            </form>

            <p class="mt-4 text-sm text-gray-600 text-center">
                Didn't receive the OTP?
                <a href="#" class="text-blue-500 hover:underline"
                    onclick="event.preventDefault(); document.getElementById('resend-form').submit();">Resend OTP</a>
            </p>

            <form id="resend-form" action="#" method="POST" class="hidden">
                @csrf
            </form>

            @if (session('error'))
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <script>
            document.getElementById('verification_method').addEventListener('change', function() {
                var otpLabel = document.querySelector('label[for="otp"]');
                otpLabel.textContent = this.value === 'email' ? 'Enter Email OTP' : 'Enter Phone OTP';
            });
        </script>
    </div>

@endsection
