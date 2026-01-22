<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .title-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .main-title {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: white;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .message {
            background: rgba(52, 152, 219, 0.2);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid rgba(52, 152, 219, 0.3);
            backdrop-filter: blur(10px);
        }
        .error {
            background: rgba(231, 76, 60, 0.2);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid rgba(231, 76, 60, 0.3);
            backdrop-filter: blur(10px);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: 600;
            color: white;
            font-size: 16px;
        }
        input {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }
        .readonly-field {
            background: rgba(255, 255, 255, 0.05);
            cursor: not-allowed;
        }
        button {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
        }
        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        .back-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
        }
        .form-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .section-title {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        .password-requirements {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .password-requirements ul {
            margin: 10px 0 0 20px;
            padding: 0;
        }
        .password-requirements li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section">
            <h1 class="main-title">Real Estate Management System</h1>
        </div>
        <h2>Edit Profile</h2>

        <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="post">
            <div class="form-section">
                <div class="section-title">Account Information</div>
                <label for="admin_id">Admin ID:</label>
                <input type="text" id="admin_id" name="admin_id" value="<?= htmlspecialchars($admin['admin_id'] ?? '') ?>" readonly class="readonly-field">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($admin['name'] ?? '') ?>" placeholder="Enter your name" required>
            </div>

            <div class="form-section">
                <div class="section-title">Contact Information</div>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($admin['phone'] ?? '') ?>" placeholder="Enter your phone number" required>
            </div>

            <div class="form-section">
                <div class="section-title">Change Password (Optional)</div>
                <div class="password-requirements">
                    <strong>Password Requirements:</strong>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains at least one uppercase letter</li>
                        <li>Contains at least one lowercase letter</li>
                        <li>Contains at least one number</li>
                    </ul>
                </div>

                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" placeholder="Enter current password">

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password">

                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
            </div>

            <button type="submit">Update Profile</button>
        </form>

        <a href="index.php?action=dashboard" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>