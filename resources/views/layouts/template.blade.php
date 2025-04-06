@extends('layouts.base')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @push('styles')
    <style>
        body {
            display: grid;
            grid-template-columns: 250px 100px 100px auto; 
            grid-template-rows: 80px 100px auto 100px; 
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .sidebar {
            grid-row: 1 / 5; 
            background: #ffffff;
            color: #333;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            width: 250px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            padding: 10px;
            color: #4a6baf;
            font-weight: 600;
            letter-spacing: 1px;
            border-bottom: 1px solid #eaedf2;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            padding: 8px 15px;
            margin-bottom: 5px;
        }

        .sidebar ul li a {
            color: #5a6a8a;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            margin-right: 15px;
        }

        .sidebar ul li a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1em;
            color: #6d8ed3;
        }

        .sidebar ul li a:hover {
            background: #f0f4fb;
            transform: translateX(5px);
            border-left: 4px solid #4a6baf;
            color: #4a6baf;
        }

        .sidebar ul li a:hover i {
            color: #4a6baf;
        }

        .header {
            grid-column: 2 / 5; 
            grid-row: 1/2;
            background: linear-gradient(135deg, #ffffff 0%, #f5f7fa 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            color: #333;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #eaedf2;
        }

        .header h2 {
            font-weight: 600;
            font-size: 1.5rem;
            color: #4a6baf;
            letter-spacing: 1px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            background: #edf1f9;
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
            color: #5a6a8a;
        }

        .admin-info:hover {
            background: #dde5f3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .admin-info i {
            margin-right: 10px;
            color: #4a6baf;
            font-size: 1.1em;
        }

        .content {
            grid-column: 2 / 5;
            grid-row: 2 / 5;
            width: 100%;
            padding: 20px;
            background: #f5f7fa;
            box-shadow: inset 0 3px 10px rgba(0, 0, 0, 0.05);
            color: #333;
        }

        /* Adding some cool pulse animation to the sidebar hover */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(74, 107, 175, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(74, 107, 175, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 107, 175, 0); }
        }

        .sidebar ul li a:active {
            animation: pulse 1s;
        }
        
        /* Styled logout button */
        .logout-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            width: 100%;
            text-align: left;
            padding: 12px 15px;
            margin: 8px 15px;
            border-radius: 8px;
            color: #5a6a8a;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .logout-btn i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1em;
            color: #6d8ed3;
        }
        
        .logout-btn:hover {
            background: #f0f4fb;
            transform: translateX(5px);
            border-left: 4px solid #4a6baf;
            color: #4a6baf;
        }
        
        .logout-btn:hover i {
            color: #4a6baf;
        }
        
        .logout-btn:active {
            animation: pulse 1s;
        }
        
        .sidebar form {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href=""><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{route('user.index')}}"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="{{route('item.index')}}"><i class="fas fa-bed"></i> Items</a></li>
            <li><a href="{{route('orders.index')}}"><i class="fas fa-cart-shopping"></i>Orders</a></li>
            <li><a href="http:/resort-ms/admin/activity_logs/index.php"><i class="fas fa-scroll"></i> Activity Logs</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="header">
        <h2>Haven Mechanical keyboard</h2>
        <div class="admin-info">
            <i class="fas fa-user"></i> Admin
        </div>
    </div>

    @yield("content")
    @push("scripts")
</body>
</html>