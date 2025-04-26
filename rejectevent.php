<?php
require 'Dbconnection.php'; // Make sure this sets up $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];

    try {
        // Update the event status to 'rejected'
        $stmt = $conn->prepare("UPDATE pending_events SET status = 'rejected' WHERE id = :id");
        $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
        $stmt->execute();

        $message = "Event ID $eventId has been successfully rejected.";
    } catch (PDOException $e) {
        $message = "❌ Error rejecting event: " . $e->getMessage();
    }
} else {
    $message = "❌ Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejection Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message-box h2 {
            color: #dc3545;
        }
        .back-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .back-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2><?= htmlspecialchars($message) ?></h2>
        <a href="fetchpending.php" class="back-btn">Back to Pending Events</a>
    </div>
</body>
</html>
