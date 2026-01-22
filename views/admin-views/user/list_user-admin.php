<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
            background-image: url('resources/1.jpg');
            background-size: cover;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffffdb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-title {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #229954;
        }
        .btn-danger {
            background: #e74c3c;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        tr:hover {
            background-color: #f1f2f6;
        }
        .actions a {
            /* color: #3498db; */
            text-decoration: none;
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s;
        }
        .actions a:hover {
            background: #229954;
            color: white;
        }
        .delete-link {
            color: #e74c3c;
        }
        .delete-link:hover {
            background: #e74c3c;
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
            <h2>User List</h2>
            <div class="actions">
                <a href="index.php?action=user_add" class="btn">Add New User</a>
                <a href="index.php?action=dashboard" class="btn">Dashboard</a>
                <a href="index.php?action=logout" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['user_id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td class="actions">
                <a href="index.php?action=user_edit&id=<?= $user['user_id'] ?>">Edit</a>
                <a href="index.php?action=user_delete&id=<?= $user['user_id'] ?>" class="delete-link" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
