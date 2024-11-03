@extends('base.base')
@section('title', 'Consultant Registration Fees')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    CONSULTANT CARDE ANNUAL REGISTRATION FEES
                </h1>
            </div>

            {{-- Introduction --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <p class="text-gray-700 leading-relaxed mb-6">
                    Consultants/contractors are accredited professionals registered by the Lagos State Fire and Rescue
                    Services, who render services to businesses in Lagos on behalf of the agency.
                </p>

                {{-- Services List --}}
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Services to be rendered are as follows:</h2>
                    <ul class="list-none space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="font-medium mr-2">a)</span>
                            <span>Fire extinguisher marketing through the manufacturer representatives- all fire
                                extinguishers to be sold to firms must be registered</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-medium mr-2">b)</span>
                            <span>Fire extinguisher maintenance- fire extinguisher technicians</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-medium mr-2">c)</span>
                            <span>Fire hydrant maintenance- fire hydrant technicians</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-medium mr-2">d)</span>
                            <span>Fire alarm maintenance- fire alarm technicians</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-medium mr-2">e)</span>
                            <span>Fire safety training programs- fire safety training consultants</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-medium mr-2">f)</span>
                            <span>Inspectors</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Registration Section --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Registrations</h2>
                <p class="text-gray-700 leading-relaxed mb-6">
                    The above contractors will have to register on the platform with an agreed fee subject to renewal every
                    year before they can be considered as accredited contractors by the Agency. Other criteria shall be as
                    approved by the Service.
                </p>

                <div class="space-y-4 text-gray-700">
                    <p>They shall be issued a <span class="font-semibold">CERTIFICATE OF COMPETENCY</span>, valid for one
                        year.</p>
                    <p>A <span class="font-semibold">JOB COMPLETION CERTIFICATE</span> will be awarded to Firms once the
                        service is rendered.</p>
                </div>
            </div>

            {{-- Fees Table --}}
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">CONSULTANT</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">SPECIALIZATION</th>
                                <th class="px-6 py-3 text-right text-sm font-semibold text-gray-900">YEARLY FEE (₦)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">Manufacturer Rep</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Fire Extinguishers</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">100,000.00</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">Products</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Fire Extinguishers</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">25,000.00/spec</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">Consultant Marketers/Maintenance/Inspection</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Fire Extinguishers</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">100,000.00</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">Consultant Marketers/Maintenance/Inspection</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Fire Hydrants</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">50,000.00</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">Consultant Marketers/Maintenance/Inspection</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Fire Alarms</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">50,000.00</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">Consultant – Training</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Trainers/Facilitators</td>
                                <td class="px-6 py-4 text-right text-sm text-gray-700">100,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
