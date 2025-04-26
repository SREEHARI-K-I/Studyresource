<?php
require 'Dbconnection.php'; // Make sure $conn (PDO) is ready

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    try {
        // Step 1: Fetch event from pending_events
        $stmt = $conn->prepare("SELECT * FROM pending_events WHERE id = ?");
        $stmt->execute([$event_id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            // Step 2: Insert into events table
            $insert = $conn->prepare("INSERT INTO events (title, description, event_date, image_path, created_by, created_at) 
                                      VALUES (?, ?, ?, ?, ?, NOW())");
            $insert->execute([
                $event['event_title'],
                $event['event_description'],
                $event['event_date'],
                $event['file_path'],
                $event['student_id']
            ]);

            // Step 3: Delete from pending_events
            $delete = $conn->prepare("DELETE FROM pending_events WHERE id = ?");
            $delete->execute([$event_id]);

            // Step 4: Redirect or success message
            header("Location: approve_success.php");
            exit();
        } else {
            echo "Event not found or already approved.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
