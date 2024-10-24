<div class="container mx-auto px-4 py-8">
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
    <h1 class="text-3xl font-bold text-center mb-6">Clearance And Certificate Applications</h1>
    <h2 class="text-2xl font-semibold text-center mb-4">UKE UNIVERSE</h2>
    <p class="text-center text-blue-500 mb-6">jamiuyusuf704@gmail.com</p>

    <div class="flex justify-center space-x-4 mb-8">
        <button class="bg-blue-400 text-white px-4 py-2 rounded">Document Uploads</button>
        <button class="bg-orange-300 text-white px-4 py-2 rounded">Invoice List</button>
        <button class="bg-orange-300 text-white px-4 py-2 rounded">Display Range</button>
    </div>

    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-4">Technincal Applications</h3>
        <p class="mb-4">Portal current year: 2023</p>

        <select class="w-full p-2 border rounded mb-4">
            <option>--select Agency--</option>
        </select>

        <button class="bg-green-500 text-white px-4 py-2 rounded w-full mb-4">Apply for Clearance</button>

        <textarea class="w-full p-2 border rounded mb-4" placeholder="your comment if any"></textarea>

        <button class="bg-green-500 text-white px-4 py-2 rounded w-full mb-4">Apply for Fire Certificate</button>

        <textarea class="w-full p-2 border rounded mb-4" placeholder="your comment if any"></textarea>
    </div>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">DATE</th>
                <th class="border p-2">YEAR</th>
                <th class="border p-2">AGENCY</th>
                <th class="border p-2">APPLICATION TYPE</th>
                <th class="border p-2">MY COMMENT</th>
                <th class="border p-2">ADMIN COMMENT</th>
                <th class="border p-2">STATUS</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows would be populated here dynamically -->
        </tbody>
    </table>
</div>
