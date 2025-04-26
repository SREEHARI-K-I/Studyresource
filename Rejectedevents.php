<?php
require 'Dbconnection.php'; // Ensure this file contains your PDO $conn setup

try {
    $stmt = $conn->prepare("SELECT * FROM pending_events WHERE status = 'rejected' ORDER BY id DESC");
    $stmt->execute();
    $rejectedEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Error fetching rejected events: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rejected Events - Admin Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      padding: 20px;
    }

    h2 {
      text-align: center;
      color: #444;
    }

    .event-card {
      background: #fff;
      border-left: 5px solid #dc3545;
      padding: 15px;
      margin: 15px auto;
      max-width: 800px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      border-radius: 8px;
    }

    .event-card h3 {
      margin: 0;
      color: #333;
    }

    .event-info {
      margin: 8px 0;
      color: #555;
    }

    .poster-link {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h2>Rejected Event Submissions</h2>

  <?php if ($rejectedEvents): ?>
    <?php foreach ($rejectedEvents as $event): ?>
      <div class="event-card">
        <h3><?= htmlspecialchars($event['event_title']) ?></h3>
        <div class="event-info"><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></div>
        <div class="event-info"><strong>Description:</strong> <?= nl2br(htmlspecialchars($event['event_description'])) ?></div>
        <?php if (!empty($event['file_path'])): ?>
          <a class="poster-link" href="<?= htmlspecialchars($event['file_path']) ?>" target="_blank">View Poster</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">No rejected events found.</p>
  <?php endif; ?>

</body>
</html>
