<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Returns - Visitations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    <div class="space-y-4 max-w-2xl mx-auto p-4">
        <!-- Error Handling Section -->
        <div id="error-container" class="hidden bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <h3 class="text-red-800 font-medium">Error Loading Data</h3>
            </div>
            <p id="error-message" class="text-red-700"></p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Official Returns</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-2">Calendar - Visitations</h2>
        </header>

        <div class="flex justify-end mb-4">
            <label for="year" class="mr-2 self-center">Current Year</label>
            <span id="current-year"></span> <!-- Where the current year will be inserted -->
        </div>

        <script>
            // Set the current year dynamically
            document.getElementById('current-year').textContent = new Date().getFullYear();
        </script>


        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-gray-700">Branch Name</th>
                        <th class="px-4 py-2 text-left text-gray-700">Branch Email</th>
                        <th class="px-4 py-2 text-left text-gray-700">Visitation Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Select Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Admin Remark</th>
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
            // Simulated API response data (replace with actual API call)
            // Blade passes the visitations data to JavaScript
            const visitations = @json($visitations);

            // Function to get today's date in the format YYYY-MM-DD
            function getTodayDate() {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            // Function to populate the table with the fetched visitation data
            function populateVisitationsTable(visitations) {
                const tableBody = document.getElementById('visitations-body');
                tableBody.innerHTML = ''; // Clear existing rows

                visitations.forEach((visitation, index) => {
                    const row = document.createElement('tr');

                    // Add row cells dynamically
                    row.innerHTML = `
                <td class="px-4 py-2">${index + 1}</td>
                <td class="px-4 py-2">${visitation.lbranchname}</td>
                <td class="px-4 py-2">${visitation.lbizemail}</td>
                <td class="px-4 py-2">${visitation.lvisitationdate ? visitation.lvisitationdate : 'Not Scheduled'}</td>
                <td class="px-4 py-2">
                    <input type="date" class="w-full" value="${getTodayDate()}" data-branch-id="${visitation.lbranchid}" />
                </td>
                <td class="px-4 py-2">${visitation.ladminremark ? visitation.ladminremark : 'No remark'}</td>
                <td class="px-4 py-2">${visitation.lvisited === 'YES' ? 'Visited' : 'Not Visited'}</td>
                <td class="px-4 py-2">
    <button onclick="rescheduleVisitation(${visitation.lbranchid})"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        Re-schedule
    </button>
</td>

            `;
                    tableBody.appendChild(row);
                });
            }

            // Function to handle rescheduling visitation
            function rescheduleVisitation(branchId) {
                // Get the date input for this specific branch
                const dateInput = document.querySelector(`input[data-branch-id="${branchId}"]`);

                if (!dateInput || !dateInput.value) {
                    alert('Please select a date first');
                    return;
                }

                const selectedDate = new Date(dateInput.value);
                const today = new Date();
                const minAllowedDate = new Date(today);
                minAllowedDate.setDate(today.getDate() + 7);

                if (selectedDate < minAllowedDate) {
                    alert('Please select a date at least 7 days from today');
                    return;
                }

                // Format the date to DD/MM/YYYY
                const day = selectedDate.getDate().toString().padStart(2, '0');
                const month = (selectedDate.getMonth() + 1).toString().padStart(2, '0');
                const year = selectedDate.getFullYear();
                const formattedDate = `${day}/${month}/${year}`;

                // Create and submit the form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('business.schedule.visitation') }}";

                // CSRF Token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";
                form.appendChild(csrfInput);

                // Branch ID
                const branchInput = document.createElement('input');
                branchInput.type = 'hidden';
                branchInput.name = 'branchid';
                branchInput.value = branchId;
                form.appendChild(branchInput);

                // Schedule Date
                const scheduleDateInput = document.createElement('input');
                scheduleDateInput.type = 'hidden';
                scheduleDateInput.name = 'schedule_date';
                scheduleDateInput.value = formattedDate;
                form.appendChild(scheduleDateInput);

                document.body.appendChild(form);
                form.submit();
            }

            // Call the function to populate the table
            populateVisitationsTable(visitations);

            function rescheduleVisitation(branchId) {
                // Get the date input for this specific branch
                const dateInput = document.querySelector(`input[data-branch-id="${branchId}"]`);

                if (!dateInput || !dateInput.value) {
                    alert('Please select a date first');
                    return;
                }

                const selectedDate = new Date(dateInput.value);
                const today = new Date();
                const minAllowedDate = new Date(today);
                minAllowedDate.setDate(today.getDate() + 7);

                if (selectedDate < minAllowedDate) {
                    alert('Please select a date at least 7 days from today');
                    return;
                }

                // Format the date to DD/MM/YYYY
                const day = selectedDate.getDate().toString().padStart(2, '0');
                const month = (selectedDate.getMonth() + 1).toString().padStart(2, '0');
                const year = selectedDate.getFullYear();
                const formattedDate = `${day}/${month}/${year}`;

                // Create and submit the form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('business.schedule.visitation') }}";

                // CSRF Token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";
                form.appendChild(csrfInput);

                // Branch ID
                const branchInput = document.createElement('input');
                branchInput.type = 'hidden';
                branchInput.name = 'branchid';
                branchInput.value = branchId;
                form.appendChild(branchInput);

                // Schedule Date
                const scheduleDateInput = document.createElement('input');
                scheduleDateInput.type = 'hidden';
                scheduleDateInput.name = 'schedule_date';
                scheduleDateInput.value = formattedDate;
                form.appendChild(scheduleDateInput);

                document.body.appendChild(form);
                form.submit();
            }

            function updateDate(id, date) {
                // Find the corresponding visit in the apiResponse
                const visit = apiResponse.data.find(v => v.id === id);

                if (visit) {
                    const selectedDate = new Date(date);
                    const today = new Date(getTodayDate());

                    if (selectedDate < today) {
                        alert('Please select a future date');
                        return;
                    }

                    // Update the visitation date in the API response
                    visit.lvisitationdate = date;

                    // Refresh the table to show the updated date
                    document.getElementById('visitations-body').innerHTML = '';
                    populateTable();
                }
            }

            function populateTable() {
                const tableBody = document.getElementById('visitations-body');
                const today = getTodayDate();

                // Check if API call was successful
                if (apiResponse.status !== 'success') {
                    const errorContainer = document.getElementById('error-container');
                    const errorMessage = document.getElementById('error-message');
                    errorContainer.classList.remove('hidden');
                    errorMessage.textContent = apiResponse.message || 'Unknown error occurred';
                    return;
                }

                // Check if data array is empty
                if (apiResponse.data.length === 0) {
                    tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">No visitation records found</td>
                    </tr>
                `;
                    return;
                }

                // Populate table with API data
                apiResponse.data.forEach(visit => {
                    const row = `
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">${visit.id}</td>
                        <td class="px-4 py-2">${visit.lbranchname || 'N/A'}</td>
                        <td class="px-4 py-2">${visit.lbizemail || 'N/A'}</td>
                        <td class="px-4 py-2">${visit.lvisitationdate || 'Not Selected'}</td>
                        <td class="px-4 py-2">
                            <input 
                                type="date" 
                                class="border rounded px-2 py-1"
                                data-branch-id="${visit.lbranchid}"
                                value="${visit.lvisitationdate || ''}"
                                min="${today}"
                                onchange="updateDate(${visit.id}, this.value)"
                            >
                        </td>
                        <td class="px-4 py-2">${visit.ladminremark || 'No Remarks'}</td>
                        <td class="px-4 py-2">
                            <span class="${visit.lvisited === 'NO' ? 'text-orange-500' : 'text-green-500'} font-bold">
                                ${visit.lvisited || 'Unknown'}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <button 
                                onclick="rescheduleVisitation('${visit.lbranchid}')" 
                                class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-1 px-2 rounded">
                                re-schedule
                            </button>
                        </td>
                    </tr>
                `;
                    tableBody.innerHTML += row;
                });
            }

            // Call populate table on page load
            window.onload = populateTable;
        </script>
</body>

</html>
