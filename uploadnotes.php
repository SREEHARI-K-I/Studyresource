<?php
require 'Dbconnection.php';
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("❌ User not logged in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];
    $file = $_FILES['file'];

    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $fileName = basename($file['name']);
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $uploadDir = 'uploads/notes/';
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = time() . '_' . $fileName;
    $targetFilePath = $uploadDir . $newFileName;

    $maxFileSize = 50 * 1024 * 1024;

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("❌ Invalid file type. Only PDF, DOC, DOCX allowed.");
    }

    if ($fileSize > $maxFileSize) {
        die("❌ File size too large. Must be under 50MB.");
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($fileTmp, $targetFilePath)) {
        die("❌ Failed to upload the file.");
    }

    $stmt = $conn->prepare("INSERT INTO notes (user_id, semester, subject, file_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $semester, $subject, $targetFilePath]);

    // ✅ Redirect to success page with query parameters
    header("Location: pyquploadsuccess.html?file=" . urlencode($newFileName));
    exit();
}
?>
