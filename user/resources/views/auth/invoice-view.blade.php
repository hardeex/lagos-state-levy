@extends('base.base')
@section('title', 'Invoice Details')

@section('content')

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <!-- Header Section -->
            <header class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">Invoice Details</h1>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">
                    Invoice #{{ $invoice['linvoiceid'] ?? 'N/A' }}
                </h2>
            </header>

            <!-- Main Invoice Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Status Banner -->
                @if (isset($invoice['lpaystatus']))
                    <div
                        class="w-full {{ strtolower($invoice['lpaystatus']) === 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white px-6 py-3 text-center font-semibold">
                        {{ strtoupper($invoice['lpaystatus']) }}
                    </div>
                @endif

                <!-- Invoice Content -->
                <div class="p-6 sm:p-8">
                    <!-- Client and Payment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Invoice To</h3>
                            <p class="text-gray-600">{{ $invoice['linvoiceto'] ?? 'Not Specified' }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Pay To</h3>
                            <p class="text-gray-600">{{ $invoice['lpayto'] ?? 'Not Specified' }}</p>
                        </div>
                    </div>

                    <!-- Invoice Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Created Date</label>
                                <p class="mt-1 text-gray-800">
                                    @if (isset($invoice['created_at']))
                                        {{ \Carbon\Carbon::parse($invoice['created_at'])->format('M d, Y h:i A') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Amount</label>
                                <p class="mt-1 text-gray-800 text-xl font-semibold">
                                    @if (isset($invoice['lamount']))
                                        ₦{{ number_format($invoice['lamount'], 2) }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Payment Method</label>
                                <p class="mt-1 text-gray-800">
                                    {{ $invoice['lpaymentmethod'] ?? 'Not Specified' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Description</label>
                                <p class="mt-1 text-gray-800">
                                    {{ $invoice['ldescription'] ?? 'No description provided' }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Payment Reference</label>
                                <p class="mt-1 text-gray-800">
                                    {{ $invoice['lpayref'] ?? 'N/A' }}
                                </p>
                            </div>

                            @if (isset($invoice['lcomment']))
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Comment</label>
                                    <p class="mt-1 text-gray-800">{{ $invoice['lcomment'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Button Section -->
                    @if (strtolower($invoice['lpaystatus'] ?? '') !== 'paid')
                        <div class="mt-8 text-center">
                            <form action="{{ rouxte('auth.invoice-pay') }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                    Pay Now
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Error Message -->
            @if (session('error'))
                <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
