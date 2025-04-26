<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f4f4f4; display: flex; flex-direction: column; min-height: 100vh; }
        .container { width: 90%; max-width: 1200px; margin: 20px auto; text-align: center; flex-grow: 1; }
        .header { background: #007BFF; color: white; padding: 15px; font-size: 24px; font-weight: bold; border-radius: 5px; }
        .section { background: white; padding: 20px; margin-top: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .section h2 { color: #333; }
        .button { display: inline-block; width: 200px; padding: 15px; margin: 15px; font-size: 18px; font-weight: bold; color: white; background: #007BFF; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .button:hover { background: #0056b3; }
        .logout-btn { background: red; margin-top: 30px;margin-left: 90px; }
        .logout-btn:hover { background: darkred; }
        .footer { background: #333; color: white; text-align: center; padding: 15px; margin-top: 20px; font-size: 14px; border-radius: 5px 5px 0 0; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            Welcome<?php echo (!empty($_SESSION['name']) ? ', ' . htmlspecialchars($_SESSION['name']) : ', Student'); ?>!
        </div>

        <!-- Notes Section -->
        <div class="section">
            <h2>Notes</h2>
            <a href="viewnotes.php" class="button">View Notes</a>
        </div>

        <!-- PYQs Section -->
        <div class="section">
            <h2>Past Year Question Papers</h2>
            <a href="viewpyq.php" class="button">View PYQs</a>
        </div>

        <!-- Events Section -->
        <div class="section">
            <h2>University Events</h2>
            <a href="viewevents.php" class="button">View Events</a>
            <a href="uploadevent.html" class="button green">Upload Event</a>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="button logout-btn">Logout</a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 APJAKTUniversity. All Rights Reserved.
    </footer>

</body>
</html>
