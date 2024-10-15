@extends('base.base')
@section('title', 'Forgot Password')
@section('content')

    <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8" x-data="forgotPassword()">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Forgot your password?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                No worries, we'll send you reset instructions.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.prevent="submitForm">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                x-model="email" :class="{ 'border-red-300': error, 'border-green-300': success }"
                                @input="validateEmail">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                                x-show="error || success">
                                <svg class="h-5 w-5 text-red-500" x-show="error" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg class="h-5 w-5 text-green-500" x-show="success" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-red-600" x-show="error" x-text="errorMessage"></p>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            :disabled="!isValid || isLoading">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" x-show="isLoading"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span x-text="isLoading ? 'Sending...' : 'Reset Password'"></span>
                        </button>
                    </div>
                </form>

                <div class="mt-6" x-show="showSuccessMessage">
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    Password reset instructions sent! Check your email.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Or
                            </span>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('auth.login-user') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Return to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function forgotPassword() {
            return {
                email: '',
                error: false,
                success: false,
                isLoading: false,
                isValid: false,
                errorMessage: '',
                showSuccessMessage: false,

                validateEmail() {
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    this.isValid = re.test(this.email);
                    this.error = !this.isValid && this.email.length > 0;
                    this.success = this.isValid;
                    this.errorMessage = this.error ? 'Please enter a valid email address.' : '';
                },

                submitForm() {
                    if (!this.isValid) return;

                    this.isLoading = true;
                    // Simulate API call
                    setTimeout(() => {
                        this.isLoading = false;
                        this.showSuccessMessage = true;
                        this.email = '';
                    }, 2000);

                    // In a real application, you would make an API call here
                    // axios.post('/api/forgot-password', { email: this.email })
                    //     .then(response => {
                    //         this.isLoading = false;
                    //         this.showSuccessMessage = true;
                    //         this.email = '';
                    //     })
                    //     .catch(error => {
                    //         this.isLoading = false;
                    //         this.error = true;
                    //         this.errorMessage = error.response.data.message || 'An error occurred. Please try again.';
                    //     });
                }
            }
        }
    </script>





@endsection
