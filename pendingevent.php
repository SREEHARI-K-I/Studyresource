<?php
require 'Dbconnection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to submit an event.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_SESSION['user_id'];
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : '';

    if (empty($title) || empty($description) || empty($event_date)) {
        die("❌ All fields are required.");
    }

    if (!isset($_FILES['poster']) || $_FILES['poster']['error'] !== UPLOAD_ERR_OK) {
        die("❌ Please upload a valid image or file.");
    }

    $file = $_FILES['poster'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    $fileName = basename($file['name']);
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $uploadDir = 'uploads/events/';
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $targetFilePath = $uploadDir . time() . '_' . $fileName;

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("❌ Invalid file type. Allowed types: jpg, jpeg, png, gif, pdf.");
    }

    if ($fileSize > 20 * 1024 * 1024) {
        die("❌ File size too large. Max is 20MB.");
    }

    // Create directory if not exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($fileTmp, $targetFilePath)) {
        die("❌ Failed to move uploaded file.");
    }

    $stmt = $conn->prepare("INSERT INTO pending_events (student_id, event_title, event_description, event_date, file_path) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$student_id, $title, $description, $event_date, $targetFilePath]);

    header("Location: pendinguploadsuccess.html?file=" . urlencode($newFileName));
    exit;
}
?>
