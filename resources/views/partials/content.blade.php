<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-gray-700 text-3xl font-medium">Welcome back, getUserName!
            </h3>

        </div>

        <!-- Quick Actions -->
        <div class="flex flex-wrap -mx-3 mb-8">
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 mb-6">
                <button
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-plus-circle mr-2"></i> New Booking
                </button>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 mb-6">
                <button
                    class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-300">
                    <i class="fas fa-user-plus mr-2"></i> Add Customer
                </button>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 mb-6">
                <button
                    class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-300">
                    <i class="fas fa-cog mr-2"></i> Settings
                </button>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-3 mb-6">
                <button
                    class="w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 transition duration-300">
                    <i class="fas fa-chart-line mr-2"></i> View Reports
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="flex flex-wrap -mx-6 mb-8">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/4 mb-4">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">8,282</h4>
                        <div class="text-gray-500">Active Bookings</div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 sm:w-1/2 xl:w-1/4 mb-4">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                        <i class="fas fa-dollar-sign text-white text-2xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700"> 15,256</h4>
                        <div class="text-gray-500">Total Revenue</div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 sm:w-1/2 xl:w-1/4 mb-4">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">215,542</h4>
                        <div class="text-gray-500">New Customers</div>
                    </div>
                </div>
            </div>
            <div class="w-full px-6 sm:w-1/2 xl:w-1/4 mb-4">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                    <div class="p-3 rounded-full bg-yellow-600 bg-opacity-75">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">4.8</h4>
                        <div class="text-gray-500">Average Rating</div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Charts and Widgets -->
        <div class="flex flex-wrap -mx-3 mb-8">
            <!-- Booking Trend Chart -->
            <div class="w-full xl:w-2/3 px-3 mb-6">
                <div class="bg-white rounded-md shadow-md p-6">
                    <h4 class="text-xl font-semibold mb-4">Booking Trends</h4>
                    <div class="h-64">
                        <!-- Replace this with an actual chart component -->
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                            Booking Trend Chart Placeholder
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="w-full xl:w-1/3 px-3 mb-6">
                <div class="bg-white rounded-md shadow-md p-6">
                    <h4 class="text-xl font-semibold mb-4">Recent Activity</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">New
                                Booking</span>
                            <span class="text-gray-600">John Doe booked Room 101</span>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">Payment</span>
                            <span class="text-gray-600">NGN 500 received from Jane Smith</span>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">Review</span>
                            <span class="text-gray-600">New 5-star review from Mark Johnson</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Calendar and Tasks -->
        <div class="flex flex-wrap -mx-3">
            <!-- Calendar Widget -->
            <div class="w-full md:w-1/2 px-3 mb-6">
                <div class="bg-white rounded-md shadow-md p-6">
                    <h4 class="text-xl font-semibold mb-4">Upcoming Bookings</h4>
                    <div class="h-64">
                        <!-- Replace this with an actual calendar component -->
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                            Calendar Widget Placeholder
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task List -->
            <div class="w-full md:w-1/2 px-3 mb-6">
                <div class="bg-white rounded-md shadow-md p-6">
                    <h4 class="text-xl font-semibold mb-4">Tasks</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span class="text-gray-600">Confirm reservation for Room 205</span>
                        </li>
                        <li class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span class="text-gray-600">Update room prices for weekend</span>
                        </li>
                        <li class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span class="text-gray-600">Respond to customer inquiry</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
