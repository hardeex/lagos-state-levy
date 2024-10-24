@extends('base.base')
@section('title', 'Registered Safety Consultant Login')
@section('content')
    <div class="h-full">
        <div class="space-y-4 max-w-2xl mx-auto p-4">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Levy Portal
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Safety Consultant Login
                    </p>
                </div>
                <div class="mt-8 bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form class="space-y-6" action="#" method="POST">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                    Remember me
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sign in
                            </button>
                        </div>
                    </form>

                    <!-- Highlighted Registration Link -->
                    <div class="mt-6 text-center">
                        <span class="block text-sm text-gray-600 mb-2">Don't have an account?</span>
                        <a href="#"
                            class="inline-block px-4 py-2 bg-gradient-to-r from-red-500 to-blue-500 text-white font-medium rounded-lg shadow hover:from-red-600 hover:to-blue-600 transition duration-200"
                            onclick="openModal()">
                            Register
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="registerModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Register</h3>
                <button onclick="closeModal()"
                    class="text-sm text-white hover:text-gray-700 bg-red-500 hover:bg-red-600 rounded-md py-2 px-4">
                    Close
                </button>

            </div>
            <form action="#" method="POST" class="mt-4 space-y-4">
                <div>
                    <label for="register-email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input id="register-email" name="register-email" type="email" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="button" onclick="resetForm()"
                        class="w-1/2 mr-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Reset
                    </button>
                    <button type="submit"
                        class="w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('registerModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('registerModal').classList.add('hidden');
        }

        function resetForm() {
            document.getElementById('register-email').value = '';
        }
    </script>

@endsection
