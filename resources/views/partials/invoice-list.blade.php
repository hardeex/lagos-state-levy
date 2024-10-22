<div class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bills/Invoices</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">UKE UNIVERSE</h2>
        </header>

        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                Main Accounting Page
            </button>
            <button class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">
                Receipt List
            </button>
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                Display Range
            </button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">Invoice Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Invoice #</th>
                        <th class="px-4 py-2 text-left text-gray-700">Due Date</th>
                        <th class="px-4 py-2 text-left text-gray-700">Total Amount</th>
                        <th class="px-4 py-2 text-left text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">2024-10-19 04:58:56</td>
                        <td class="px-4 py-2">1729313936607</td>
                        <td class="px-4 py-2">2024-10-19 04:58:56</td>
                        <td class="px-4 py-2">0</td>
                        <td class="px-4 py-2">
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">UNPAID</span>
                        </td>
                        <td class="px-4 py-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">
                                view
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">2024-10-19 05:25:35</td>
                        <td class="px-4 py-2">1729315535588</td>
                        <td class="px-4 py-2">2024-10-19 05:25:35</td>
                        <td class="px-4 py-2">0</td>
                        <td class="px-4 py-2">
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">UNPAID</span>
                        </td>
                        <td class="px-4 py-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">
                                view
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
