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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Official Returns</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-2">Calendar - Visitations</h2>
            <p class="text-gray-600">Business ID and address.</p>
        </header>

        <div class="flex justify-end mb-4">
            <label for="year" class="mr-2 self-center">Current Year</label> 2024
            {{-- <select id="year" class="border rounded px-2 py-1">
                <option>2023</option>
                <option>2022</option>
                <option>2021</option>
            </select> --}}
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-gray-700">Branch Name</th>
                        <th class="px-4 py-2 text-left text-gray-700">Visitation Code</th>
                        <th class="px-4 py-2 text-left text-gray-700">Visitation Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Select Date</th>
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

            function getTodayDate() {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function updateDate(id, date) {
                const visit = visitations.find(v => v.id === id);
                if (visit) {
                    // Check if selected date is not before today
                    const selectedDate = new Date(date);
                    const today = new Date(getTodayDate());

                    if (selectedDate < today) {
                        alert('Please select a future date');
                        return;
                    }

                    visit.visitationDate = date;
                    // Refresh the table to show the updated date
                    document.getElementById('visitations-body').innerHTML = '';
                    populateTable();
                }
            }

            function populateTable() {
                const tableBody = document.getElementById('visitations-body');
                const today = getTodayDate();

                visitations.forEach(visit => {
                    const row = `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">${visit.id}</td>
                            <td class="px-4 py-2">${visit.branchName}</td>
                            <td class="px-4 py-2">${visit.visitationCode}</td>
                            <td class="px-4 py-2">${visit.visitationDate}</td>
                            <td class="px-4 py-2">
                                <input 
                                    type="date" 
                                    class="border rounded px-2 py-1"
                                    value="${visit.visitationDate}"
                                    min="${today}"
                                    onchange="updateDate(${visit.id}, this.value)"
                                >
                            </td>
                            <td class="px-4 py-2">${visit.adminComment}</td>
                            <td class="px-4 py-2"><span class="text-orange-500 font-bold">${visit.status}</span></td>
                            <td class="px-4 py-2">
                              
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
