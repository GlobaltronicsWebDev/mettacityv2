<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Mettacity Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: #ffffff;
            padding: 0;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            border-right: 1px solid #e2e8f0;
            transition: width 0.3s ease;
            overflow: hidden;
        }
        
        .sidebar.collapsed {
            width: 70px;
        }
        
        .sidebar-header {
            padding: 20px;
            background: #2d3748;
            color: white;
            border-bottom: 1px solid #4a5568;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            min-height: 100px;
        }
        
        .sidebar-toggle-btn {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 10;
        }
        
        .sidebar-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-toggle-btn i {
            color: white;
            font-size: 1rem;
        }
        
        .sidebar-header-content {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 50px;
            transition: opacity 0.3s ease;
        }
        
        .sidebar.collapsed .sidebar-header-content {
            opacity: 0;
            pointer-events: none;
        }
        
        .sidebar.collapsed .sidebar-toggle-btn {
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .sidebar-logo {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .sidebar-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .sidebar-header-text h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.5px;
            color: #ffffff;
            white-space: nowrap;
        }
        
        .sidebar-header-text p {
            font-size: 0.75rem;
            margin: 2px 0 0 0;
            opacity: 0.9;
            font-weight: 300;
            color: #e2e8f0;
            white-space: nowrap;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 12px 0;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.875rem;
            position: relative;
            white-space: nowrap;
        }
        
        .sidebar.collapsed .sidebar-menu li a {
            padding: 12px 0;
            justify-content: center;
        }
        
        .sidebar-menu li a:hover {
            background: #f7fafc;
            color: #2d3748;
        }
        
        .sidebar-menu li a.active {
            background: #edf2f7;
            color: #2d3748;
            border-left: 3px solid #3182ce;
            padding-left: 17px;
            font-weight: 600;
        }
        
        .sidebar.collapsed .sidebar-menu li a.active {
            border-left: none;
            border-bottom: 3px solid #3182ce;
            padding: 12px 0;
        }
        
        .sidebar-menu li a i {
            margin-right: 12px;
            width: 18px;
            text-align: center;
            font-size: 0.95rem;
            color: #718096;
            flex-shrink: 0;
        }
        
        .sidebar.collapsed .sidebar-menu li a i {
            margin-right: 0;
        }
        
        .sidebar-menu li a.active i {
            color: #3182ce;
        }
        
        .sidebar-menu li a span {
            transition: opacity 0.3s ease;
        }
        
        .sidebar.collapsed .sidebar-menu li a span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 24px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: 70px;
        }
        
        .sidebar-toggle {
            display: none;
        }
        
        .top-bar {
            background: white;
            padding: 20px 24px;
            border-radius: 8px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .greeting {
            font-size: 1.125rem;
            font-weight: 600;
            color: #2d3748;
            font-family: 'Poppins', sans-serif;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3182ce;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .btn-logout {
            background: #e53e3e;
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-logout:hover {
            background: #c53030;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.25);
        }
        
        .btn-back-site {
            background: #3182ce;
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-back-site:hover {
            color: white;
            background: #2c5282;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.25);
        }
        
        .content-card {
            background: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        
        .table tbody tr {
            transition: all 0.3s;
        }
        
        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }
        
        .btn-primary {
            background: #3182ce;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-primary:hover {
            background: #2c5282;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.25);
        }
        
        .btn-success {
            background: #38a169;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-success:hover {
            background: #2f855a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(56, 161, 105, 0.25);
        }
        
        .btn-info {
            background: #3182ce;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-info:hover {
            background: #2c5282;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.25);
        }
        
        .btn-warning {
            background: #d69e2e;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-warning:hover {
            background: #b7791f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(214, 158, 46, 0.25);
        }
        
        .btn-danger {
            background: #e53e3e;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-danger:hover {
            background: #c53030;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.25);
        }
        
        .btn-secondary {
            background: #718096;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-weight: 500;
            font-size: 0.8125rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.3px;
        }
        
        .btn-secondary:hover {
            background: #4a5568;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(113, 128, 150, 0.25);
        }
        
        .alert {
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
            color: #11998e;
            border-left: 4px solid #11998e;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.1) 0%, rgba(254, 225, 64, 0.1) 100%);
            color: #fa709a;
            border-left: 4px solid #fa709a;
        }
        
        h2, h3, h4, h5 {
            font-weight: 600;
            color: #2d3748;
            font-family: 'Poppins', sans-serif;
        }
        
        h2 {
            font-size: 1.25rem;
        }
        
        h3 {
            font-size: 1.5rem;
        }
        
        h4 {
            font-size: 1.125rem;
        }
        
        h5 {
            font-size: 1rem;
        }
        
        h6 {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* Dark Mode Styles */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        
        body.dark-mode .sidebar {
            background: rgba(26, 26, 46, 0.95);
        }
        
        body.dark-mode .sidebar-menu li a {
            color: #cbd5e0;
        }
        
        body.dark-mode .sidebar-menu li a:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.2) 0%, transparent 100%);
            color: #a0aec0;
        }
        
        body.dark-mode .sidebar-menu li a.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.3) 0%, transparent 100%);
            color: #e2e8f0;
        }
        
        body.dark-mode .top-bar {
            background: rgba(26, 26, 46, 0.95);
        }
        
        body.dark-mode .greeting {
            background: linear-gradient(135deg, #a0aec0 0%, #cbd5e0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        body.dark-mode .content-card {
            background: rgba(26, 26, 46, 0.95);
        }
        
        body.dark-mode h2, 
        body.dark-mode h3, 
        body.dark-mode h4, 
        body.dark-mode h5 {
            color: #e2e8f0;
        }
        
        body.dark-mode .table {
            color: #cbd5e0;
        }
        
        body.dark-mode .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.1);
        }
        
        body.dark-mode .card {
            background: rgba(22, 33, 62, 0.8);
            color: #cbd5e0;
        }
        
        body.dark-mode .card h2,
        body.dark-mode .card h3,
        body.dark-mode .card h4,
        body.dark-mode .card h5,
        body.dark-mode .card h6 {
            color: #e2e8f0;
        }
        
        body.dark-mode .card .text-muted {
            color: #a0aec0 !important;
        }
        
        body.dark-mode .card-title {
            color: #e2e8f0;
        }
        
        body.dark-mode .badge {
            color: #1a1a2e;
        }
        
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: rgba(22, 33, 62, 0.8);
            color: #cbd5e0;
            border-color: rgba(102, 126, 234, 0.3);
        }
        
        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background: rgba(22, 33, 62, 0.9);
            color: #e2e8f0;
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        
        /* Dark Mode Toggle Button */
        .dark-mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s;
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dark-mode-toggle:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
        }
        
        body.dark-mode .dark-mode-toggle {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.4);
        }
        
        body.dark-mode .dark-mode-toggle:hover {
            box-shadow: 0 12px 30px rgba(245, 87, 108, 0.6);
        }
        
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button class="sidebar-toggle-btn" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="sidebar-header-content">
                <div class="sidebar-logo">
                    <img src="{{ asset('assets/MEEKO.png') }}" alt="Mettacity Logo">
                </div>
                <div class="sidebar-header-text">
                    <h3>Mettacity</h3>
                    <p>Admin Control</p>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> <span>Bookings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.careers.index') }}" class="{{ request()->routeIs('admin.careers.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i> <span>Careers</span>
                </a>
            </li>
            @if(Auth::user()->is_super_admin)
            <li>
                <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> <span>News Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.carousel.index') }}" class="{{ request()->routeIs('admin.carousel.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> <span>Carousel Slider</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ticket-tiers.index') }}" class="{{ request()->routeIs('admin.ticket-tiers.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt"></i> <span>Ticket Tiers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.accordions.index') }}" class="{{ request()->routeIs('admin.accordions.*') ? 'active' : '' }}">
                    <i class="fas fa-bars"></i> <span>Accordions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>User Management</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> <span>View Main Site</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div>
                <div class="greeting">
                    @php
                        $hour = now()->hour;
                        $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
                    @endphp
                    {{ $greeting }}, {{ Auth::user()->name }}! 👋
                </div>
            </div>
            <div class="user-info">
                <a href="{{ route('home') }}" class="btn-back-site">
                    <i class="fas fa-home"></i> Main Site
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="darkModeToggle" title="Toggle Dark Mode">
        <i class="fas fa-moon" id="darkModeIcon"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        // Check for saved sidebar state
        const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isSidebarCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }
        
        // Toggle sidebar
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Save state
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
        
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');
        const body = document.body;
        
        // Check for saved dark mode preference
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        
        if (isDarkMode) {
            body.classList.add('dark-mode');
            darkModeIcon.classList.remove('fa-moon');
            darkModeIcon.classList.add('fa-sun');
        }
        
        // Toggle dark mode
        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                darkModeIcon.classList.remove('fa-moon');
                darkModeIcon.classList.add('fa-sun');
                localStorage.setItem('darkMode', 'true');
            } else {
                darkModeIcon.classList.remove('fa-sun');
                darkModeIcon.classList.add('fa-moon');
                localStorage.setItem('darkMode', 'false');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
