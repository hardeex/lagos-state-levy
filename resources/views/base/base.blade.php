<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LagosFSLC')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
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

    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('welcome') }}">
                    <img src="/api/placeholder/200/80" alt="Lagos State Logo" class="h-16">
                </a>

                <nav class="hidden md:block">
                    <ul class="flex space-x-6 text-gray-700">
                        <li><a href="#" class="hover:text-green-600">Home</a></li>
                        <li><a href="#" class="hover:text-green-600">About</a></li>
                        <li><a href="#" class="hover:text-green-600">Services</a></li>
                        <li><a href="#" class="hover:text-green-600">Payments</a></li>
                        <li><a href="{{ route('user.contact') }}" class="hover:text-green-600">Contact</a></li>
                        <li class="relative group">
                            <a href="#" class="hover:text-green-600">Account</a>
                            <div class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 group-hover:block">
                                <ul class="flex flex-col">
                                    <li><a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login</a></li>
                                    <li><a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Register</a></li>
                                    <li><a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
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
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Home</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">About</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Services</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Payments</a></li>
                    <li><a href="{{ route('user.contact') }}" class="block py-2 px-4 hover:bg-gray-200">Contact</a></li>
                    <li class="relative">
                        <a href="#" class="block py-2 px-4 hover:bg-gray-200">Account</a>
                        <ul class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40">
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Register</a>
                            </li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
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
                        <li><a href="#" class="hover:text-green-400 transition duration-300">Terms of Service</a>
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
