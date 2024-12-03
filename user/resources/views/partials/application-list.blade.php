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


<div class="container mx-auto my-8">
    <!-- Search Bar -->
    <div class="mb-4 flex justify-between items-center">
        <input type="text" id="search" placeholder="Search..." class="p-2 border rounded w-1/3"
            oninput="filterTable()">
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="applicationTable" class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Year</th>
                    <th class="border px-4 py-2">Agency</th>
                    <th class="border px-4 py-2">Apply Type</th>
                    <th class="border px-4 py-2">Comment</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $application['id'] }}</td>
                        <td class="border px-4 py-2">{{ $application['lbizemail'] }}</td>
                        <td class="border px-4 py-2">{{ $application['lyear'] }}</td>
                        <td class="border px-4 py-2">{{ $application['lagency'] }}</td>
                        <td class="border px-4 py-2">{{ $application['applytype'] }}</td>
                        <td class="border px-4 py-2">{{ $application['bcomment'] ?? 'No comment' }}</td>
                        <td class="border px-4 py-2">{{ $application['applystatus'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center">
        <button class="p-2 border rounded bg-gray-200 hover:bg-gray-300" id="prevPage"
            onclick="navigatePage('prev')">Prev</button>
        <span id="pageNumber" class="text-lg font-semibold">Page 1</span>
        <button class="p-2 border rounded bg-gray-200 hover:bg-gray-300" id="nextPage"
            onclick="navigatePage('next')">Next</button>
    </div>
</div>

<script>
    let currentPage = 1;
    const rowsPerPage = 5;
    let applications = @json($applications);

    function filterTable() {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const filteredApplications = applications.filter(application => {
            return application.lbizemail.toLowerCase().includes(searchTerm) ||
                application.lagency.toLowerCase().includes(searchTerm) ||
                application.applytype.toLowerCase().includes(searchTerm) ||
                (application.bcomment && application.bcomment.toLowerCase().includes(searchTerm));
        });
        renderTable(filteredApplications);
    }

    function renderTable(data) {
        const tableBody = document.getElementById('applicationTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = Math.min(startIndex + rowsPerPage, data.length);
        const currentPageData = data.slice(startIndex, endIndex);

        currentPageData.forEach(application => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-50');

            row.innerHTML = `
                <td class="border px-4 py-2">${application.id}</td>
                <td class="border px-4 py-2">${application.lbizemail}</td>
                <td class="border px-4 py-2">${application.lyear}</td>
                <td class="border px-4 py-2">${application.lagency}</td>
                <td class="border px-4 py-2">${application.applytype}</td>
                <td class="border px-4 py-2">${application.bcomment || 'No comment'}</td>
                <td class="border px-4 py-2">${application.applystatus}</td>
            `;
            tableBody.appendChild(row);
        });

        document.getElementById('pageNumber').innerText = `Page ${currentPage}`;
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage * rowsPerPage >= data.length;
    }

    function navigatePage(direction) {
        const searchTerm = document.getElementById('search').value.toLowerCase();
        const filteredApplications = applications.filter(application => {
            return application.lbizemail.toLowerCase().includes(searchTerm) ||
                application.lagency.toLowerCase().includes(searchTerm) ||
                application.applytype.toLowerCase().includes(searchTerm) ||
                (application.bcomment && application.bcomment.toLowerCase().includes(searchTerm));
        });

        if (direction === 'next' && currentPage * rowsPerPage < filteredApplications.length) {
            currentPage++;
        } else if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        }

        renderTable(filteredApplications);
    }

    renderTable(applications);
</script>
