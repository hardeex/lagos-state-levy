@extends('base.base')
@section('title', 'Contact Us - Lagos State Government')

@section('content')
    <div class="bg-gradient-to-r from-blue-500 to-green-500 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Get in Touch</h1>
            <p class="text-xl">We're here to help you navigate the world of government levies.</p>
        </div>
    </div>

    <div class="space-y-4 max-w-2xl mx-auto p-4">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-red-800 font-medium">There were some errors with your submission</h3>
                </div>
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <section
                    class="bg-white p-6 rounded-lg shadow-md transform hover:scale-105 transition duration-300 md:w-1/2">
                    <h3 class="text-2xl font-semibold mb-4 text-blue-600">Contact Form</h3>
                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <select id="subject" name="subject"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                                required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="payment">Payment Issues</option>
                                <option value="refund">Refund Request</option>
                                <option value="complaint">File a Complaint</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                                required></textarea>
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-3 rounded-md hover:from-blue-600 hover:to-green-600 transition duration-300 transform hover:scale-105">Send
                            Message</button>
                    </form>
                </section>

                <section class="contact-section md:w-1/2 p-6">
                    <h3 class="contact-title">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <h4 class="contact-title-sub">Main Office</h4>
                                <p class="contact-text">Lagos State Government Secretariat, Alausa, Ikeja, Lagos</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <h4 class="contact-title-sub">Phone</h4>
                                <p class="contact-text">Toll-free: 0800-LAGOS-TAX (0800-52467-829)</p>
                                <p class="contact-text">Local: 01-2920101</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <h4 class="contact-title-sub">Email</h4>
                                <p class="contact-text">info@lagosstate.gov.ng</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="contact-title-sub">Office Hours</h4>
                                <p class="contact-text">Monday - Friday: 8:00 AM - 4:00 PM</p>
                                <p class="contact-text">Saturday - Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section class="mt-12 bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-3xl font-semibold mb-6 text-blue-600">Frequently Asked Questions</h3>
            <div class="space-y-4" x-data="{ activeAccordion: null }">
                <div class="border-b border-gray-200 pb-4">
                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">What is a Fire Warden?</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 1 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        A fire warden needs to effectively organize an evacuation from the building if there is a fire.
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">What are the Responsibilities of Fire Wardens?</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 2 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 2" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        The exact responsibilities of Fire Wardens varies from workplace to workplace. In general, the main
                        duties of fire wardens are to:
                        <ul class="list-disc list-inside mt-2">
                            <li>Perform risk assessments to identify fire hazards</li>
                            <li>Report and record all fire hazards</li>
                            <li>Ensure that all fire alarms and firefighting equipment are in good condition</li>
                            <li>Organize fire drills</li>
                            <li>Provide fire safety training for new employees</li>
                            <li>Provide fire safety refresher training for existing employees</li>
                        </ul>
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">How Many Fire Wardens Does Your Workplace Need?</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 3 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 3" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        <p>Considerations for calculating fire warden numbers:</p>
                        <ul class="list-disc list-inside mt-2">
                            <li>Size of premises: one fire warden per floor at a minimum</li>
                            <li>Presence of highly flammable materials</li>
                            <li>Nature of work that may impede evacuation</li>
                        </ul>
                        <p class="mt-2">Number of fire wardens by risk level:</p>
                        <ul class="list-disc list-inside mt-2">
                            <li>Low-risk: one trained fire warden for 20 occupants</li>
                            <li>Medium-risk: one trained fire warden for every 15 occupants</li>
                            <li>High-risk: one fire warden for every 8 occupants</li>
                        </ul>
                        <p class="mt-2">A business must assess its risk level.</p>
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <button @click="activeAccordion = activeAccordion === 4 ? null : 4"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">What is a Lagos State Fire Levy?</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 4 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 4" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        A Lagos State fire levy is a tax or fee imposed on businesses to fund fire prevention, protection,
                        and emergency services in Lagos State.
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-4">
                    <button @click="activeAccordion = activeAccordion === 5 ? null : 5"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">Services Covered by Fire Levy</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 5 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 5" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        The Lagos State Fire Levy covers:
                        <ul class="list-disc list-inside mt-2">
                            <li>Fire prevention</li>
                            <li>Fire suppression</li>
                            <li>Emergency medical response</li>
                            <li>Rescue operations</li>
                            <li>Fire safety education</li>
                        </ul>
                    </div>
                </div>

                <div class="pb-4">
                    <button @click="activeAccordion = activeAccordion === 6 ? null : 6"
                        class="flex justify-between items-center w-full p-3 transition-colors hover:bg-gray-100 rounded-md focus:outline-none">
                        <span class="font-medium text-gray-700">Fire Safety Clearance Certificate Procedure</span>
                        <svg :class="{ 'rotate-180': activeAccordion === 6 }"
                            class="w-5 h-5 transition-transform transform" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 6" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" class="mt-2 text-gray-600">
                        Steps to obtain Fire Safety Clearance Certificate:
                        <ol class="list-decimal list-inside mt-2">
                            <li>Register your business online</li>
                            <li>Search for and pay required fees for your business sector</li>
                            <li>List all business branches in Lagos</li>
                            <li>Pay required fees through the portal</li>
                            <li>If required, visit accredited consultants for safety equipment certification</li>
                            <li>Gather and upload required documents and certificates</li>
                            <li>Request facility visitation</li>
                            <li>Fire Levy certificate will be approved alongside the fire safety certificate after
                                inspection</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-6 text-green-600">Regional Offices</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="bg-gradient-to-br from-blue-100 to-green-100 p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                    <h4 class="font-medium text-blue-700 mb-2">Ikeja Zone</h4>
                    <p class="text-gray-700">Block B, Lagos State Secretariat, Alausa</p>
                    <p class="text-gray-700">Phone: (01) 234-5678</p>
                    <div class="mt-4">
                        <a href="https://www.google.com/maps/search/?api=1&query=Block+B,+Lagos+State+Secretariat,+Alausa"
                            target="_blank" class="text-blue-500 hover:text-blue-700 transition duration-300">
                            View on map
                        </a>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-green-100 to-yellow-100 p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                    <h4 class="font-medium text-green-700 mb-2">Lagos Island Zone</h4>
                    <p class="text-gray-700">12 Campbell Street, Lagos Island</p>
                    <p class="text-gray-700">Phone: (01) 987-6543</p>
                    <div class="mt-4">
                        <a href="https://www.google.com/maps/search/?api=1&query=12+Campbell+Street,+Lagos+Island"
                            target="_blank" class="text-green-500 hover:text-green-700 transition duration-300">
                            View on map
                        </a>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-yellow-100 to-red-100 p-4 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                    <h4 class="font-medium text-yellow-700 mb-2">Lekki Zone</h4>
                    <p class="text-gray-700">Block 5, Lekki Phase 1, Lekki</p>
                    <p class="text-gray-700">Phone: (01) 555-1212</p>
                    <div class="mt-4">
                        <a href="https://www.google.com/maps/search/?api=1&query=Block+5,+Lekki+Phase+1,+Lekki"
                            target="_blank" class="text-yellow-500 hover:text-yellow-700 transition duration-300">
                            View on map
                        </a>
                    </div>
                </div>

            </div>
        </section>
        <section class="mt-12 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-6 text-blue-600">Live Chat Support</h3>
            <div class="bg-gray-100 p-4 rounded-lg">
                <p class="text-gray-700 mb-4">Need immediate assistance? Our live chat support is available during office
                    hours.</p>
                <button id="liveChatButton"
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300 transform hover:scale-105"
                    aria-label="Start Live Chat" onclick="startLiveChat()">
                    Start Live Chat
                </button>
                <div id="chatStatus" class="mt-4 text-gray-600 hidden">
                    <p>Connecting to live support...</p>
                </div>
            </div>
        </section>

        <script>
            function startLiveChat() {
                // Display chat status message
                const chatStatus = document.getElementById('chatStatus');
                chatStatus.classList.remove('hidden');

                // Simulate connecting to live chat (replace with actual chat initialization)
                setTimeout(() => {
                    window.open('https://your-live-chat-url.com', '_blank');
                    chatStatus.classList.add('hidden');
                }, 2000); // Simulate a 2-second loading time
            }
        </script>


        <section class="mt-12">
            <h3 class="text-2xl font-semibold mb-6 text-green-600">Find Us on Social Media</h3>
            <div class="flex space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700 transition duration-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="text-blue-400 hover:text-blue-600 transition duration-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                <a href="#" class="text-pink-500 hover:text-pink-700 transition duration-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </section>
    </main>
    <style>
        .contact-section {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #38a169;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
            border-left: 4px solid #38a169;
            transition: background-color 0.2s;
        }

        .contact-item:hover {
            background-color: #f7fafc;
        }

        .contact-icon {
            height: 1.5rem;
            width: 1.5rem;
            color: #38a169;
            margin-right: 0.5rem;
        }

        .contact-title-sub {
            font-weight: 500;
            color: #4a5568;
        }

        .contact-text {
            color: #718096;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection
