<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!--- for chart-->

    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
        }

        .submenu.active {
            max-height: 1000px;
            transition: max-height 1s ease-in-out;
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                z-index: 50;
                transition: transform 0.3s ease-in-out;
                transform: translateX(-100%);
                top: 0;
                bottom: 0;
                left: 0;
            }

            #sidebar.open {
                transform: translateX(0);
            }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .hamburger {
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
                cursor: pointer;
            }
        }

        @media (min-width: 768px) {
            .md\:ml-64 {
                margin-left: 16rem;
            }
        }
    </style>
</head>
@include('partials.preloader')

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!--- SIDEBAR-->
        @yield('sidebar')




        <!-- Content area -->
        <div id="content-area" class="flex-1 flex flex-col  transition-margin duration-300 ease-in-out">
            <!-- Top bar -->
            <header class="bg-white shadow-md">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle" class="hamburger text-gray-500 focus:outline-none md:hidden"
                            aria-label="Toggle menu" aria-expanded="false" aria-controls="sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800 ml-4">Dashboard</h2>
                    </div>
                    <div class="flex items-center">
                        <input type="text" placeholder="Search..."
                            class="px-4 py-2 rounded-l-md border-t border-b border-l text-gray-700 focus:outline-none focus:border-blue-500">
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <div class="flex items-center hidden sm:inline">
                            <button @click="open = !open" class="flex items-center text-gray-500 hover:text-gray-600">
                                <i class="fas fa-user-circle text-2xl mr-2"></i>
                                <span>Account</span>
                            </button>
                        </div>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md z-50">
                            <form action="{{ url('/user-logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 w-full text-left">Logout</button>
                            </form>
                        </div>
                    </div>


                </div>
            </header>


            <!-- Main content -->
            @yield('content')

        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const contentArea = document.getElementById('content-area');
            const menuItems = document.querySelectorAll('.menu-item');

            // Toggle sidebar
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                contentArea.classList.toggle('md:ml-64');
                document.body.classList.toggle('overflow-hidden');

                const isExpanded = sidebar.classList.contains('open');
                sidebarToggle.setAttribute('aria-expanded', isExpanded);
                sidebar.setAttribute('aria-hidden', !isExpanded);
            });

            // Close sidebar when clicking outside
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                contentArea.classList.remove('md:ml-64');
                document.body.classList.remove('overflow-hidden');
                sidebarToggle.setAttribute('aria-expanded', 'false');
                sidebar.setAttribute('aria-hidden', 'true');
            });

            // Submenu toggle
            menuItems.forEach((item, index) => {
                const link = item.querySelector('a');
                const submenu = item.querySelector('.submenu');

                if (submenu) {
                    // Set unique IDs for ARIA attributes
                    const submenuId = `submenu-${index}`;
                    submenu.id = submenuId;
                    link.setAttribute('aria-controls', submenuId);

                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const isExpanded = submenu.classList.contains('active');

                        // Close all other open submenus
                        menuItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                const otherSubmenu = otherItem.querySelector('.submenu');
                                const otherLink = otherItem.querySelector('a');
                                if (otherSubmenu && otherSubmenu.classList.contains(
                                        'active')) {
                                    otherSubmenu.classList.remove('active');
                                    otherLink.setAttribute('aria-expanded', 'false');
                                    otherLink.querySelector('.fas').classList.remove(
                                        'fa-chevron-up');
                                    otherLink.querySelector('.fas').classList.add(
                                        'fa-chevron-down');
                                }
                            }
                        });

                        // Toggle current submenu
                        submenu.classList.toggle('active');
                        link.setAttribute('aria-expanded', !isExpanded);
                        link.querySelector('.fas').classList.toggle('fa-chevron-up');
                        link.querySelector('.fas').classList.toggle('fa-chevron-down');
                    });

                    // Set initial ARIA attributes
                    link.setAttribute('aria-expanded', 'false');
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                    document.body.classList.remove('overflow-hidden');
                    contentArea.classList.add('md:ml-64');
                } else {
                    contentArea.classList.remove('md:ml-64');
                }
            });
        });
    </script>


    @stack('scripts')
</body>

</html>
