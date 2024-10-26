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
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Business Location Declarations</h1>
                <p class="mb-4 text-gray-600">Declare the various locations of your business using the form below. The list
                    of registered locations will be displayed above the form.</p>

                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700">Registered Business Locations</h2>
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">S/N</th>
                                    <th class="py-3 px-6 text-left">Branch Name</th>
                                    <th class="py-3 px-6 text-left">Address</th>
                                    <th class="py-3 px-6 text-left">LGA/LCDA</th>
                                    <th class="py-3 px-6 text-left">Contact Person</th>
                                    <th class="py-3 px-6 text-left">Phone</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="locationsList" class="text-gray-600 text-sm font-light">
                                <!-- Locations will be added here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow mb-8">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-700">Add Business Location</h2>
                    <form action="{{ route('auth.declaration-submit') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Designation of Contact Person</label>
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

        <!-- Edit Modal -->
        <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                            Edit Business Location
                        </h3>
                        <form id="editLocationForm" class="space-y-4">
                            <input type="hidden" id="editRowIndex">
                            <div>
                                <label for="editBranchName" class="block text-sm font-medium text-gray-700">Branch
                                    Name</label>
                                <input type="text" id="editBranchName"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="editBranchAddress"
                                    class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" id="editBranchAddress"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="editLgaLcda" class="block text-sm font-medium text-gray-700">LGA/LCDA</label>
                                <select id="editLgaLcda"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="ALIMOSHO">Alimosho</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div>
                                <label for="editContactPerson" class="block text-sm font-medium text-gray-700">Contact
                                    Person</label>
                                <input type="text" id="editContactPerson"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="editContactPhone"
                                    class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" id="editContactPhone"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" id="saveEditBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save Changes
                        </button>
                        <button type="button" id="closeModalBtn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
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


        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                let rowCount = 0;
                const locations = [];
                const form = document.getElementById('addLocationForm');
                const submitAllBtn = document.getElementById('submitAll');

                // Initialize CSRF token for all AJAX requests
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Validation rules matching backend
                function validateFormData(data) {
                    const errors = [];

                    // Required field validation
                    if (!data.branchName) errors.push('Branch name is required');
                    if (!data.branchAddress) errors.push('Branch address is required');
                    if (!data.lga) errors.push('LGA/LCDA is required');
                    if (!data.contactPerson) errors.push('Contact person is required');
                    if (!data.designation) errors.push('Designation is required');

                    // Phone validation - must start with + and have 10-15 digits
                    if (!data.contactPhone) {
                        errors.push('Contact phone is required');
                    } else if (!/^\+\d{10,15}$/.test(data.contactPhone)) {
                        errors.push('Phone number must start with + and have 10-15 digits');
                    }

                    // Email validation
                    if (!data.email) {
                        errors.push('Email is required');
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) {
                        errors.push('Please enter a valid email address');
                    }

                    // Password validation
                    if (!data.password) {
                        errors.push('Password is required');
                    } else if (data.password.length < 6) {
                        errors.push('Password must be at least 6 characters');
                    }

                    // Staff count validation
                    if (!data.staffcount || isNaN(data.staffcount)) {
                        errors.push('Staff count must be a valid number');
                    }

                    return errors;
                }

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = {
                        locationType: document.getElementById('locationType').value,
                        branchName: document.getElementById('branchName').value,
                        branchAddress: document.getElementById('branchAddress').value,
                        lga: document.getElementById('llga').value,
                        contactPerson: document.getElementById('contactPerson').value,
                        designation: document.getElementById('contactDesignation').value,
                        contactPhone: document.getElementById('contactPhone').value,
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                        staffcount: parseInt(document.getElementById('staffCount').value) || 0
                    };

                    // Validate form data
                    const errors = validateFormData(formData);
                    if (errors.length > 0) {
                        alert(errors.join('\n'));
                        return;
                    }

                    // Add to local array for table display
                    locations.push(formData);
                    createNewRow(formData, locations.length - 1);
                    form.reset();
                });

                function createNewRow(data, index) {
                    rowCount++;
                    const row = document.createElement('tr');
                    row.className = 'border-b border-gray-200 hover:bg-gray-100';
                    row.innerHTML = `
            <td class="py-3 px-6 text-left whitespace-nowrap">${rowCount}</td>
            <td class="py-3 px-6 text-left whitespace-nowrap">${data.branchName}</td>
            <td class="py-3 px-6 text-left">${data.branchAddress}</td>
            <td class="py-3 px-6 text-left">${data.lga}</td>
            <td class="py-3 px-6 text-left">${data.contactPerson}</td>
            <td class="py-3 px-6 text-left">${data.contactPhone}</td>
            <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                    <button class="edit-btn transform hover:text-blue-500 hover:scale-110" data-row-index="${index}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete-btn transform hover:text-red-500 hover:scale-110 ml-4">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        `;
                    document.getElementById('locationsList').appendChild(row);
                }

                // Submit all locations
                submitAllBtn.addEventListener('click', async function() {
                    if (locations.length === 0) {
                        alert('Please add at least one business location.');
                        return;
                    }

                    const submitButton = this;
                    submitButton.disabled = true;
                    submitButton.textContent = 'Submitting...';

                    const submitPromises = locations.map(location =>
                        fetch('/api/declaration', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify(location)
                        }).then(response => response.json())
                    );

                    try {
                        const results = await Promise.all(submitPromises);
                        const failures = results.filter(result => result.status === 'error');

                        if (failures.length > 0) {
                            alert(
                                `Failed to submit ${failures.length} locations. Please check the data and try again.`
                            );
                        } else {
                            alert('All locations submitted successfully!');
                            // Clear the table and locations array
                            document.getElementById('locationsList').innerHTML = '';
                            locations.length = 0;
                            rowCount = 0;
                        }
                    } catch (error) {
                        console.error('Error submitting locations:', error);
                        alert('An error occurred while submitting the locations. Please try again.');
                    } finally {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Submit All Branches';
                    }
                });

                // Handle delete and edit operations
                document.getElementById('locationsList').addEventListener('click', function(e) {
                    if (e.target.closest('.delete-btn')) {
                        const row = e.target.closest('tr');
                        const index = Array.from(row.parentNode.children).indexOf(row);
                        locations.splice(index, 1);
                        row.remove();
                        updateSerialNumbers();
                    } else if (e.target.closest('.edit-btn')) {
                        const rowIndex = e.target.closest('.edit-btn').dataset.rowIndex;
                        openEditModal(rowIndex);
                    }
                });

                function updateSerialNumbers() {
                    const rows = document.getElementById('locationsList').children;
                    for (let i = 0; i < rows.length; i++) {
                        rows[i].children[0].textContent = i + 1;
                        rows[i].querySelector('.edit-btn').dataset.rowIndex = i;
                    }
                    rowCount = rows.length;
                }

                // Edit modal functionality
                const editModal = document.getElementById('editModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const saveEditBtn = document.getElementById('saveEditBtn');

                function openEditModal(rowIndex) {
                    const location = locations[rowIndex];
                    document.getElementById('editRowIndex').value = rowIndex;
                    document.getElementById('editBranchName').value = location.branchName;
                    document.getElementById('editBranchAddress').value = location.branchAddress;
                    document.getElementById('editLgaLcda').value = location.lga;
                    document.getElementById('editContactPerson').value = location.contactPerson;
                    document.getElementById('editContactPhone').value = location.contactPhone;
                    editModal.classList.remove('hidden');
                }

                closeModalBtn.addEventListener('click', () => editModal.classList.add('hidden'));

                saveEditBtn.addEventListener('click', function() {
                    const rowIndex = parseInt(document.getElementById('editRowIndex').value);
                    const updatedLocation = {
                        ...locations[rowIndex],
                        branchName: document.getElementById('editBranchName').value,
                        branchAddress: document.getElementById('editBranchAddress').value,
                        lga: document.getElementById('editLgaLcda').value,
                        contactPerson: document.getElementById('editContactPerson').value,
                        contactPhone: document.getElementById('editContactPhone').value
                    };

                    // Validate updated data
                    const errors = validateFormData(updatedLocation);
                    if (errors.length > 0) {
                        alert(errors.join('\n'));
                        return;
                    }

                    locations[rowIndex] = updatedLocation;
                    const row = document.getElementById('locationsList').children[rowIndex];
                    row.children[1].textContent = updatedLocation.branchName;
                    row.children[2].textContent = updatedLocation.branchAddress;
                    row.children[3].textContent = updatedLocation.lga;
                    row.children[4].textContent = updatedLocation.contactPerson;
                    row.children[5].textContent = updatedLocation.contactPhone;

                    editModal.classList.add('hidden');
                });
            });
        </script> --}}

        {{-- <script>
            let rowCount = 0;

            document.getElementById('addLocationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                addNewLocation();
            });

            function addNewLocation(editIndex = null) {
                const branchName = document.getElementById('branchName').value;
                const branchAddress = document.getElementById('branchAddress').value;
                const lgaLcda = document.getElementById('lgaLcda').value;
                const contactPerson = document.getElementById('contactPerson').value;
                const contactPhone = document.getElementById('contactPhone').value;

                if (editIndex !== null) {
                    updateExistingRow(editIndex, branchName, branchAddress, lgaLcda, contactPerson, contactPhone);
                } else {
                    createNewRow(branchName, branchAddress, lgaLcda, contactPerson, contactPhone);
                }

                document.getElementById('addLocationForm').reset();
            }

            function createNewRow(branchName, branchAddress, lgaLcda, contactPerson, contactPhone) {
                rowCount++;
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-200 hover:bg-gray-100';
                row.innerHTML = `
            <td class="py-3 px-6 text-left whitespace-nowrap">${rowCount}</td>
            <td class="py-3 px-6 text-left whitespace-nowrap">${branchName}</td>
            <td class="py-3 px-6 text-left">${branchAddress}</td>
            <td class="py-3 px-6 text-left">${lgaLcda}</td>
            <td class="py-3 px-6 text-left">${contactPerson}</td>
            <td class="py-3 px-6 text-left">${contactPhone}</td>
            <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                    <button class="edit-btn transform hover:text-blue-500 hover:scale-110" data-row-index="${rowCount - 1}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete-btn transform hover:text-red-500 hover:scale-110 ml-4">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        `;

                document.getElementById('locationsList').appendChild(row);
            }

            function updateExistingRow(rowIndex, branchName, branchAddress, lgaLcda, contactPerson, contactPhone) {
                const row = document.getElementById('locationsList').children[rowIndex];
                row.children[1].textContent = branchName;
                row.children[2].textContent = branchAddress;
                row.children[3].textContent = lgaLcda;
                row.children[4].textContent = contactPerson;
                row.children[5].textContent = contactPhone;
            }

            document.getElementById('locationsList').addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    e.target.closest('tr').remove();
                    updateSerialNumbers();
                } else if (e.target.closest('.edit-btn')) {
                    const rowIndex = e.target.closest('.edit-btn').dataset.rowIndex;
                    openEditModal(rowIndex);
                }
            });

            function updateSerialNumbers() {
                const rows = document.getElementById('locationsList').children;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].children[0].textContent = i + 1;
                    rows[i].querySelector('.edit-btn').dataset.rowIndex = i;
                }
                rowCount = rows.length;
            }

            function openEditModal(rowIndex) {
                const row = document.getElementById('locationsList').children[rowIndex];
                document.getElementById('editRowIndex').value = rowIndex;
                document.getElementById('editBranchName').value = row.children[1].textContent;
                document.getElementById('editBranchAddress').value = row.children[2].textContent;
                document.getElementById('editLgaLcda').value = row.children[3].textContent;
                document.getElementById('editContactPerson').value = row.children[4].textContent;
                document.getElementById('editContactPhone').value = row.children[5].textContent;

                document.getElementById('editModal').classList.remove('hidden');
            }

            document.getElementById('closeModalBtn').addEventListener('click', function() {
                document.getElementById('editModal').classList.add('hidden');
            });

            document.getElementById('saveEditBtn').addEventListener('click', function() {
                const rowIndex = document.getElementById('editRowIndex').value;
                const branchName = document.getElementById('editBranchName').value;
                const branchAddress = document.getElementById('editBranchAddress').value;
                const lgaLcda = document.getElementById('editLgaLcda').value;
                const contactPerson = document.getElementById('editContactPerson').value;
                const contactPhone = document.getElementById('editContactPhone').value;

                updateExistingRow(rowIndex, branchName, branchAddress, lgaLcda, contactPerson, contactPhone);
                document.getElementById('editModal').classList.add('hidden');
            });

            document.getElementById('submitAll').addEventListener('click', function() {
                const locations = [];
                const rows = document.getElementById('locationsList').children;
                for (let row of rows) {
                    locations.push({
                        branchName: row.children[1].textContent,
                        address: row.children[2].textContent,
                        lgaLcda: row.children[3].textContent,
                        contactPerson: row.children[4].textContent,
                        contactPhone: row.children[5].textContent
                    });
                }
                console.log('Submitting locations:', locations);
                alert('All branches submitted successfully!');
            });
        </script> --}}
    </div>

@endsection
