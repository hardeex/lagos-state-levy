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

</div>



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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Document Uploads</h1>
        </header>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h3 class="text-2xl font-bold mb-4">Document Upload Form</h3>
            <form action="{{ route('auth.upload-document') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden fields for bizemail and password -->
                <input type="hidden" name="bizemail" value="{{ session('business_email') }}">
                <input type="hidden" name="password" value="{{ session('business_password') }}">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="docid">
                        Document ID
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="docid" name="docid" type="text" placeholder="Enter Document ID (e.g., DOC-001)"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="documenttype">
                        Document Type
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="documenttype" name="documenttype" required>
                        <option value="">Select Document Type</option>
                        <option value="Financial">Financial</option>
                        <option value="Receipt">Technical</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="imgsource">
                        Image Source
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="imgsource" name="imgsource" type="text" placeholder="Enter Image Source">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="author">
                        Author Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="author" name="author" type="email" placeholder="Enter Author Email" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                        Comment
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="comment" name="comment" rows="3" placeholder="Enter any additional comments"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="docimage">
                        Document Image
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="docimage" name="docimage" type="file" accept="image/*" required>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Upload Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
