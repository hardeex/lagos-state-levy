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
                <img src="/api/placeholder/200/80" alt="Lagos State Logo" class="h-16">
                <nav class="hidden md:block">
                    <ul class="flex space-x-6 text-gray-700">
                        <li><a href="#" class="hover:text-green-600">Home</a></li>
                        <li><a href="#" class="hover:text-green-600">About</a></li>
                        <li><a href="#" class="hover:text-green-600">Services</a></li>
                        <li><a href="#" class="hover:text-green-600">Payments</a></li>
                        <li><a href="#" class="hover:text-green-600">Contact</a></li>
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
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
                    <p>123 Lagos Road, Ikeja</p>
                    <p>Lagos State, Nigeria</p>
                    <p>Phone: +234 123 456 7890</p>
                    <p>Email: info@lagoslevies.gov.ng</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-400">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Sitemap</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-yellow-400">Facebook</a>
                        <a href="#" class="hover:text-yellow-400">Twitter</a>
                        <a href="#" class="hover:text-yellow-400">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <p>&copy; 2024 Lagos State Government. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('active');
        });
    </script>



    @stack('scripts')
</body>

</html>
