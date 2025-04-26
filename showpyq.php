<?php
require 'Dbconnection.php';

$pyqs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];

    $stmt = $conn->prepare("SELECT * FROM pyqs WHERE semester = ? AND subject = ?");
    $stmt->execute([$semester, $subject]);
    $pyqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PYQs - <?= htmlspecialchars($subject) ?> (Sem <?= htmlspecialchars($semester) ?>)</title>
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

    .pyq-list {
      max-width: 700px;
      margin: 30px auto;
    }

    .pyq-item {
      background: #ffffff;
      padding: 18px;
      margin-bottom: 15px;
      border-radius: 10px;
      box-shadow: 0 1px 6px rgba(0,0,0,0.1);
    }

    .pyq-item strong {
      display: block;
      margin-bottom: 8px;
      color: #34495e;
    }

    .pyq-item a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    .pyq-item a:hover {
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

<h2>PYQs for <?= htmlspecialchars($subject) ?> - Semester <?= htmlspecialchars($semester) ?></h2>

<div class="pyq-list">
  <?php if (!empty($pyqs)): ?>
    <?php foreach ($pyqs as $pyq): ?>
      <div class="pyq-item">
        <strong><?= htmlspecialchars($pyq['subject']) ?> (Sem <?= htmlspecialchars($pyq['semester']) ?>)</strong>
        <a href="<?= htmlspecialchars($pyq['file_path']) ?>" target="_blank">📄 View / Download</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center;">No PYQs found for this semester and subject.</p>
  <?php endif; ?>
</div>

<div class="back-button">
  <a href="viewpyq.php">⬅ Back to Search</a>
</div>

</body>
</html>
