<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-title {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 10px 0;
        }
        h2 {
            color: #3498db;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }
        .message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }
        input, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        button {
            background: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #229954;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section">
            <h1 class="main-title">Real Estate Management System</h1>
        </div>
        <h2>Add New Staff</h2>

        <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

        <form method="post">
            <label for="staff_id">Staff ID:</label>
            <input type="text" id="staff_id" name="staff_id" value="<?= htmlspecialchars($form_data['staff_id']) ?>" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($form_data['name']) ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= htmlspecialchars($form_data['password']) ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($form_data['phone']) ?>" required>

            <label for="security_answer">Security Answer:</label>
            <input type="text" id="security_answer" name="security_answer" value="<?= htmlspecialchars($form_data['security_answer']) ?>" required>

            <button type="submit">Add Staff</button>
        </form>

        <a href="index.php?action=staff_index" class="back-link">Back to Staff List</a>
    </div>
</body>
</html>
