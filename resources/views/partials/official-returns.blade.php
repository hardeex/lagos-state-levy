<div class="bg-gray-100 font-sans">
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
