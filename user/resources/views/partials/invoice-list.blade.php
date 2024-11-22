<div class="bg-gray-100">
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

    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bills/Invoices</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">UKE UNIVERSE</h2>

            <div class="text-lg text-gray-600">
                Current Balance: ₦{{ number_format($balance ?? 0, 2) }}
            </div>




        </header>

        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                Main Accounting Page
            </button>
            <button class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">
                Receipt List
            </button>
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                Display Range
            </button>
        </div>



        @if (count($invoices) > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Invoice Date</th>
                            <th class="px-4 py-2 text-left text-gray-700">Invoice #</th>
                            <th class="px-4 py-2 text-left text-gray-700">Due Date</th>
                            <th class="px-4 py-2 text-left text-gray-700">Total Amount</th>
                            <th class="px-4 py-2 text-left text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $invoice['created_at'] ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $invoice['linvoiceid'] ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $invoice['due_date'] ?? 'N/A' }}</td>
                                <td class="px-4 py-2">₦{{ number_format($invoice['lamount'] ?? 0, 2) }}</td>
                                <td class="px-4 py-2">
                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                        {{ $invoice['status'] ?? 'UNPAID' }}
                                    </span>
                                </td>
                                {{-- <td class="px-4 py-2">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">
                                        View
                                    </button>
                                </td> --}}
                                <td>
                                    <a href="{{ route('invoice.view', ['invoiceId' => $invoice['id']]) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg p-8 text-center">
                <i class="fas fa-file-invoice text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-600">No invoices found</p>
            </div>
        @endif

    </div>
