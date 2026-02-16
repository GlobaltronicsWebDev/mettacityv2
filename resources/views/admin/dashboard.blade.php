@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard Overview</h2>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Visits</h6>
                        <h2 class="mb-0">{{ number_format($totalVisits) }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="fas fa-eye fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Today's Visits</h6>
                        <h2 class="mb-0">{{ number_format($todayVisits) }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-calendar-day fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Yesterday's Visits</h6>
                        <h2 class="mb-0">{{ number_format($yesterdayVisits) }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="fas fa-chart-line fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Bookings</h6>
                        <h2 class="mb-0">{{ $bookingsCount }}</h2>
                        @if($pendingBookings > 0)
                            <span class="badge bg-warning">{{ $pendingBookings }} Pending</span>
                        @endif
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-calendar-check fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Career Posts</h6>
                        <h2 class="mb-0">{{ $careersCount }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="fas fa-briefcase fa-2x text-info"></i>
                    </div>
                </div>
                <a href="{{ route('admin.careers.index') }}" class="btn btn-sm btn-info mt-3">
                    View Careers <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    @if(Auth::user()->is_super_admin)
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total News</h6>
                        <h2 class="mb-0">{{ $newsCount }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                    </div>
                </div>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-primary mt-3">
                    Manage News <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Users</h6>
                        <h2 class="mb-0">{{ $usersCount }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-success mt-3">
                    Manage Users <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h5>
                <div class="d-flex gap-2 flex-wrap mt-3">
                    @if(Auth::user()->is_super_admin)
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add News
                    </a>
                    <a href="{{ route('admin.careers.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Add Career
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Add User
                    </a>
                    @endif
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-warning">
                        <i class="fas fa-calendar"></i> View Bookings
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-secondary" target="_blank">
                        <i class="fas fa-eye"></i> View Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
