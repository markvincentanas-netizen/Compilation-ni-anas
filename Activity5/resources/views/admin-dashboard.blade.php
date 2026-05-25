<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Welcome, {{ $loggedInUser->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        You are logged in as an <strong>Admin</strong>.
                    </p>
                </div>
            </div>

            <!-- Weather Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">🌦 Weather Forecast (Manila)</h3>
                @if($weather && isset($weather['current_weather']))
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl font-bold text-blue-600">{{ $weather['current_weather']['temperature'] }}°C</div>
                        <div class="text-sm text-gray-600">
                            Wind: {{ $weather['current_weather']['windspeed'] }} km/h
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">No weather data available.</p>
                @endif
            </div>

            <!-- Search and User List -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">👥 User Management</h3>
                    <form method="GET" action="{{ route('dashboard') }}" class="flex">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search users..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Search
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Public API Data (Posts) -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">📰 Latest Posts (from JSONPlaceholder)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($posts as $post)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                        <h4 class="font-bold text-gray-800 mb-2">{{ $post['title'] }}</h4>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $post['body'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
