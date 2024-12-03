<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Profile Header --}}
        <div class="bg-blue-600 text-white p-6">
            <h1 class="text-3xl font-bold">{{ $profile['lbizname'] ?? 'Business Profile' }}</h1>
            <p class="text-blue-100">{{ $profile['lindustry'] ?? 'Industry Not Specified' }}</p>
        </div>

        {{-- Business Details Grid --}}
        <div class="grid md:grid-cols-2 gap-6 p-6">
            {{-- Left Column --}}
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Business Information</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-gray-600">Registration Number:</span>
                        <p class="font-medium">{{ $profile['lregno'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Tax ID:</span>
                        <p class="font-medium">{{ $profile['ltaxid'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Incorporation Year:</span>
                        <p class="font-medium">{{ $profile['lincorporation'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Business Status:</span>
                        <p class="font-medium text-green-600">{{ $profile['lstatus'] ?? 'UNKNOWN' }}</p>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Contact Details</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-gray-600">Phone:</span>
                        <p class="font-medium">{{ $profile['lphone'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Email:</span>
                        <p class="font-medium">{{ $profile['lemail'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600">Address:</span>
                        <p class="font-medium">
                            {{ $profile['ladd'] ?? 'N/A' }},
                            {{ $profile['llga'] ?? '' }} LGA,
                            {{ $profile['lstate'] ?? '' }},
                            {{ $profile['lcountry'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Business Sector Details --}}
        <div class="bg-gray-50 p-6 border-t">
            <h2 class="text-xl font-semibold mb-4">Sector Details</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <span class="text-gray-600">Industry:</span>
                    <p class="font-medium">{{ $profile['lindustry'] ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-gray-600">Sub-Sector:</span>
                    <p class="font-medium">{{ $profile['lsubsector'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{-- Verification Status --}}
        <div class="p-6 bg-white border-t">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <span class="text-gray-600">Email Verification:</span>
                    <p
                        class="font-medium {{ $profile['lemailverified'] == 'YES' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $profile['lemailverified'] ?? 'NOT VERIFIED' }}
                    </p>
                </div>
                <div>
                    <span class="text-gray-600">Phone Verification:</span>
                    <p
                        class="font-medium {{ $profile['lphoneverified'] == 'YES' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $profile['lphoneverified'] ?? 'NOT VERIFIED' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

```
