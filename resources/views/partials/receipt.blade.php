
<div class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bills/Invoices</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-2">Business Name</h2>
            <p class="text-gray-600">Business ID and address.</p>
        </header>

        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                Main Accounting Page
            </button>
            <button class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                Invoice List
            </button>
            <button class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">
                Upload Receipt
            </button>
            <button class="bg-green-400 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                Display Range
            </button>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Receipt Upload</h3>
            <p class="text-gray-600 mb-6 text-center">
                You use this page to start the process of confirming the payment you have made to the bank account
            </p>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="invoice_no">
                        Invoice No:
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="invoice_no">
                        <option>--select invoice no--</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                        Amount:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" type="text" value="0.00" readonly>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="receipt_no">
                        Receipt No:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="receipt_no" type="text" placeholder="Enter receipt number">
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Upload Receipt
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
