@include('layouts.web.header')


    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Volunteer Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ $volunteer->name }}!</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $totalVolunteers }}</h3>
                        <p class="text-gray-600">Total Volunteers</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-tint text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $totalDonors }}</h3>
                        <p class="text-gray-600">Blood Donors</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-user text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $volunteer->name }}</h3>
                        <p class="text-gray-600">Your Profile</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Information -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Your Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Name:</span>
                            <span class="font-medium">{{ $volunteer->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium">{{ $volunteer->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-medium">{{ $volunteer->mobile }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Blood Group:</span>
                            <span class="font-medium">{{ $volunteer->blood_group ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Location:</span>
                            <span class="font-medium">{{ $volunteer->district ?: 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Education:</span>
                            <span class="font-medium">{{ $volunteer->edu_qual ?: 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Member Since:</span>
                            <span class="font-medium">{{ $volunteer->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center">
            <form action="{{ route('volunteer.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="bg-gray-600 text-white py-2 px-6 rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </div>


@include('layouts.web.footer')
