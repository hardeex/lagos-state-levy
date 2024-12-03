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
                <span><i class="fas fa-building mr-2"></i>Accounting</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">

                <a href="{{ route('auth.billing') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-dollar-sign mr-2"></i>Account Summary
                </a>

                <a href="{{ route('auth.account-history') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-history mr-2"></i> Account History
                </a>
                {{-- <a href="{{ route('auth.calendar') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Visitation</a> --}}


                <a href="{{ route('auth.generate-invoice') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-file-invoice mr-2"></i>Invoice
                </a>

            </div>
        </div>

        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-building mr-2"></i>Business</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <!-- Applications -->
                <a href="{{ route('user.certtificate') }}" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">
                    <i class="fas fa-clipboard-check mr-2"></i>Applications</a>

                <!-- Clearance -->
                <a href="{{ route('auth.clearance') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-check-circle mr-2"></i>Clearance</a>

                <!-- Declaration -->
                <a href="{{ route('auth.invoice-list') }}" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">
                    <i class="fas fa-file-invoice mr-2"></i>Declaration</a>

                <!-- Documents -->
                <a href="{{ route('auth.upload-receipt') }}" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">
                    <i class="fas fa-folder-open mr-2"></i>Documents</a>

                <!-- Official Returns -->
                <a href="{{ route('auth.official-returns') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-file-alt mr-2"></i>Official Returns</a>

                <!-- Receipts -->
                <a href="{{ route('auth.upload-receipt') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                    <i class="fas fa-upload mr-2"></i>Receipts</a>

                <!-- Visitation -->
                <a href="{{ route('auth.calendar') }}" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">
                    <i class="fas fa-calendar-check mr-2"></i>Visitation</a>
            </div>
        </div>


        {{-- <div class="menu-item">
            <a href="{{ route('auth.billing') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-dollar-sign mr-2"></i>Accounting
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.calendar') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-calendar-alt mr-2"></i>Visitation
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.official-returns') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-file-alt mr-2"></i>Official Returns
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.upload-receipt') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-upload mr-2"></i>Receipts
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.generate-invoice') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-file-invoice mr-2"></i>Invoice
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.account-history') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-history mr-2"></i>History
            </a>
        </div> --}}

        {{-- <div class="menu-item">
            <a href="{{ route('auth.clearance') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-check-circle mr-2"></i>Clearance
            </a>
        </div> --}}







        {{-- <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-building mr-2"></i>More Pages</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="{{ route('auth.official-returns') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Official Returns</a>

                <a href="{{ route('auth.receipt') }}" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">
                    Upload Receipt</a>

                <a href="{{ route('auth.upload-receipt') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Receipt</a>
                <a href="{{ route('auth.invoice-list') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Invoice List</a>

            </div>
        </div> --}}

        {{-- 
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-building mr-2"></i>Accounts</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">
                <a href="{{ route('auth.account-history') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">History</a>

                <a href="{{ route('auth.clearance') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Clearance </a>


            </div>
        </div> --}}






        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-user-circle mr-2"></i>Profile</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4">


                <a href="{{ route('user.profile') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Business Profile</a>

                <a href="{{ route('auth.list-branches') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Branches List</a>

                <form action="{{ route('user.application-list') }}" method="POST">
                    @csrf
                    <button type="submit" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">My
                        Application</button>
                </form>

                <form action="{{ route('auth.get-document') }}" method="POST">
                    @csrf
                    <button type="submit" class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">My
                        Documents</button>
                </form>


                <a href="{{ route('auth.change-password') }}"
                    class="block py-2 px-4 text-sm hover:bg-blue-700 rounded">Change Password</a>
            </div>
        </div>

        {{-- <div class="menu-item">
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
        </div> --}}

        {{-- <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-chart-line mr-2"></i>Monitoring
            </a>
        </div> --}}

        <div class="menu-item">
            <a href="{{ route('user.support') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
                <i class="fas fa-question-circle mr-2"></i>Help & Support
            </a>
        </div>

        <div class="menu-item">
            <a href="{{ route('auth.logout-user') }}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-700 hover:text-white">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>
    </nav>
</div>
