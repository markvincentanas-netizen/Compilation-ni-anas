<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Welcome, {{ $loggedInUser->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        You are logged in as a <strong>User</strong>.
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
