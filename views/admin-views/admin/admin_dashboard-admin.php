<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('resources/1.jpg');
            background-size: cover;
            
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-title {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: #ffffffdb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;
            
        }
        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #ffffffdb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #cb3030ff;
            margin-bottom: 10px;
        }
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .menu-card {
            background: #ffffffdb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .menu-card h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .menu-links {
            list-style: none;
            padding: 0;
        }
        .menu-links li {
            margin-bottom: 10px;
        }
        .menu-links a {
            background: #27ae60;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s;
            display: inline-block;
        }
        .menu-links a:hover {
            background: #229954;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section">
            <h1 class="main-title">Real Estate Management System</h1>
        </div>
        <div class="header">
            <div class="header-left">
                <h1>Admin Dashboard</h1>
            </div>
            <a href="index.php?action=logout" class="logout-btn">Logout</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Admins</h3>
                <div class="stat-number"><?= $stats['total_admins'] ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-number"><?= $stats['total_users'] ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Staff</h3>
                <div class="stat-number"><?= $stats['total_staff'] ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Property Owners</h3>
                <div class="stat-number"><?= $stats['total_owners'] ?></div>
            </div>
        </div>

        <div class="menu">
            <div class="menu-card">
                <h3>Admin Management</h3>
                <ul class="menu-links">
                    <li><a href="index.php?action=index">View All Admins</a></li>
                    <li><a href="index.php?action=add">Add New Admin</a></li>
                </ul>
            </div>
            <div class="menu-card">
                <h3>User Management</h3>
                <ul class="menu-links">
                    <li><a href="index.php?action=user_index">View All Users</a></li>
                    <li><a href="index.php?action=user_add">Add New User</a></li>
                </ul>
            </div>
            <div class="menu-card">
                <h3>Staff Management</h3>
                <ul class="menu-links">
                    <li><a href="index.php?action=staff_index">View All Staff</a></li>
                    <li><a href="index.php?action=staff_add">Add New Staff</a></li>
                </ul>
            </div>
            <div class="menu-card">
                <h3>Property Owner Management</h3>
                <ul class="menu-links">
                    <li><a href="index.php?action=owner_index">View All Owners</a></li>
                    <li><a href="index.php?action=owner_add">Add New Owner</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
