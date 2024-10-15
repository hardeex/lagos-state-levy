@extends('base.base')
@section('title', 'Training-LAgosFSLC')

@section('content')

    <div class="bg-gray-100 font-sans">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold text-center mb-8 text-red-600">Fire Safety Training Programs</h1>

            <!-- Fire Warden Course -->
            <section class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-3xl font-semibold mb-4 text-red-500">COURSE: FIRE WARDEN (FW 103)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Course Description</h3>
                        <p class="mb-4">Fire warden is a person who has authority to direct in the extinguishing of fires
                            or order what precautions shall be taken against fires; also called fire marshal or a person who
                            ensures that a building is safely occupied and evacuated successfully during fire emergencies.
                        </p>
                        <h3 class="text-xl font-semibold mb-2">Course Objectives</h3>
                        <ul class="list-disc pl-5 mb-4">
                            <li>Encourage the application of standard emergency evacuation procedure</li>
                            <li>Ultimately, minimise the risk to life and property</li>
                            <li>Create awareness on the duties and responsibilities of a fire warden</li>
                        </ul>
                        <h3 class="text-xl font-semibold mb-2">Course Content</h3>
                        <ul class="list-disc pl-5">
                            <li>Introduction</li>
                            <li>Fire Safety</li>
                            <li>Types Of Occupancy</li>
                            <li>Emergency</li>
                            <li>Fire Warden</li>
                            <li>Fire Drill And Emergency Key Personnel</li>
                            <li>Emergency Evacuation</li>
                            <li>Underlying Principles</li>
                            <li>Emergency Plan</li>
                            <li>Fire Alarm Evacuation Procedure</li>
                        </ul>
                    </div>
                    <div>
                        <img src="/images/lagos16.jpg" alt="Fire Warden Training"
                            class="w-full rounded-lg shadow-md mb-4">
                        <div class="bg-gray-200 p-4 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2">Course Details</h3>
                            <p><strong>Prerequisite:</strong> Basic fire fighting course or experience</p>
                            <p><strong>Target Audience:</strong> All personnel appointed to manage emergencies</p>
                            <p><strong>Duration:</strong> 3 hours</p>
                            <p><strong>Methodology:</strong> Online classroom session with digital projector</p>
                            <p><strong>Certification:</strong> Issued upon completion</p>
                            <p><strong>Revalidation:</strong> Every two years</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Fire Safety Training -->
            <section class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-3xl font-semibold mb-4 text-red-500">Fire Safety Training</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Objectives</h3>
                        <ul class="list-disc pl-5 mb-4">
                            <li>Recognizing Fire Hazards</li>
                            <li>What to do in case of Fire</li>
                            <li>Responding consciously during a fire</li>
                            <li>Using Fire Extinguishers</li>
                        </ul>
                        <h3 class="text-xl font-semibold mb-2">Learning Objectives</h3>
                        <ul class="list-disc pl-5">
                            <li>Identifying fire formation procedures</li>
                            <li>Discuss causes and classification of fire safety</li>
                            <li>Discuss importance of fire safety control tools</li>
                            <li>Outline elements of fire prevention</li>
                            <li>Familiarize with workplace safety inspection & reporting</li>
                            <li>Describe fire safety devices & their working techniques</li>
                            <li>Share requirements of emergency evacuation plans</li>
                            <li>Acknowledge types of fire extinguishers & their usage</li>
                        </ul>
                    </div>
                    <div>
                        <img src="/images/lagos15.jpg" alt="Fire Safety Training"
                            class="w-full rounded-lg shadow-md mb-4">
                        <div class="bg-gray-200 p-4 rounded-lg">
                            <h3 class="text-xl font-semibold mb-2">Course Details</h3>
                            <p><strong>Duration:</strong> 3 hours</p>
                            <p><strong>Who Can Take This Course:</strong> New Entrants, Fire Technicians, Fire Wardens,
                                Safety Officers, Fire Marshals, Emergency Response & Rescue Personnel, Interested Employees
                            </p>
                            <p><strong>Mode:</strong> Virtual training (Online) - No practical component</p>
                            <h3 class="text-xl font-semibold mt-4 mb-2">Benefits</h3>
                            <ul class="list-disc pl-5">
                                <li>Protect Employees and Customers</li>
                                <li>Give People Peace of Mind</li>
                                <li>Boost Employee Skills</li>
                                <li>Improve Fire Risk Assessment</li>
                                <li>Abide by Government Legislation</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
