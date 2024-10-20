<div id="sidebar"
    class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out overflow-y-auto h-screen"
    aria-hidden="true">
    <style>
        #sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }

        body {
            padding-left: 16rem;
        }




        /* For mobile responsiveness */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }

            body {
                padding-left: 0;
            }
        }
    </style>

    <a href="{{ route('welcome') }}">
        <div class="font-sans text-2xl font-bold tracking-wide">
            <span class="text-white-500">Lagos</span><span class="text-blue-500">F</span><span
                class="text-yellow-500">S</span><span class="text-green-500">LC</span>
        </div>
    </a>
    <nav class="space-y-2">
        <div class="menu-item">
            <a href="{{ route('auth.dashboard') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
            </a>
        </div>

        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-building mr-2"></i>Busines</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Accounting</a>
                <a href="{{ route('auth.billing') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Billing</a>
                <a href="{{ route('auth.declaration') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Declarations</a>

                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Calendar</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Upload
                    <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Compliance</a>
                </a>

            </div>
        </div>


        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-building mr-2"></i>More Pages</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="{{ route('auth.official-returns') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Official Returns</a>


            </div>
        </div>






        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-user-circle mr-2"></i>Profile</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Edit Profile</a>
                <a href="{{ route('auth.change-password') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Change Password</a>
            </div>
        </div>

        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-cog mr-2"></i>Settings</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">General</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Notifications</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Security</a>
            </div>
        </div>

        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-chart-line mr-2"></i>Monitoring
            </a>
        </div>

        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-question-circle mr-2"></i>Help & Support
            </a>
        </div>
    </nav>
</div>
