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

            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-3xl font-bold mb-6 text-blue-600 text-center">Latest News</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <article
                        class="flex flex-col border rounded-lg overflow-hidden shadow hover:shadow-xl transition-transform transform hover:scale-105 duration-300">
                        <img src="https://via.placeholder.com/400x200" alt="News Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-6 h-6 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm0 22c-5.525 0-10-4.475-10-10S6.475 2 12 2s10 4.475 10 10-4.475 10-10 10zm-1-15h2v7h-2zm0 8h2v2h-2z" />
                                </svg>
                                <h4 class="font-semibold text-gray-800">New Levy Policies Announced</h4>
                            </div>
                            <p class="text-gray-600 mb-4">Details about the recent changes in levy policies...</p>
                            <a href="#"
                                class="text-blue-500 hover:text-blue-700 font-semibold transition duration-300">Read
                                more</a>
                        </div>
                    </article>
                    <article
                        class="flex flex-col border rounded-lg overflow-hidden shadow hover:shadow-xl transition-transform transform hover:scale-105 duration-300">
                        <img src="https://via.placeholder.com/400x200" alt="News Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-6 h-6 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm0 22c-5.525 0-10-4.475-10-10S6.475 2 12 2s10 4.475 10 10-4.475 10-10 10zm-1-15h2v7h-2zm0 8h2v2h-2z" />
                                </svg>
                                <h4 class="font-semibold text-gray-800">Upcoming Deadline for Payments</h4>
                            </div>
                            <p class="text-gray-600 mb-4">Don’t miss the upcoming deadline on...</p>
                            <a href="#"
                                class="text-blue-500 hover:text-blue-700 font-semibold transition duration-300">Read
                                more</a>
                        </div>
                    </article>
                </div>
            </section>



            <section class="mt-12 bg-gradient-to-r from-green-100 to-blue-100 p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-green-700">Featured Program</h3>
                <p class="text-gray-700 mb-4">This month, we are highlighting...</p>
                <a href="#"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Learn
                    More</a>
            </section>


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Statistical Dashboard</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-800">Total Levies Collected</h4>
                        <p class="text-3xl font-bold text-blue-600">₦2,000,000</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-800">Funds Utilized</h4>
                        <p class="text-3xl font-bold text-blue-600">₦1,500,000</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-800">Programs Supported</h4>
                        <p class="text-3xl font-bold text-blue-600">15</p>
                    </div>
                </div>
            </section>


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Testimonials</h3>
                <div class="carousel">
                    <div class="carousel-item">
                        <blockquote class="border-l-4 border-blue-600 pl-4">
                            <p class="text-gray-600">"The levy programs have greatly improved our community..."</p>
                            <cite class="font-semibold">- John Doe, Community Leader</cite>
                            <div class="flex items-center mt-2">
                                <img src="path/to/john-doe.jpg" alt="John Doe" class="w-12 h-12 rounded-full">
                                <div class="ml-2">
                                    <p class="text-sm font-medium">John Doe</p>
                                    <p class="text-xs text-gray-500">Community Leader</p>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </section>


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Frequently Asked Questions</h3>
                <div class="space-y-4">
                    <div class="border-b pb-4">
                        <h4 class="font-medium text-gray-700">What is a government levy?</h4>
                        <p class="text-gray-600">A government levy is...</p>
                    </div>
                    <div class="border-b pb-4">
                        <h4 class="font-medium text-gray-700">How can I pay my levy?</h4>
                        <p class="text-gray-600">You can pay through...</p>
                    </div>
                </div>
            </section>


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Upcoming Events</h3>
                <ul class="list-disc pl-5 space-y-2">
                    <li><span class="font-medium">Town Hall Meeting:</span> March 15, 2024</li>
                    <li><span class="font-medium">Deadline for Submissions:</span> April 1, 2024</li>
                </ul>
            </section>


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Resources and Downloads</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-500 hover:text-blue-700">Levy Payment Guide (PDF)</a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700">Annual Report 2023 (PDF)</a></li>
                </ul>
            </section>

            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Contact Information</h3>
                <p class="text-gray-700">For any inquiries, please reach out to us:</p>
                <p class="text-gray-700">Email: <a href="mailto:info@lagos.gov.ng"
                        class="text-blue-500 hover:text-blue-700">info@lagos.gov.ng</a></p>
                <p class="text-gray-700">Phone: <span class="font-medium">(01) 234-5678</span></p>
            </section>

           


            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">We Value Your Feedback</h3>
                <form action="#" method="POST" class="space-y-4">
                    <textarea class="border rounded-md w-full p-2" rows="4" placeholder="Your feedback..."></textarea>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Submit</button>
                </form>
            </section>

            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-instagram"></i></a>
                </div>
            </section>

            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">Levy Estimator</h3>
                <input type="number" placeholder="Enter your income" class="border rounded-md w-full p-2 mb-4">
                <button
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Estimate
                    Levy</button>
            </section>

            <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold mb-4 text-blue-600">What are Government Levies?</h3>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="rounded-lg" src="https://www.youtube.com/embed/your-video-id" allowfullscreen></iframe>
                </div>
            </section>


        </div>
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
