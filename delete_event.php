<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Check if an event ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage_events.php?error=No event ID provided!"); // Redirect if no event ID
    exit();
}

$event_id = mysqli_real_escape_string($connection, $_GET['id']);

// Delete event query
$delete_query = "DELETE FROM events WHERE id = '$event_id'";

if (mysqli_query($connection, $delete_query)) {
    // Redirect with a success message
    header("Location: manage_events.php?success=Event deleted successfully!");
    exit();
} else {
    // Display an error message if deletion fails
    echo "Error deleting event: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
