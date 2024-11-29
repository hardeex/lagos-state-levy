<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements After Payment</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-4">
                <h1 class="text-2xl font-bold text-center">Requirements After Payment</h1>
            </div>

            <div class="p-6 space-y-6">
                <section>
                    <h2 class="text-xl font-semibold text-blue-700 mb-4">Request for Visitation</h2>
                    <p class="text-gray-600 mb-4">
                        Before proceeding with fire levy clearance and fire safety certificate, the following
                        requirements must be uploaded on the portal.
                    </p>
                </section>

                <section>
                    <h3 class="text-lg font-semibold text-blue-600 mb-3">Required Documents</h3>
                    <ol class="space-y-4 bg-gray-50 p-4 rounded-lg">
                        <li class="border-b pb-4 last:border-b-0">
                            <div class="flex items-start space-x-3">
                                <span
                                    class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold">1</span>
                                <div>
                                    <h4 class="font-medium text-gray-800">Fire Extinguisher Job Completion Certificate
                                    </h4>
                                    <p class="text-gray-600 text-sm">
                                        Certificate issued on the brand of fire extinguishers located in your facility
                                        by an accredited contractor.
                                        Must be a brand that has passed the hydrostatic test by Lagos State Fire and
                                        Rescue Service.
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li class="border-b pb-4 last:border-b-0">
                            <div class="flex items-start space-x-3">
                                <span
                                    class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold">2</span>
                                <div>
                                    <h4 class="font-medium text-gray-800">Fire Extinguisher Maintenance Certificate</h4>
                                    <p class="text-gray-600 text-sm">
                                        Job completion certificate issued by an accredited consultant recognized by
                                        Lagos State Fire and Rescue Service.
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li class="border-b pb-4 last:border-b-0">
                            <div class="flex items-start space-x-3">
                                <span
                                    class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold">3</span>
                                <div>
                                    <h4 class="font-medium text-gray-800">Fire Hydrant Maintenance Certificate</h4>
                                    <p class="text-gray-600 text-sm">
                                        Job completion certificate for yearly maintenance of fire hydrants, issued by an
                                        accredited consultant.
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-start space-x-3">
                                <span
                                    class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold">4</span>
                                <div>
                                    <h4 class="font-medium text-gray-800">Fire Warden Certificate</h4>
                                    <p class="text-gray-600 text-sm">
                                        Valid fire warden certificate issued by an accredited consultant.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ol>
                </section>

                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                    <p class="text-yellow-700 text-sm">
                        <strong>Note:</strong> All documents will be inspected by authorized inspectors during the
                        visitation after uploading.
                    </p>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('auth.upload-receipt') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        Begin Document Upload
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-200 text-gray-600 py-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Lagos State Fire and Rescue Service. All Rights Reserved.</p>
    </footer>
</body>

</html>
