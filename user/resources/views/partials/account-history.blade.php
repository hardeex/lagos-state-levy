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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Account History</h1>
            {{-- <h2 class="text-3xl font-semibold text-gray-700 mb-2">UKE UNIVERSE</h2>
            <p class="text-gray-600">Business ID and address.</p> --}}
        </header>

        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                Main Accounting Page
            </button>
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                Current Bill
            </button>
            <button class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">
                Display Range
            </button>
        </div>



        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Search Form -->
            <div class="flex justify-between items-center mt-4">
                <div class="flex items-center space-x-2">
                    <input type="text" id="searchInput" class="px-2 py-1 border rounded" placeholder="Search..."
                        onkeyup="filterTable()">
                </div>
            </div>

            <!-- Table -->
            <table class="w-full mt-4">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">S/N</th>
                        <th class="px-4 py-2 text-left text-gray-700">Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Particulars</th>
                        <th class="px-4 py-2 text-left text-gray-700">Reference</th>
                        <th class="px-4 py-2 text-left text-gray-700">Levy</th>
                        <th class="px-4 py-2 text-left text-gray-700">Payment</th>
                        <th class="px-4 py-2 text-left text-gray-700">Balance</th>
                        <th class="px-4 py-2 text-left text-gray-700">Data</th>
                    </tr>
                </thead>
                <tbody id="accountHistoryBody">
                    <!-- Table rows will be inserted here dynamically -->
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="flex justify-between items-center mt-4">
                <div class="flex items-center space-x-2">
                    <span>Page</span>
                    <select id="pageSelect" class="px-2 py-1 border rounded">
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>
            </div>
        </div>

        <script>
            // Pass the dynamic account history data from Blade
            const accountHistory = @json($accountHistory); // Convert PHP data to JSON and inject it

            let currentPage = 1;
            const rowsPerPage = 15;

            // Function to format the date in a human-readable format
            function formatDate(dateString) {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return new Date(dateString).toLocaleDateString(undefined, options);
            }

            // Function to paginate the data and update the table
            function paginateData() {
                const tableBody = document.getElementById('accountHistoryBody');
                tableBody.innerHTML = ''; // Clear the table

                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = startIndex + rowsPerPage;
                const paginatedData = accountHistory.slice(startIndex, endIndex);

                // Loop through the paginated data and add rows to the table
                paginatedData.forEach((entry, index) => {
                    const row = `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">${startIndex + index + 1}</td> <!-- S/N -->
                            <td class="px-4 py-2">${formatDate(entry.created_at)}</td> <!-- Date -->
                            <td class="px-4 py-2">${entry.lparticulars}</td> <!-- Particulars -->
                            <td class="px-4 py-2">${entry.lref}</td> <!-- Reference -->
                            <td class="px-4 py-2">${entry.ldr}</td> <!-- Levy -->
                            <td class="px-4 py-2">${entry.lcr || '0'}</td> <!-- Payment -->
                            <td class="px-4 py-2">${entry.ldr - (entry.lcr || 0)}</td> <!-- Balance -->
                            <td class="px-4 py-2">${entry.lcomment || 'N/A'}</td> <!-- Data (comment as placeholder for Data) -->
                        </tr>
                    `;
                    tableBody.innerHTML += row; // Append the row to the table body
                });

                // Update pagination controls
                updatePaginationControls();
            }

            // Function to update pagination controls
            function updatePaginationControls() {
                const totalPages = Math.ceil(accountHistory.length / rowsPerPage);
                const pageSelect = document.getElementById('pageSelect');
                pageSelect.innerHTML = ''; // Clear previous options

                // Add options for each page number
                for (let i = 1; i <= totalPages; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = `Page ${i}`;
                    pageSelect.appendChild(option);
                }

                // Set the currently selected page
                pageSelect.value = currentPage;
            }

            // Function to handle page change
            document.getElementById('pageSelect').addEventListener('change', (event) => {
                currentPage = parseInt(event.target.value);
                paginateData();
            });

            // Function to filter the table based on search input
            function filterTable() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const filteredData = accountHistory.filter(entry => {
                    return entry.lparticulars.toLowerCase().includes(searchTerm) ||
                        entry.lref.toLowerCase().includes(searchTerm) ||
                        entry.created_at.toLowerCase().includes(searchTerm) ||
                        entry.lcomment.toLowerCase().includes(searchTerm);
                });

                // Update the table with filtered data
                accountHistory.length = 0; // Clear the existing data
                accountHistory.push(...filteredData); // Push filtered data to the array
                currentPage = 1; // Reset to page 1 when searching
                paginateData();
            }

            // Initial call to paginate and display data
            window.onload = paginateData;
        </script>

    </div>
