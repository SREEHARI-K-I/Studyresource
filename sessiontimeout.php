<?php
// Auto logout after 30 minutes of inactivity
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    session_unset();     // Unset all session variables
    session_destroy();   // Destroy session data
    header("Location: login.html");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time
?>
