<?php
session_start();
require 'Dbconnection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if user exists
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Authentication successful
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["name"] = $user["name"];


        if ($user["role"] === "admin") {
            header("Location: Admindashboard.php");
        } else {
            header("Location: Studfirstpage.php");
        }
        exit;
    } else {
        echo "<script>alert('❌ Invalid email or password!'); window.location='login.html';</script>";
    }
}
?>
