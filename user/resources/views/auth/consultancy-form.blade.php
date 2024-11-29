<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lagos State Fire Safety Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto py-12">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-3xl mx-auto">
            <div class="mb-8">
                <img src="https://via.placeholder.com/150x50" alt="Lagos State Government" class="mx-auto">
            </div>
            <h1 class="text-3xl font-bold mb-6 text-blue-600">Lagos State Fire and Rescue Service</h1>
            <h2 class="text-2xl font-bold mb-4">Fire Safety Assessment Form</h2>

            <form>
                <div class="mb-6">
                    <label for="company" class="block text-gray-700 font-bold mb-2">Name of Company/Occupier</label>
                    <input type="text" id="company"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter company name">
                </div>

                <div class="mb-6">
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address of Company</label>
                    <input type="text" id="address"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter company address">
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="staff" class="block text-gray-700 font-bold mb-2">No. of Staff</label>
                        <input type="number" id="staff"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter number of staff">
                    </div>
                    <div>
                        <label for="power-generator" class="block text-gray-700 font-bold mb-2">No. of Power Generating
                            Set</label>
                        <input type="number" id="power-generator"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter number of power generators">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="inspection" class="block text-gray-700 font-bold mb-2">Inspection</label>
                        <input type="number" id="inspection"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter inspection cost">
                    </div>
                    <div>
                        <label for="generator" class="block text-gray-700 font-bold mb-2">Generator</label>
                        <input type="number" id="generator"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter generator cost">
                    </div>
                    <div>
                        <label for="certification" class="block text-gray-700 font-bold mb-2">Certification</label>
                        <input type="number" id="certification"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter certification cost">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="total-amount" class="block text-gray-700 font-bold mb-2">Total Amount Charged</label>
                    <input type="number" id="total-amount"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter total amount charged">
                </div>

                <div class="mb-6">
                    <label for="payer-id" class="block text-gray-700 font-bold mb-2">Payer ID</label>
                    <input type="text" id="payer-id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter payer ID">
                </div>

                <div class="mb-6">
                    <p class="text-gray-700 text-sm">(Compliance must be strictly ensured within 14 days of issuance of
                        this report)</p>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="inspection-details" class="block text-gray-700 font-bold mb-2">Inspection</label>
                        <input type="text" id="inspection-details"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter inspection details">
                    </div>
                    <div>
                        <label for="designation" class="block text-gray-700 font-bold mb-2">Designation</label>
                        <input type="text" id="designation"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter designation">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="signature-date" class="block text-gray-700 font-bold mb-2">Signature/Date</label>
                        <input type="text" id="signature-date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter signature and date">
                    </div>
                    <div>
                        <label for="telephone-contact" class="block text-gray-700 font-bold mb-2">Telephone
                            Contact</label>
                        <input type="tel" id="telephone-contact"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter telephone contact">
                    </div>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Submit Form
                </button>
            </form>
        </div>
    </div>
</body>

</html>
