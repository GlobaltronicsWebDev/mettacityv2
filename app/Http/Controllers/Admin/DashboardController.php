<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $newsCount = News::count();
        $bookingsCount = \App\Models\Booking::count();
        $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
        $careersCount = \App\Models\Career::count();
        $usersCount = \App\Models\User::count();
        
        // Visit statistics
        $totalVisits = \App\Models\Visit::count();
        $todayVisits = \App\Models\Visit::whereDate('visited_at', today())->count();
        $yesterdayVisits = \App\Models\Visit::whereDate('visited_at', today()->subDay())->count();
        
        return view('admin.dashboard', compact(
            'newsCount', 
            'bookingsCount', 
            'pendingBookings',
            'careersCount',
            'usersCount',
            'totalVisits',
            'todayVisits',
            'yesterdayVisits'
        ));
    }
}
