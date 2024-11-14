<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Clear cookies if they were set
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // Set expiration to past time to delete the cookie
}
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}
if (isset($_COOKIE['role'])) {
    setcookie('role', '', time() - 3600, '/');
}

// Redirect to the login page after logout
header("Location: login.html");
exit();
?>
