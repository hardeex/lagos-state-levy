<div>
    <div class="container mx-auto px-4 py-8">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($branches))
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                {{-- <h2>Business Email: {{ $branch['bizemail'] }}</h2> --}}
                <h2>Branches List</h2>
                <table class="w-full">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Location Type
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Branch Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Branch Address
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">LGA</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Contact Person
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Designation
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Contact Phone
                            </th>
                            {{-- <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Email
                            </th> --}}
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Staff Count
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($branches as $branch)
                            <tr class="hover:bg-blue-50 transition duration-200">
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['id'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs {{ $branch['locationtype'] == 'HEAD OFFICE' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} rounded-full">
                                        {{ $branch['locationtype'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['lbranchname'] }}</td>
                                <td class="px-4 py-3">{{ $branch['lbranchadd'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['llga'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['lcontactperson'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['ldesignation'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $branch['lcontactphone'] }}</td>
                                {{-- <td class="px-4 py-3 whitespace-nowrap">{{ $branch['bizemail'] }}</td> --}}
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="px-2 py-1 text-xs {{ $branch['lstaffcount'] > 0 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} rounded-full">
                                        {{ $branch['lstaffcount'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($branch['created_at'])->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-3 rounded relative" role="alert">
                No branches found.
            </div>
        @endif
    </div>
    </d>
