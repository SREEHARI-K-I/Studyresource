<?php
require 'Dbconnection.php'; // Ensure this sets up $conn (PDO)

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
    <title>View Notes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        select, input[type="text"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .note-list {
            max-width: 700px;
            margin: auto;
        }

        .note-item {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
        }

        .note-item a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .note-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>View Uploaded Notes</h2>

<form method="POST" action="shownotes.php">
    <label for="semester">Select Semester:</label>
    <select name="semester" id="semester" required>
        <option value="">-- Select Semester --</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
    </select>

    <label for="subject">Enter Subject Name:</label>
    <input type="text" name="subject" id="subject" placeholder="e.g., Computer Networks" required>

    <button type="submit">View Notes</button>
</form>

<?php if (!empty($pyqs)): ?>
    <div class="notes-list">
        <?php foreach ($notes as $note): ?>
            <div class="note-item">
                <strong><?= htmlspecialchars($note['subject']) ?> - Semester <?= htmlspecialchars($pyq['semester']) ?></strong><br>
                <a href="<?= htmlspecialchars($note['file_path']) ?>" target="_blank">View / Download Notes</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p style="text-align:center;">No Notes found for the selected semester and subject.</p>
<?php endif; ?>

</body>
</html>
