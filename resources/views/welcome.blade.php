@extends('base.base')
@section('title', 'Home')

@section('content')
    <main>
        <div class="bg-gray-100 font-sans">


            <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
                <div class="container mx-auto px-4 text-center">
                    <h1 class="text-5xl font-bold mb-4 animate__animated animate__fadeInDown">Welcome to Lagos State Levy
                        Collection</h1>
                    <p class="text-xl mb-8 animate__animated animate__fadeInUp">Easy, secure, and efficient payment of
                        government levies</p>
                    <a href="#"
                        class="bg-yellow-500 text-blue-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-400 transition duration-300 animate__animated animate__bounceIn">
                        Make a Payment
                    </a>
                </div>
            </section>

            <!-- Notification Banner -->
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold">Important Update</p>
                        <p class="text-sm">New fire safety regulations are now in effect. Please ensure your business is
                            compliant.</p>
                    </div>
                </div>
            </div>

            <section class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Fire Safety Levy</h3>
                            <p class="text-gray-600 mb-4">Ensure compliance with fire safety regulations and contribute to a
                                safer Lagos.</p>
                            <a href="#" class="text-green-600 hover:underline">Learn More</a>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Business Premises Levy</h3>
                            <p class="text-gray-600 mb-4">Register and pay levies for your business premises in Lagos State.
                            </p>
                            <a href="#" class="text-green-600 hover:underline">Learn More</a>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Environmental Levy</h3>
                            <p class="text-gray-600 mb-4">Support environmental initiatives and sustainable development in
                                Lagos.</p>
                            <a href="#" class="text-green-600 hover:underline">Learn More</a>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-16 bg-gray-100">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12 text-blue-800">How it Works: Fire Safety Levy Clearance
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                1
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Register Your Organization</h3>
                            <p class="text-gray-600 text-center">
                                Visit www.firesafetylevyclearance.org.ng and register as a company. Login details will be
                                sent to your phone and email.
                            </p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                2
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Access the Portal</h3>
                            <p class="text-gray-600 text-center">
                                Log in to the Fire Safety Levy Clearance Portal using your provided credentials.
                            </p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                3
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Submit Details</h3>
                            <p class="text-gray-600 text-center">
                                Fill in necessary details in the Declaration Page. Save to generate your assessed levy due
                                for payment.
                            </p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                4
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Make Payment</h3>
                            <p class="text-gray-600 text-center">
                                Pay online or through the designated account as indicated in the portal.
                            </p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                5
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Schedule Inspection</h3>
                            <p class="text-gray-600 text-center">
                                Choose an acceptable date for the facility safety inspection.
                            </p>
                        </div>

                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4 mx-auto">
                                6
                            </div>
                            <h3 class="text-xl font-semibold mb-4 text-center">Obtain Clearance</h3>
                            <p class="text-gray-600 text-center">
                                Provide evidence of compliance with recommendations from the facility visit to receive your
                                Fire Safety Levy Clearance.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            {{-- <section class="bg-gray-200 py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12">Quick Links</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <a href="#" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
                            <span class="block text-xl font-semibold text-blue-600">Payment Status</span>
                        </a>
                        <a href="#" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
                            <span class="block text-xl font-semibold text-blue-600">Verify Certificate</span>
                        </a>
                        <a href="#" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
                            <span class="block text-xl font-semibold text-blue-600">FAQs</span>
                        </a>
                        <a href="#" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
                            <span class="block text-xl font-semibold text-blue-600">Contact Support</span>
                        </a>
                    </div>
                </div>
            </section> --}}

            <section class="bg-gray-100 py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12">Quick Links</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($quickLinks as $link)
                            <div x-data="{ showInfo: false }"
                                class="bg-white rounded-lg shadow hover:shadow-md transition duration-300">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-2xl {{ $link['iconColor'] }}">
                                            {!! $link['icon'] !!}
                                        </span>
                                        <button @click="showInfo = !showInfo"
                                            class="text-blue-600 hover:text-blue-800 text-sm">
                                            <span x-text="showInfo ? 'Hide Info' : 'More Info'"></span>
                                        </button>
                                    </div>
                                    <h3 class="text-xl font-semibold text-blue-600 mb-2">{{ $link['title'] }}</h3>
                                    <div x-show="showInfo" x-transition class="text-gray-600 mb-4">
                                        {{ $link['description'] }}
                                    </div>
                                    <a href="{{ $link['url'] }}"
                                        class="block w-full bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition duration-300">
                                        Access
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
