<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Check if a user ID is provided in the query string
if (!isset($_GET['id'])) {
    header("Location: manage_users.php?error=No user ID provided."); // Redirect with an error message
    exit();
}

$user_id = $_GET['id'];

// Delete the user from the database
$delete_query = "DELETE FROM user WHERE id = $user_id";
if (mysqli_query($connection, $delete_query)) {
    header("Location: manage_users.php?success=User deleted successfully!");
    exit();
} else {
    echo "Error deleting user: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
