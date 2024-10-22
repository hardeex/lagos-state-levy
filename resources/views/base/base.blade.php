<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LagosFSLC')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .scroll-container {
            overflow: hidden;
            background: linear-gradient(90deg, #4a90e2, #50e3c2);
            padding: 0.5rem 0;
        }

        .scroll-text {
            display: inline-block;
            white-space: nowrap;
            animation: scroll 20s linear infinite;
        }

        @media (max-width: 768px) {
            .mobile-menu {
                display: none;
            }

            .mobile-menu.active {
                display: block;
            }
        }
    </style>
</head>

<body>


    @include('partials.preloader')

    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">

                <a href="{{ route('welcome') }}">
                    <div class="font-sans text-2xl font-bold tracking-wide">
                        <span class="text-white-500">Lagos</span><span class="text-blue-500">F</span><span
                            class="text-yellow-500">S</span><span class="text-green-500">LC</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center space-x-6 text-gray-700">
                    <ul class="flex space-x-6">
                        <li><a href="{{ route('welcome') }}" class="hover:text-green-600">Home</a></li>
                        <li><a href="#" class="hover:text-green-600">About</a></li>
                        <li><a href="#" class="hover:text-green-600">Services</a></li>
                        <li><a href="{{ route('user.contact') }}" class="hover:text-green-600">Contact</a></li>

                        <!-- Account Dropdown for Desktop -->
                        <li x-data="{ open: false }" class="relative inline-block">
                            <button @click="open = !open" class="flex items-center hover:text-green-600">
                                Register
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="{{ route('auth.register-user') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">User Register</a>
                                    <a href="{{ route('auth.safety-consultant-login') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Registered Safety Consultant</a>
                                </div>
                            </div>
                        </li>

                        <!-- Account Dropdown for Desktop -->
                        <li x-data="{ open: false }" class="relative inline-block">
                            <button @click="open = !open" class="flex items-center hover:text-green-600">
                                Login
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="{{ route('auth.login-user') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">User Login</a>
                                    <a href="{{ route('auth.safety-consultant-login') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Login Safety Consultant</a>
                                </div>
                            </div>
                        </li>

                        <!--- TO be deleted-->
                        {{-- <li><a href="{{ route('auth.declaration') }}" class="hover:text-green-600">Declaration</a></li>
                        <li><a href="{{ route('auth.user-otp-verify') }}" class="hover:text-green-600">OTP
                                Verification</a></li>
                        <li><a href="{{ route('auth.forgot-password') }}" class="hover:text-green-600">Forgot
                                Password</a></li>
                        <li><a href="{{ route('auth.billing') }}" class="hover:text-green-600">Billing</a></li> --}}

                        <!----End of to be deleted-->
                    </ul>

                    <!-- Language Selection -->
                    <select class="border rounded-md p-2 text-gray-700 ml-6">
                        <option value="en">English</option>
                        <option value="fr">Yoruba</option>
                        {{-- <option value="es">Spanish</option> --}}
                    </select>
                </nav>

                <button id="mobile-menu-button" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <nav id="mobile-menu" class="mobile-menu mt-4 md:hidden">
                <ul class="flex flex-col space-y-2 text-gray-700">
                    <li><a href="#" class="hover:text-green-600">Home</a></li>
                    <li><a href="{{ route('user.contact') }}" class="hover:text-green-600">Contact</a></li>
                    <li><a href="#" class="hover:text-green-600">Services</a></li>
                    <li><a href="{{ route('auth.safety-consultant-login') }}" class="hover:text-green-600">Registered
                            Safety Consultant</a></li>

                    <!-- Mobile Account Dropdown for Register -->
                    <li x-data="{ open: false }" class="relative inline-block">
                        <button @click="open = !open" class="flex items-center hover:text-green-600">
                            Register
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Mobile Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ route('auth.register-user') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">User Register</a>
                                <a href="{{ route('auth.safety-consultant-login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Registered Safety Consultant</a>
                            </div>
                        </div>
                    </li>

                    <!-- Mobile Account Dropdown for Login -->
                    <li x-data="{ open: false }" class="relative inline-block">
                        <button @click="open = !open" class="flex items-center hover:text-green-600">
                            Login
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Mobile Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ route('auth.login-user') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">User Login</a>
                                <a href="{{ route('auth.safety-consultant-login') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Login Safety Consultant</a>
                            </div>
                        </div>
                    </li>

                    <!--- TO be deleted-->
                    {{-- <li><a href="{{ route('auth.declaration') }}" class="hover:text-green-600">Declaration</a></li>
                    <li><a href="{{ route('auth.user-otp-verify') }}" class="hover:text-green-600">OTP
                            Verification</a></li>
                    <li><a href="{{ route('auth.forgot-password') }}" class="hover:text-green-600">Forgot
                            Password</a></li>
                    <li><a href="{{ route('auth.billing') }}" class="hover:text-green-600">Billing</a></li> --}}

                    <!----End of to be deleted-->
                </ul>
            </nav>
        </div>
        <div class="relative overflow-hidden bg-gray-100 ">
            <div class="scroll-container">
                <div class="scroll-text text-white text-lg font-semibold">
                    Collection of Fire Certificate for Building is Free
                </div>

            </div>
        </div>
    </header>



    @yield('content')

    <footer class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Information -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-yellow-400">Contact Us</h3>
                    <p class="mb-2">123 Lagos Road, Ikeja</p>
                    <p class="mb-2">Lagos State, Nigeria</p>
                    <p class="mb-2">Phone: +234 807 1253 132</p>
                    <p class="mb-2">Email: admin@firesafetylevyclearance.org.ng</p>
                    <p class="mb-2">Working Hours: 8am-4pm</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-yellow-400">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Register your
                                business</a></li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Fire Safety Levy
                                Portal</a></li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Privacy Policy</a>
                        </li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Terms of
                                Service</a>
                        </li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Sitemap</a></li>
                    </ul>
                </div>

                <!-- Social Media & Resources -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-yellow-400">Connect With Us</h3>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="text-white hover:text-blue-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white hover:text-blue-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white hover:text-red-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-yellow-400">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-green-400 transition duration-300">FAQs</a></li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Forms &
                                Documents</a>
                        </li>
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Guidelines</a></li>
                    </ul>
                </div>
            </div>

            <!-- Pay Now Button -->
            <div class="mt-8 text-center">
                <a href="#"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                    Pay Now
                </a>
            </div>

            <!-- Copyright and Mission Statement -->
            <div class="mt-8 pt-8 border-t border-blue-800 text-center">
                <p class="text-sm mb-4">
                    Our mission is to ensure the safety of all Lagos State residents and businesses through effective
                    fire safety measures and regulations.
                </p>
                <p class="text-sm">
                    © {{ date('Y') }} Lagos State Fire Safety Levy Clearance. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    <button id="scrollToTop"
        class="fixed bottom-4 right-4 bg-blue-500 text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105 hidden"
        aria-label="Scroll to Top">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l3-3m-3 3l3 3" />
        </svg>
    </button>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('active');
        });

        // handling scroll to top
        // Get the button
        const scrollToTopBtn = document.getElementById('scrollToTop');

        // Show the button when the user scrolls down 100px from the top of the document
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollToTopBtn.classList.remove('hidden');
            } else {
                scrollToTopBtn.classList.add('hidden');
            }
        };

        // Scroll to the top when the button is clicked
        scrollToTopBtn.onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>



    @stack('scripts')
</body>

</html>
