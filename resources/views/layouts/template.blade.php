@extends('layouts.base')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnM Hardware Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @push('styles')
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --accent: #f72585;
            --light-bg: #f8f9fa;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --border-color: #e9ecef;
            --sidebar-width: 280px;
            --header-height: 70px;
            --shadow-sm: 0 2px 5px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 10px rgba(0,0,0,0.08);
            --border-radius: 12px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #ffffff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: var(--shadow-sm);
            padding: 1.5rem 0;
            overflow-y: auto;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .sidebar-logo {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-align: center;
            margin-bottom: 0;
        }
        
        .nav-section {
            padding: 0 1rem;
            margin-bottom: 1rem;
        }
        
        .nav-section-title {
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 1.5rem 0.5rem 0.5rem;
        }
        
        .nav-items {
            list-style: none;
            padding: 0;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-dark);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .nav-link i {
            width: 1.5rem;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            color: var(--text-muted);
            transition: color 0.2s ease;
        }
        
        .nav-link span {
            flex: 1;
        }
        
        .nav-link:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }
        
        .nav-link:hover i {
            color: var(--primary);
        }
        
        .nav-link.active {
            background-color: var(--primary);
            color: white;
        }
        
        .nav-link.active i {
            color: white;
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            font-weight: 500;
            background: none;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .logout-btn i {
            width: 1.5rem;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            color: var(--accent);
        }
        
        .logout-btn:hover {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--accent);
        }
        
        /* Main Content Area */
        .main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }
        
        /* Header Styles */
        .header {
            height: var(--header-height);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .admin-profile {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: var(--light-bg);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .admin-profile:hover {
            background-color: var(--border-color);
        }
        
        .admin-profile i {
            font-size: 1rem;
            color: var(--primary);
            margin-right: 0.5rem;
        }
        
        .admin-profile span {
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        /* Content Area */
        .content {
            flex: 1;
            padding: 2rem;
            background-color: var(--light-bg);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                padding: 1rem 0;
            }
            
            .sidebar-header {
                padding: 0 0.5rem 1rem;
            }
            
            .sidebar-logo {
                font-size: 1.2rem;
            }
            
            .nav-section-title, 
            .nav-link span {
                display: none;
            }
            
            .nav-link {
                justify-content: center;
                padding: 0.75rem;
            }
            
            .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .logout-btn {
                justify-content: center;
                padding: 0.75rem;
            }
            
            .logout-btn i {
                margin-right: 0;
            }
            
            .main-wrapper {
                margin-left: 70px;
            }
        }
        
        @media (max-width: 576px) {
            .header {
                padding: 0 1rem;
            }
            
            .content {
                padding: 1rem;
            }
        }
    </style>
    @endpush
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1 class="sidebar-logo">EnM Admin</h1>
        </div>
        
        <div class="nav-section">
            <h2 class="nav-section-title">Main Menu</h2>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('item.index') }}" class="nav-link {{ request()->routeIs('item.*') ? 'active' : '' }}">
                        <i class="fas fa-cart-shopping"></i>
                        <span>Items</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reviews.index') }}" class="nav-link {{ request()->routeIs('reviews.*') ? 'active' : '' }}">
                        <i class="fas fa-scroll"></i>
                        <span>Reviews</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h2 class="nav-section-title">Account</h2>
            <ul class="nav-items">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    
    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header">
            <h2 class="page-title">
                @yield('page-title', 'Dashboard')
            </h2>
            
            <div class="header-actions">
                <div class="admin-profile">
                    <i class="fas fa-user-circle"></i>
                    <span>Admin</span>
                </div>
            </div>
        </header>
        
        <!-- Main Content Area -->
        <main class="content">
            @yield('content')
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>