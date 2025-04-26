<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'Dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password_raw = $_POST["password"] ?? '';
    $register_number = trim($_POST["register_number"] ?? '');
    $role = $_POST["role"] ?? '';
    $admin_id = ($role === "admin") ? trim($_POST["admin_id"] ?? '') : null;

    // Check required fields
    if (empty($name) || empty($email) || empty($password_raw) || empty($register_number) || empty($role)) {
        die("❌ Please fill in all required fields.");
    }

    // Hash password
    $password = password_hash($password_raw, PASSWORD_BCRYPT);

    // Check if email or register number already exists
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE email = ? OR register_number = ?");
    $checkQuery->execute([$email, $register_number]);

    if ($checkQuery->rowCount() > 0) {
        die("❌ Error: Email or Register Number already exists!");
    }

    // If admin role, validate admin_id
    if ($role === "admin") {
        if (empty($admin_id)) {
            die("❌ Please provide Admin ID.");
        }

        $adminQuery = $conn->prepare("SELECT * FROM admin_verification WHERE admin_id = ? AND email = ?");
        $adminQuery->execute([$admin_id, $email]);

        if ($adminQuery->rowCount() == 0) {
            die("❌ Error: Invalid Admin ID or Email!");
        }
    }

    // Insert new user into database
    $insertQuery = $conn->prepare("INSERT INTO users (name, email, password, register_number, role, admin_id) 
                                   VALUES (?, ?, ?, ?, ?, ?)");

    $success = $insertQuery->execute([
        $name, $email, $password, $register_number, $role, $admin_id
    ]);

    if ($success) {
        // ✅ Registration successful, redirect to login page
        header("Location: login.html?message=registered");
        exit();
    } else {
        // ❌ Handle DB errors
        $errorInfo = $insertQuery->errorInfo();
        die("❌ Registration failed! DB Error: " . $errorInfo[2]);
    }
}
?>
