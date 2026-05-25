<div class="container">

    <div class="header">
        <h1>Student Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}</p>
    </div>

    <!-- WEATHER -->
    <div class="card">
        <h2>🌦 Weather</h2>

        @if($weather && isset($weather['current_weather']))
            <div class="weather">
                <p>🌡 {{ $weather['current_weather']['temperature'] }}°C</p>
                <p>💨 {{ $weather['current_weather']['windspeed'] }} km/h</p>
            </div>
        @else
            <p>No weather data available</p>
        @endif
    </div>

    <!-- SEARCH -->
    <div class="card">
        <h2>🔍 Search Users</h2>

        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search user...">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- USERS -->
    <div class="card">
        <h2>👥 Users</h2>

        @foreach($users as $user)
            <div class="user">
                {{ $user->name }} - {{ $user->email }}
            </div>
        @endforeach
    </div>

    <!-- POSTS -->
    <div class="card">
        <h2>📰 Posts</h2>

        @foreach($posts as $post)
            <div class="post">
                <h4>{{ $post['title'] }}</h4>
                <p>{{ $post['body'] }}</p>
            </div>
        @endforeach
    </div>

</div>