@extends('base.base')
@section('title', 'Declaration')
@section('content')

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
            <div class="bg-white rounded-lg shadow-lg p-6">

                <!---- start of test display-->

                <div class="bg-gray-50 p-6 rounded-lg shadow mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-700">Registered Business Locations</h2>
                        <div class="flex space-x-4 items-center">
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Search locations..."
                                    class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <button onclick="refreshTable()" class="p-2 hover:bg-gray-100 rounded-full" title="Refresh">
                                <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 2v6h-6"></path>
                                    <path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path>
                                    <path d="M3 22v-6h6"></path>
                                    <path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            @foreach ($errors->all() as $error)
                                <span class="block sm:inline">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if (isset($branches) && count($branches) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Location Type
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Branch Name
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Address
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            LGA
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Contact Person
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Staff Count
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="tableBody">
                                    @foreach ($branches as $branch)
                                        <tr class="table-row">
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['ltype'] ?? ($branch['locationType'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['lbranchname'] ?? ($branch['branchName'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['lbranchaddress'] ?? ($branch['branchAddress'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['llga'] ?? ($branch['lga'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['lcontactperson'] ?? ($branch['contactPerson'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                {{ $branch['lstaffcount'] ?? ($branch['staffcount'] ?? 'N/A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="flex space-x-3">
                                                    <a href="#" class="text-blue-600 hover:text-blue-900"
                                                        title="View">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-yellow-600 hover:text-yellow-900"
                                                        title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    {{-- <form action="{{ route('auth.delete-branch') }}" method="POST"
                                                        class="inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                            title="Delete">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form> --}}

                                                    <form action="{{ route('auth.delete-branch') }}" method="POST"
                                                        class="inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="branch_id"
                                                            value="{{ $branch['id'] }}">
                                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                            title="Delete">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <select id="itemsPerPage" class="border rounded px-2 py-1">
                                    <option value="5">5 per page</option>
                                    <option value="10" selected>10 per page</option>
                                    <option value="25">25 per page</option>
                                    <option value="50">50 per page</option>
                                </select>
                                <span class="text-sm text-gray-600" id="pageInfo"></span>
                            </div>
                            <div class="flex space-x-2">
                                <button id="prevPage"
                                    class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">Previous</button>
                                <button id="nextPage"
                                    class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">Next</button>
                            </div>
                        </div>
                    @else
                        <div class="text-gray-500 text-center py-4">No business locations found.</div>
                    @endif
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let currentPage = 1;
                        let itemsPerPage = 10;
                        let filteredRows = [];
                        const allRows = Array.from(document.querySelectorAll('.table-row'));

                        // Initialize
                        function initializeTable() {
                            filteredRows = allRows;
                            updatePagination();
                            showCurrentPage();
                        }

                        // Search functionality
                        const searchInput = document.getElementById('searchInput');
                        searchInput.addEventListener('input', function(e) {
                            const searchTerm = e.target.value.toLowerCase();

                            filteredRows = allRows.filter(row => {
                                const text = row.textContent.toLowerCase();
                                return text.includes(searchTerm);
                            });

                            currentPage = 1;
                            updatePagination();
                            showCurrentPage();
                        });

                        // Pagination controls
                        document.getElementById('prevPage').addEventListener('click', () => {
                            if (currentPage > 1) {
                                currentPage--;
                                showCurrentPage();
                            }
                        });

                        document.getElementById('nextPage').addEventListener('click', () => {
                            const maxPage = Math.ceil(filteredRows.length / itemsPerPage);
                            if (currentPage < maxPage) {
                                currentPage++;
                                showCurrentPage();
                            }
                        });

                        // Items per page selector
                        document.getElementById('itemsPerPage').addEventListener('change', function(e) {
                            itemsPerPage = parseInt(e.target.value);
                            currentPage = 1;
                            showCurrentPage();
                        });

                        // Update pagination info and controls
                        function updatePagination() {
                            const totalItems = filteredRows.length;
                            const maxPage = Math.ceil(totalItems / itemsPerPage);

                            document.getElementById('prevPage').disabled = currentPage === 1;
                            document.getElementById('nextPage').disabled = currentPage === maxPage;

                            const startItem = (currentPage - 1) * itemsPerPage + 1;
                            const endItem = Math.min(currentPage * itemsPerPage, totalItems);

                            document.getElementById('pageInfo').textContent =
                                `Showing ${startItem}-${endItem} of ${totalItems} items`;
                        }

                        // Show current page of items
                        function showCurrentPage() {
                            // Hide all rows
                            allRows.forEach(row => row.style.display = 'none');

                            // Calculate start and end indices
                            const start = (currentPage - 1) * itemsPerPage;
                            const end = start + itemsPerPage;

                            // Show only rows for current page
                            filteredRows.slice(start, end).forEach(row => row.style.display = '');

                            updatePagination();
                        }

                        // Refresh function
                        window.refreshTable = function() {
                            window.location.reload();
                        }

                        // Initialize the table
                        initializeTable();
                    });
                </script>
                <!-- End of the test display-->
                <div class="bg-gray-50 p-6 rounded-lg shadow mb-8">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700">Add Business Location</h2>
                    <form action="{{ route('auth.declaration-submit') }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location Type</label>
                            <select name="locationType" id="locationType"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="HEAD OFFICE">Head Office</option>
                                <option value="BRANCH">Branch</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location/Branch Name</label>
                            <input type="text" name="branchName" id="branchName"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location/Branch Address</label>
                            <input type="text" name="branchAddress" id="branchAddress"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">LGA/LCDA</label>
                            <select name="lga" id="llga" required
                                class="peer w-full h-10 bg-gray-50 text-gray-800 border-b-2 border-gray-300 focus:outline-none focus:border-blue-600 transition-all">
                                <option value="">Select LGA/LCDA</option>
                                <!-- Options will be populated via JavaScript -->
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                            <input type="text" name="contactPerson" id="contactPerson"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Designation of Contact
                                Person</label>
                            <input type="text" name="designation" id="contactDesignation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Phone Number</label>
                            <input type="tel" name="contactPhone" id="contactPhone"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Staff Count</label>
                            <input type="number" name="staffcount" id="staffCount" min="0"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Add Business Location
                            </button>
                        </div>
                    </form>

                </div>

                <div class="text-center">
                    <button id="submitAll"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Submit All Branches
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const lgaSelect = document.getElementById('llga');

                function loadLGALCDA() {
                    lgaSelect.disabled = true; // Disable the dropdown while loading

                    fetch('/business/load-lga-lcda', {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Clear existing options except the first one
                            while (lgaSelect.options.length > 1) {
                                lgaSelect.remove(1);
                            }

                            // Populate options
                            if (data && Array.isArray(data)) {
                                data.forEach(item => {
                                    // Use llgalcda instead of name
                                    const option = new Option(item.llgalcda, item.id);
                                    lgaSelect.add(option);
                                });

                                // If there's an old value, select it
                                const oldValue = "{{ old('llga') }}";
                                if (oldValue) {
                                    lgaSelect.value = oldValue;
                                }
                            } else {
                                console.warn('Unexpected data format received:', data);
                                throw new Error('Invalid data format received');
                            }
                        })
                        .catch(error => {
                            console.error('Error loading LGA/LCDA:', error);
                            // Clear existing options except the first one
                            while (lgaSelect.options.length > 1) {
                                lgaSelect.remove(1);
                            }
                            // Add error option
                            const errorOption = new Option('Error loading LGA/LCDA', '');
                            lgaSelect.add(errorOption);
                        })
                        .finally(() => {
                            lgaSelect.disabled = false; // Re-enable the dropdown
                        });
                }

                // Load the LGA/LCDA data when the page loads
                loadLGALCDA();
            });
        </script>
    </div>

@endsection
