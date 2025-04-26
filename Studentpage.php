<?php
session_start();
$studentName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Student';

include "Dbconnection.php"; // Make sure this file contains your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Prepare and execute SQL
        $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($user['role'] === 'student' && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];

                header("Location:Studfirstpage.php");
                exit();
            } else {
                $error = "Invalid student credentials.";
            }
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>