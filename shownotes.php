<?php
require 'Dbconnection.php';

$notes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];

    $stmt = $conn->prepare("SELECT * FROM notes WHERE semester = ? AND subject = ?");
    $stmt->execute([$semester, $subject]);
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Notes - <?= htmlspecialchars($subject) ?> (Sem <?= htmlspecialchars($semester) ?>)</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f8;
      padding: 30px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
    }

    .note-list {
      max-width: 700px;
      margin: 30px auto;
    }

    .note-item {
      background: #ffffff;
      padding: 18px;
      margin-bottom: 15px;
      border-radius: 10px;
      box-shadow: 0 1px 6px rgba(0,0,0,0.1);
    }

    .note-item strong {
      display: block;
      margin-bottom: 8px;
      color: #34495e;
    }

    .note-item a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    .note-item a:hover {
      text-decoration: underline;
    }

    .back-button {
      display: block;
      text-align: center;
      margin-top: 40px;
    }

    .back-button a {
      text-decoration: none;
      padding: 10px 20px;
      background: #007bff;
      color: white;
      border-radius: 6px;
      font-weight: bold;
    }

    .back-button a:hover {
      background: #0056b3;
    }

  </style>
</head>
<body>

<h2>Notes for <?= htmlspecialchars($subject) ?> - Semester <?= htmlspecialchars($semester) ?></h2>

<div class="note-list">
  <?php if (!empty($notes)): ?>
    <?php foreach ($notes as $note): ?>
      <div class="note-item">
        <strong><?= htmlspecialchars($note['subject']) ?> (Sem <?= htmlspecialchars($note['semester']) ?>)</strong>
        <a href="<?= htmlspecialchars($note['file_path']) ?>" target="_blank">📄 View / Download</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">No Notes found for this semester and subject.</p>
  <?php endif; ?>
</div>

<div class="back-button">
  <a href="viewnotes.php">⬅ Back to Search</a>
</div>

</body>
</html>
