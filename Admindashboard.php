<?php
session_start();
include 'sessiontimeout.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Not logged in or not an admin
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #eef2ff; display: flex; flex-direction: column; min-height: 100vh; }
        .container { width: 90%; max-width: 1200px; margin: 20px auto; text-align: center; flex-grow: 1; }
        .header { background: #1E3A8A; color: white; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 5px; }
        .section { background: white; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .section h2 { color: #1E3A8A; }
        .button { display: inline-block; width: 250px; padding: 15px; margin: 15px; font-size: 18px; font-weight: bold; color: white; background: #1E3A8A; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; transition: background 0.3s; }
        .button:hover { background: #172554; }
        .logout-btn { background: red; margin-top: 30px; }
        .logout-btn:hover { background: darkred; }
        .footer { background: #222; color: white; text-align: center; padding: 15px; margin-top: 20px; font-size: 14px; border-radius: 5px 5px 0 0; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">Admin Dashboard</div>

        <!-- View Total Users -->
        <div class="section">
            <h2>Total Users</h2>
            <a href="userdetails.php">
                <button class="button">View Users</button>
              </a>              
        </div>

        <!-- Upload Notes & PYQs -->
        <div class="section">
            <h2>Upload Notes & PYQs</h2>
            <a href="uploadnotes.html" class="button">Upload Notes</a>
            <a href="uploadpyq.html" class="button">Upload PYQs</a>
        </div>

        <!-- Student Event Requests -->
        <div class="section">
            <h2>Manage Event Requests</h2>
            <a href="fetchpending.php" class="button">View Event Requests</a>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="button logout-btn">Logout</a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 APJAKTUniversity Admin Panel. All Rights Reserved.
    </footer>

</body>
</html>
