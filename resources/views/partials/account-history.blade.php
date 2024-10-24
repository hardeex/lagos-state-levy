<div class="bg-gray-100">
    <div class="space-y-4 max-w-2xl mx-auto p-4">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Account History</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-2">UKE UNIVERSE</h2>
            <p class="text-gray-600">Business ID and address.</p>
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
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Particulars</th>
                        <th class="px-4 py-2 text-left text-gray-700">Reference</th>
                        <th class="px-4 py-2 text-left text-gray-700">Levy</th>
                        <th class="px-4 py-2 text-left text-gray-700">Payment</th>
                        <th class="px-4 py-2 text-left text-gray-700">Balance</th>
                    </tr>
                </thead>
                <tbody id="accountHistoryBody">
                    <!-- Table rows will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Static account history data
        const accountHistory = [{
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2017",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2018",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2019",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2020",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2021",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2022",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 04:58:56",
                particulars: "grgre annual levy for 2023",
                reference: "1729313936",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 05:25:35",
                particulars: "grgre annual levy for 2017",
                reference: "1729315535",
                levy: "",
                payment: "",
                balance: "0"
            },
            {
                date: "2024-10-19 05:25:35",
                particulars: "grgre annual levy for 2018",
                reference: "1729315535",
                levy: "",
                payment: "",
                balance: "0"
            }
        ];

        // Function to populate the table
        function populateTable() {
            const tableBody = document.getElementById('accountHistoryBody');
            accountHistory.forEach(entry => {
                const row = `
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">${entry.date}</td>
                        <td class="px-4 py-2">${entry.particulars}</td>
                        <td class="px-4 py-2">${entry.reference}</td>
                        <td class="px-4 py-2">${entry.levy}</td>
                        <td class="px-4 py-2">${entry.payment}</td>
                        <td class="px-4 py-2">${entry.balance}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Call the function when the page loads
        window.onload = populateTable;
    </script>
</div>
