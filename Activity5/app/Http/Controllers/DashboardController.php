<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Users from our own API/DB
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%");
        })->get();

        // Posts from Public API (JSONPlaceholder)
        $posts = Cache::remember('posts', 60, function () {
            try {
                $response = Http::get('https://jsonplaceholder.typicode.com/posts');
                return $response->successful() ? array_slice($response->json(), 0, 10) : [];
            } catch (\Exception $e) {
                return [];
            }
        });

        // External Data (Weather API - optional bonus)
        $weather = Cache::remember('weather', 60, function () {
            try {
                $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude=14.5995&longitude=120.9842&current_weather=true');
                return $response->successful() ? $response->json() : null;
            } catch (\Exception $e) {
                return null;
            }
        });

        $data = [
            'loggedInUser' => $user,
            'users' => $users,
            'posts' => $posts,
            'weather' => $weather,
            'search' => $search
        ];

        if ($user->role === 'admin') {
            return view('admin-dashboard', $data);
        }

        return view('user-dashboard', $data);
    }
}
