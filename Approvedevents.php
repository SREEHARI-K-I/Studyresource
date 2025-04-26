<?php
require 'Dbconnection.php'; // Ensure this sets up $conn (PDO)

try {
    // Fetch all events ordered by newest first
    $stmt = $conn->prepare("SELECT * FROM events ORDER BY created_at DESC");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching approved events: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Approved Events</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .event-card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      margin: 20px auto;
      max-width: 700px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .event-card h3 {
      margin-top: 0;
      color: #222;
    }

    .event-info {
      margin: 8px 0;
    }

    .poster-link {
      display: inline-block;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
    }

    .poster-link:hover {
      text-decoration: underline;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 30px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h2>Approved Events</h2>

  <?php if ($events): ?>
    <?php foreach ($events as $event): ?>
      <div class="event-card">
        <h3><?= htmlspecialchars($event['title']) ?></h3>
        <div class="event-info"><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></div>
        <div class="event-info"><strong>Description:</strong> <?= nl2br(htmlspecialchars($event['description'])) ?></div>
        <?php if (!empty($event['image_path'])): ?>
          <a class="poster-link" href="<?= htmlspecialchars($event['image_path']) ?>" target="_blank">View Poster</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">No approved events found.</p>
  <?php endif; ?>

  <a class="back-link" href="fetchpending.php">← Back to Pending Events</a>

</body>
</html>
