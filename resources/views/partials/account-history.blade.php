<div class="bg-gray-100">
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
