@extends('base.base')
@section('title', 'Home')





@section('content')

    <main>
        <div class="bg-gray-100 font-sans">
            <section class="bg-blue-600 text-white py-20">
                <div class="container mx-auto px-4 text-center">
                    <h1 class="text-4xl font-bold mb-4">Welcome to Lagos State Levy Collection</h1>
                    <p class="text-xl mb-8">Easy, secure, and efficient payment of government levies</p>
                    <a href="#"
                        class="bg-yellow-500 text-blue-900 px-6 py-3 rounded-full font-semibold hover:bg-yellow-400 transition duration-300">Make
                        a Payment</a>
                </div>
            </section>

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

            <section class="bg-gray-200 py-16">
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
            </section>
    </main>

@endsection
