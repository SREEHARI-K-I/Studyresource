<?php
require 'Dbconnection.php'; // Make sure this connects using PDO

try {
    $stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date DESC");
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
    <title>Upcoming Events</title>
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

        .event-container {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin: 15px auto;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .event-container h3 {
            margin: 0;
            color: #2c3e50;
        }

        .event-info {
            margin: 8px 0;
        }

        .event-info strong {
            color: #555;
        }

        .poster-link {
            display: inline-block;
            margin-top: 8px;
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        .poster-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<h2>Upcoming Events</h2>

<?php if ($events): ?>
    <?php foreach ($events as $event): ?>
        <div class="event-container">
            <h3><?= htmlspecialchars($event['title']) ?></h3>
            <div class="event-info"><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></div>
            <div class="event-info"><strong>Description:</strong> <?= nl2br(htmlspecialchars($event['description'])) ?></div>

            <?php if (!empty($event['image_path'])): ?>
                <div class="event-info">
                    <a class="poster-link" href="<?= htmlspecialchars($event['image_path']) ?>" target="_blank">View Poster</a>
                </div>
            <?php endif; ?>

            <div class="event-info"><strong>Posted By (ID):</strong> <?= htmlspecialchars($event['created_by']) ?></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No events found.</p>
<?php endif; ?>

</body>
</html>
