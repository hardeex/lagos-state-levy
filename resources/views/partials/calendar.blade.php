<div class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Official Returns</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-2">Calendar - Visitations</h2>
            <p class="text-gray-600">Business ID and address.</p>
        </header>

        <div class="flex justify-end mb-4">
            <label for="year" class="mr-2 self-center">Year to Display:</label>
            <select id="year" class="border rounded px-2 py-1">
                <option>2023</option>
                <option>2022</option>
                <option>2021</option>
            </select>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-gray-700">Branch Name</th>
                        <th class="px-4 py-2 text-left text-gray-700">Visitation Code</th>
                        <th class="px-4 py-2 text-left text-gray-700">Visitation Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Admin Comment</th>
                        <th class="px-4 py-2 text-left text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody id="visitations-body">
                    <!-- Table rows will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const visitations = [{
                id: 1,
                branchName: "Yoga Campus",
                visitationCode: 8,
                visitationDate: "",
                adminComment: "",
                status: "NO"
            },
            {
                id: 2,
                branchName: "Alausa Campus",
                visitationCode: 9,
                visitationDate: "",
                adminComment: "",
                status: "NO"
            },
            {
                id: 3,
                branchName: "Agbado Ijaye",
                visitationCode: 10,
                visitationDate: "",
                adminComment: "",
                status: "NO"
            },
            {
                id: 4,
                branchName: "Ojokoro",
                visitationCode: 11,
                visitationDate: "",
                adminComment: "",
                status: "NO"
            },
            {
                id: 5,
                branchName: "Agege",
                visitationCode: 12,
                visitationDate: "",
                adminComment: "",
                status: "NO"
            }
        ];

        function populateTable() {
            const tableBody = document.getElementById('visitations-body');
            visitations.forEach(visit => {
                const row = `
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">${visit.id}</td>
                        <td class="px-4 py-2">${visit.branchName}</td>
                        <td class="px-4 py-2">${visit.visitationCode}</td>
                        <td class="px-4 py-2">${visit.visitationDate}</td>
                        <td class="px-4 py-2">${visit.adminComment}</td>
                        <td class="px-4 py-2"><span class="text-orange-500 font-bold">${visit.status}</span></td>
                        <td class="px-4 py-2">
                            <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-2 rounded mr-1">details</button>
                            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-1 px-2 rounded">re-schedule</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        window.onload = populateTable;
    </script>
</div>
