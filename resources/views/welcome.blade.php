@extends('base.base')
@section('title', 'Home')

@section('content')
    <main>
        <div class="bg-gray-100 font-sans">


            {{-- <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
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
            </section> --}}



            <style>
                .bg-image {
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            </style>

            <div x-data="carousel()" x-init="startAutoSlide()" @keydown.right="next()" @keydown.left="prev()"
                class="relative overflow-hidden h-screen">
                <div class="flex h-full transition-transform duration-500 ease-in-out"
                    :style="`transform: translateX(-${currentIndex * 100}%)`">
                    <!-- Slide 1: Lagos State Levy Collection -->
                    <div class="w-full flex-shrink-0 bg-image relative" style="background-image: url('/images/lagos9.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-5xl font-bold mb-4 animate__animated animate__fadeInDown">Empowering Lagos:
                                Streamline Your Levy Payments</h2>
                            <p class="text-xl mb-8 animate__animated animate__fadeInUp">Fuel our city's growth with swift,
                                secure government levy contributions</p>
                        </div>
                    </div>

                    <!-- Slide 2: Fire and Rescue Service -->
                    <div class="w-full flex-shrink-0 bg-image relative"
                        style="background-image: url('/images/lagos10.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Safeguarding Lagos:
                                Your Fire and Rescue Heroes</h2>
                            <p class="text-2xl mb-8 animate__animated animate__fadeInUp">"Extinguishing Threats, Igniting
                                Hope - With Passion and Precision"</p>
                        </div>
                    </div>

                    <!-- Slide 3: Our Mission -->
                    <div class="w-full flex-shrink-0 bg-image relative"
                        style="background-image: url('/images/lagos14.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Our Unwavering Mission
                            </h2>
                            <p class="text-2xl mb-8 animate__animated animate__fadeInUp">"Transforming Chaos into Calm -
                                Your Lifeline in Crisis"</p>
                        </div>
                    </div>

                    <!-- Slide 4: Our Commitment -->
                    <div class="w-full flex-shrink-0 bg-image relative"
                        style="background-image: url('/images/lagos17.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Unwavering Commitment
                                to You</h2>
                            <p class="text-2xl mb-8 animate__animated animate__fadeInUp">"Forging Safety with Brave Hands
                                and Strong Hearts - Your Community's Unmatched Guardians"</p>
                        </div>
                    </div>

                    <!-- Slide 5: Our Duty -->
                    <div class="w-full flex-shrink-0 bg-image relative"
                        style="background-image: url('/images/lagos4.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Embracing Our Sacred
                                Duty</h2>
                            <p class="text-2xl mb-8 animate__animated animate__fadeInUp">"Shielding Lives, Securing Futures
                                - Your Protection is Our Purpose"</p>
                        </div>
                    </div>

                    <!-- Slide 6: Our Motto -->
                    <div class="w-full flex-shrink-0 bg-image relative"
                        style="background-image: url('/images/lagos8.jpg');">
                        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        <div
                            class="container mx-auto px-4 h-full flex flex-col justify-center items-center text-center text-white relative z-10">
                            <h2 class="text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Living Our Motto Every
                                Day</h2>
                            <p class="text-2xl mb-8 animate__animated animate__fadeInUp">"Prioritizing Safety, Always and
                                Everywhere - Your Well-being is Our Mandate"</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button @click="prev()"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Navigation Dots -->
                <div class="absolute bottom-4 left-0 right-0">
                    <div class="flex items-center justify-center gap-2">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="goToSlide(index)"
                                class="w-3 h-3 rounded-full transition-all duration-300 ease-in-out"
                                :class="currentIndex === index ? 'bg-white scale-110' : 'bg-white bg-opacity-50'"></button>
                        </template>
                    </div>
                </div>
            </div>

            <script>
                function carousel() {
                    return {
                        currentIndex: 0,
                        slides: [0, 1, 2, 3, 4, 5],
                        next() {
                            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
                        },
                        prev() {
                            this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                        },
                        goToSlide(index) {
                            this.currentIndex = index;
                        },
                        startAutoSlide() {
                            setInterval(() => {
                                this.next();
                            }, 5000); // Change slide every 5 seconds
                        }
                    }
                }
            </script>

            <!-- Notification Banner -->
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md"
                role="alert">
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
                            <h3 class="text-xl font-semibold mb-4">Obtain Company Clearance and Fire Certificate for
                                Building</h3>
                            <p class="text-gray-600 mb-4">
                                Improve your expertise with our training programs in Lagos, designed to empower individuals
                                and organizations.
                            </p>
                            <a href="{{ route('auth.register-user') }}" class="text-green-600 hover:underline">Apply
                                Now...</a>
                        </div>


                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Registered Lagos state fire satefy consultant
                            </h3>
                            <p class="text-gray-600 mb-4">Register and manage your safety consulting services in Lagos
                                State. Ensure compliance and provide top-notch safety solutions for businesses.</p>
                            <a href="{{ route('auth.register-user') }}" class="text-green-600 hover:underline">Register</a>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Training &amp; Certification</h3>
                            <p class="text-gray-600 mb-4">Enhance your skills and knowledge with our training programs in
                                Lagos. We offer various courses designed to empower individuals and organizations.</p> <br>
                            <a href="{{ route('user.training') }}" class="text-green-600 hover:underline">Apply
                                Now...</a>
                        </div>



                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-4">Fire Safety Levy</h3>
                            <p class="text-gray-600 mb-4">
                                The Fire Safety Levy is a vital program designed to ensure compliance with fire safety
                                regulations in buildings. By participating, you help create a safer environment and reduce
                                fire hazards in Lagos.
                            </p>
                            <a href="#" class="text-green-600 hover:underline">Read More...</a>
                        </div>



                        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
                            <h3 class="text-xl font-semibold mb-4">Fire Safety Training Workshops</h3>
                            <p class="text-gray-600 mb-4">
                                Join our interactive workshops to learn essential fire safety techniques and regulations,
                                helping you stay prepared and informed.
                            </p>
                            <a href="{{ route('auth.register-user') }}" class="text-green-600 hover:underline">Register
                                Now...</a>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
                            <h3 class="text-xl font-semibold mb-4">Other Services</h3>
                            <p class="text-gray-600 mb-4">
                                Explore additional services we offer, including fire risk assessments, safety audits, and
                                compliance consultations to enhance your safety measures.
                            </p>
                            <a href="{{ route('auth.register-user') }}" class="text-green-600 hover:underline">Discover
                                More...</a>
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

            <div class="container mx-auto px-4 py-8">
                {{-- <h1 class="text-4xl font-bold text-center text-blue-700 mb-12">Government Levy Dashboard</h1> --}}



                {{-- <!-- Latest News Section -->
                <section class="mb-12">
                    <h3 class="text-3xl font-bold mb-6 text-blue-700">Latest Updates</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach ([['New Levy Policies', 'Important changes to our levy structure...'], ['Upcoming Payment Deadline', 'Don\'t forget to submit your payments by...'], ['Community Project Showcase', 'See the impact of your contributions...']] as [$title, $excerpt])
                            <article
                                class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <img src="https://placehold.co/400x200?text=News+Image" alt="News Image"
                                    class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h4 class="font-semibold text-xl text-gray-800 mb-2">{{ $title }}</h4>
                                    <p class="text-gray-600 mb-4">{{ $excerpt }}</p>
                                    <a href="#"
                                        class="text-blue-500 hover:text-blue-700 font-semibold transition duration-300 flex items-center">
                                        Read more
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <!-- Statistical Dashboard -->
                <section class="mb-12 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-6 text-blue-700">Statistical Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ([['Total Levies Collected', '₦2,500,000', 'text-green-600', 'currency-dollar'], ['Funds Utilized', '₦1,800,000', 'text-blue-600', 'chart-bar'], ['Programs Supported', '18', 'text-purple-600', 'users']] as [$title, $value, $color, $icon])
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 flex items-center">
                                <div class="mr-4">
                                    <svg class="w-12 h-12 {{ $color }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if ($icon == 'currency-dollar')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        @elseif($icon == 'chart-bar')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800 mb-2">{{ $title }}</h4>
                                    <p class="text-3xl font-bold {{ $color }}">{{ $value }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Featured Program -->
                <section class="mb-12 bg-gradient-to-r from-green-400 to-blue-500 p-8 rounded-xl shadow-lg text-white">
                    <h3 class="text-3xl font-semibold mb-4">Featured: Community Health Initiative</h3>
                    <p class="text-xl mb-6">This month, we're highlighting our efforts to improve local healthcare
                        facilities. Your levies are making a difference!</p>
                    <a href="#"
                        class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-100 transition duration-300 inline-block">Learn
                        More</a>
                </section>

                <!-- Testimonials -->
                <section class="mb-12 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold mb-6 text-blue-700">Community Voices</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ([['John Doe', 'Community Leader', 'The levy programs have greatly improved our local infrastructure...'], ['Jane Smith', 'Small Business Owner', 'Thanks to the business development initiatives funded by these levies...']] as [$name, $role, $quote])
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <blockquote class="text-gray-600 mb-4">"{{ $quote }}"</blockquote>
                                <div class="flex items-center">
                                    <img src="https://placehold.co/100x100?text={{ substr($name, 0, 1) }}"
                                        alt="{{ $name }}" class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $name }}</p>
                                        <p class="text-gray-600">{{ $role }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section> --}}

                <!-- FAQ Section -->
                {{-- <section class="mb-12 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold mb-6 text-blue-700">Frequently Asked Questions</h3>
                    <div class="space-y-4">
                        @foreach ([['What is a government levy?', 'A government levy is a tax imposed on specific goods, services, or transactions...'], ['How can I pay my levy?', 'You can pay your levy through various methods including online payments, bank transfers...'], ['What are the deadlines for levy payments?', 'Levy payment deadlines vary depending on the type of levy. Generally...']] as [$question, $answer])
                            <div class="border-b pb-4">
                                <button
                                    class="flex justify-between w-full text-left p-2 font-medium text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg focus:outline-none"
                                    onclick="toggleAnswer(this)">
                                    <span>{{ $question }}</span>
                                    <span class="ml-2">&#x25BC;</span> <!-- Down arrow icon -->
                                </button>
                                <p class="hidden text-gray-600 mt-2">{{ $answer }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="block w-full text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            View All FAQs
                        </a>
                    </div>
                </section> --}}

                @push('scripts')
                    <script>
                        function toggleAnswer(button) {
                            const answer = button.nextElementSibling;
                            if (answer.classList.contains('hidden')) {
                                answer.classList.remove('hidden');
                                button.querySelector('span:last-child').innerHTML = '&#x25B2;'; // Up arrow icon
                            } else {
                                answer.classList.add('hidden');
                                button.querySelector('span:last-child').innerHTML = '&#x25BC;'; // Down arrow icon
                            }
                        }
                    </script>
                @endpush


                <!-- Contact and Feedback -->
                <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-4 text-blue-700">Contact Us</h3>
                        <p class="text-gray-700 mb-4">For any inquiries, please reach out to us:</p>
                        <p class="text-gray-700">Email: <a href="mailto:info@lagos.gov.ng"
                                class="text-blue-500 hover:text-blue-700">info@lagos.gov.ng</a></p>
                        <p class="text-gray-700">Phone: <span class="font-medium">(01) 234-5678</span></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-4 text-blue-700">We Value Your Feedback</h3>
                        <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="feedback" class="block text-gray-700 mb-2">Your Feedback</label>
                                <textarea id="feedback" name="feedback" rows="4"
                                    class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500"
                                    placeholder="Share your thoughts..."></textarea>
                            </div>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Submit
                                Feedback</button>
                        </form>
                    </div>
                </section>
            </div>

            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Sample chart data
                    const ctx = document.getElementById('levy-chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Monthly Levy Collection (₦)',
                                data: [1200000, 1500000, 1800000, 1600000, 2000000, 2200000],
                                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                                borderColor: 'rgb(59, 130, 246)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value, index, values) {
                                            return '₦' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            @endpush


        </div>
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
