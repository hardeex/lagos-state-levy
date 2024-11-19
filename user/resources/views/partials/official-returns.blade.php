<div class="bg-gray-100 font-sans">

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
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-2">Official Returns</h1>
        <h2 class="text-2xl font-semibold text-center text-gray-600 mb-6">UKE UNIVERSE</h2>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8 mx-auto flex flex-col items-center">
            <p class="text-sm text-gray-600 mb-4 text-center">Business ID and address:</p>

            <div class="flex flex-wrap gap-4 mb-6 justify-center">
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                    Main Accounting Page
                </button>
                <button
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                    Current Bill
                </button>
                <button
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                    Display Range
                </button>
            </div>

            <div class="flex items-center mb-6 justify-center">
                <label for="year" class="mr-4 font-semibold text-gray-700">Year to Display:</label>
                <select id="year" class="form-select w-48 p-2 border rounded shadow-sm">
                    <option value="">--select year--</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>

            <div class="bg-blue-100 text-blue-800 font-semibold py-2 px-4 rounded-lg inline-block mb-6 text-center">
                Year in focus: 2023
            </div>
        </div>


        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Branch Name</th>
                        <th class="py-3 px-4 text-left">Contact Person</th>
                        <th class="py-3 px-4 text-left">Address</th>
                        <th class="py-3 px-4 text-right">Charges</th>
                        <th class="py-3 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4">grgre</td>
                        <td class="py-3 px-4">Yusuf Jemilu</td>
                        <td class="py-3 px-4">efewe ,EJIGBO</td>
                        <td class="py-3 px-4 text-right">₦0</td>
                        <td class="py-3 px-4 text-center">
                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded transition duration-300">
                                Pay
                            </button>
                        </td>
                    </tr>
                    <!-- More table rows here... -->
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <p class="text-xl font-semibold text-gray-800">Total: ₦0</p>
            <button
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded transition duration-300">
                Pay All
            </button>
        </div>
    </div>
</div>
