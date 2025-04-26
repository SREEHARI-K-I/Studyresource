<?php
require 'Dbconnection.php'; // Ensure this sets up $conn (PDO)

try {
    $stmt = $conn->prepare("SELECT * FROM pending_events WHERE status = 'pending' ORDER BY id DESC");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching events: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pending Events - Admin Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 20px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .event-container {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      margin: 15px auto;
      max-width: 800px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .event-container h3 {
      color: #444;
      margin-top: 0;
    }

    .event-info {
      margin-bottom: 10px;
    }

    .event-actions {
      display: flex;
      gap: 15px;
    }

    .event-actions form {
      display: inline-block;
    }

    .event-actions button {
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      font-weight: bold;
    }

    .approve-btn {
      background-color: #28a745;
    }

    .reject-btn {
      background-color: #dc3545;
    }

    .poster {
      max-width: 100%;
      max-height: 200px;
      margin-top: 10px;
    }

    .navigation-buttons {
      text-align: center;
      margin-top: 40px;
    }

    .navigation-buttons a {
      display: inline-block;
      padding: 10px 20px;
      margin: 0 10px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .navigation-buttons a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <h2>Pending Event Submissions</h2>

  <?php if ($events): ?>
    <?php foreach ($events as $event): ?>
      <div class="event-container">
        <h3><?= htmlspecialchars($event['event_title']) ?></h3>
        <div class="event-info"><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></div>
        <div class="event-info"><strong>Description:</strong> <?= nl2br(htmlspecialchars($event['event_description'])) ?></div>

        <?php if (!empty($event['file_path'])): ?>
          <div class="event-info">
            <a href="<?= htmlspecialchars($event['file_path']) ?>" target="_blank">View Poster</a>
          </div>
        <?php endif; ?>

        <div class="event-actions">
          <form method="POST" action="approveevent.php">
            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
            <button class="approve-btn" type="submit">Approve</button>
          </form>
          <form method="POST" action="rejectevent.php">
            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
            <button class="reject-btn" type="submit">Reject</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align: center;">No pending events found.</p>
  <?php endif; ?>

  <div class="navigation-buttons">
    <a href="Rejectedevents.php">View Rejected Events</a>
    <a href="Approvedevents.php">View Approved Events</a>
  </div>

</body>
</html>
