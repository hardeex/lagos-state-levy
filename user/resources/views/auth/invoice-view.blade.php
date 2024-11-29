<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice['linvoiceid'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .container {
                max-width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .print:hidden {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50 print:bg-white">
    <div class="min-h-screen container mx-auto px-4 py-4 max-w-4xl">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden print:shadow-none">
            {{-- Header with Gradient --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-6 px-6 text-center relative">
                <div class="absolute left-6 top-1/2 transform -translate-y-1/2 hidden md:block">
                    <img src="/path/to/company-logo.png" alt="Lagos FSFL Logo" class="w-24 h-24 object-contain">
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">Invoice {{ $invoice['linvoiceid'] ?? 'N/A' }}</h1>
                    <p class="text-xl">Lagos Fire Safety and Levy Clearance</p>
                </div>
                <div id="qrcode" class="absolute right-6 top-1/2 transform -translate-y-1/2 hidden md:block"></div>
            </div>

            {{-- Invoice Details --}}
            <div class="p-6 sm:p-8">
                {{-- Client and Invoice Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Invoice To</h3>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-gray-600 font-medium">{{ $invoice['linvoiceto'] }}</p>
                        </div>
                    </div>
                    <div class="md:text-right">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Invoice Details</h3>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-gray-800">
                                <span class="font-semibold">Invoice Number:</span>
                                <span class="font-bold">{{ $invoice['linvoiceid'] }}</span>
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Created: </span>
                                {{ \Carbon\Carbon::parse($invoice['created_at'])->format('F d, Y H:i A') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Financial Summary --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 border-t pt-6">
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500">Payment Method</label>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-blue-800 font-semibold">{{ $invoice['lpaymentmethod'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="md:text-right">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span
                                class="
                                inline-block px-4 py-2 rounded-full text-sm font-bold 
                                {{ strtolower($invoice['lpaystatus']) === 'unpaid' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}
                            ">
                                {{ $invoice['lpaystatus'] }}
                            </span>
                            <div class="mt-3 bg-gray-100 p-3 rounded-lg">
                                <p class="text-2xl font-bold text-gray-900">
                                    ₦{{ number_format(abs($invoice['lamount']), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Description Section --}}
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Description & Comments</h3>
                    <p class="text-gray-700 mb-2">{{ $invoice['ldescription'] }}</p>

                    @if (!empty($invoice['lcomment']))
                        <div class="mt-2 bg-white p-3 rounded-lg shadow-sm">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Additional Comments</label>
                            <p class="text-gray-700 italic">{{ $invoice['lcomment'] }}</p>
                        </div>
                    @endif
                </div>

                {{-- Payment Gateways --}}
                {{-- <div class="bg-gray-100 p-6 rounded-lg mb-6 print:hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Select Payment Gateway</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="gateway-btn" data-gateway="paystack">
                            <img src="/paystack-logo.png" alt="Paystack" class="w-16 h-16 mx-auto mb-2">
                            <span>Paystack</span>
                        </button>
                        <button class="gateway-btn" data-gateway="stripe">
                            <img src="/stripe-logo.png" alt="Stripe" class="w-16 h-16 mx-auto mb-2">
                            <span>Stripe</span>
                        </button>
                        <button class="gateway-btn" data-gateway="flutterwave">
                            <img src="/flutterwave-logo.png" alt="Flutterwave" class="w-16 h-16 mx-auto mb-2">
                            <span>Flutterwave</span>
                        </button>
                        <button class="gateway-btn" data-gateway="bank-transfer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                            <span>Bank Transfer</span>
                        </button>
                    </div>
                </div> --}}

                <div class="bg-gray-100 p-6 rounded-lg mb-6 print:hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Select Payment Gateway</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="gateway-btn" data-gateway="paystack">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2 text-blue-600"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14.5 10c-.83 0-1.5.67-1.5 1.5v1c0 .83.67 1.5 1.5 1.5h1c.28 0 .5.22.5.5v1c0 .28-.22.5-.5.5h-2c-.28 0-.5-.22-.5-.5M10 12.5v-1c0-.83-.67-1.5-1.5-1.5h-1c-.28 0-.5.22-.5.5v3c0 .28.22.5.5.5h2c.83 0 1.5-.67 1.5-1.5m4.5-1.5c-.83 0-1.5.67-1.5 1.5v3c0 .28.22.5.5.5h1c.28 0 .5-.22.5-.5v-3c0-.28-.22-.5-.5-.5zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                            </svg>
                            <span>Paystack</span>
                        </button>
                        <button class="gateway-btn" data-gateway="stripe">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2 text-indigo-500"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14 10h3c1.105 0 2-.895 2-2V6c0-1.105-.895-2-2-2h-3v6zm-4 0V4H7c-1.105 0-2 .895-2 2v2c0 1.105.895 2 2 2h3zm4 4h3c1.105 0 2 .895 2 2v2c0 1.105-.895 2-2 2h-3v-6zm-4 0v6H7c-1.105 0-2-.895-2-2v-2c0-1.105.895-2 2-2h3z" />
                            </svg>
                            <span>Stripe</span>
                        </button>
                        <button class="gateway-btn" data-gateway="flutterwave">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2 text-green-600"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span>Flutterwave</span>
                        </button>
                        <button class="gateway-btn" data-gateway="bank-transfer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-2 text-gray-700"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                            <span>Bank Transfer</span>
                        </button>
                    </div>
                </div>

                <style>
                    .gateway-btn {
                        @apply flex flex-col items-center justify-center p-4 rounded-lg bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300;
                    }

                    .gateway-btn:hover {
                        @apply shadow-lg;
                    }

                    .gateway-btn.selected {
                        @apply bg-blue-100 border-2 border-blue-500;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const gatewayButtons = document.querySelectorAll('.gateway-btn');

                        gatewayButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                // Remove selected state from all buttons
                                gatewayButtons.forEach(btn => btn.classList.remove('selected'));

                                // Add selected state to clicked button
                                button.classList.add('selected');

                                // Get the selected gateway
                                const selectedGateway = button.getAttribute('data-gateway');

                                // You can add your custom logic here to handle the gateway selection
                                console.log('Selected Gateway:', selectedGateway);
                            });
                        });
                    });
                </script>

                {{-- Action Buttons --}}
                <div class="flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4 print:hidden">
                    <button onclick="window.print()"
                        class="w-full md:w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Print Invoice</span>
                    </button>
                    <button id="proceedToPayment"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Proceed to Payment</span>
                    </button>
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-gray-100 p-4 text-center text-sm text-gray-600 print:hidden">
                © 2024 Lagos Fire Safety and Levy Clearance. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        // Generate QR Code
        document.addEventListener('DOMContentLoaded', function() {
            var qrcode = qrcode(0, 'M');
            qrcode.addData('{{ $invoice['linvoiceid'] }}');
            qrcode.make();
            document.getElementById('qrcode').innerHTML = qrcode.createImgTag(5);
        });

        // Payment Gateway Selection
        document.querySelectorAll('.gateway-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.gateway-btn').forEach(btn => btn.classList.remove('border-4',
                    'border-blue-500'));
                this.classList.add('border-4', 'border-blue-500');
                const selectedGateway = this.getAttribute('data-gateway');
                document.getElementById('proceedToPayment').textContent =
                    `Pay via ${selectedGateway.charAt(0).toUpperCase() + selectedGateway.slice(1)}`;
            });
        });

        document.getElementById('proceedToPayment').addEventListener('click', function() {
            const selectedGateway = document.querySelector('.gateway-btn.border-4');
            if (selectedGateway) {
                // Directly use the invoice ID from the page context
                const invoiceId = "{{ $invoice['linvoiceid'] }}"; // Laravel Blade syntax

                if (!invoiceId) {
                    alert('Invoice ID is missing');
                    return;
                }

                // Send the payment request to the server
                fetch('/invoice/pay', { // Use relative URL instead of named route
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            invoiceid: invoiceId
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response Data:', data);

                        if (data.success) {
                            alert(data.message || 'Payment processed successfully!');
                            window.location.href = '/invoice/list';
                        } else {
                            alert(data.message || 'Payment failed.');
                        }
                    })
                    .catch(error => {
                        console.error('Error processing payment:', error);
                        alert('An error occurred while processing the payment. Please try again later.');
                    });
            } else {
                alert('Please select a payment gateway');
            }
        });
    </script>
</body>

</html>
