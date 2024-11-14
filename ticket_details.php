<?php
session_start();
include('db/db_connect.php'); // Include database connection

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header("Location: login.html"); // Redirect to login if not logged in as User
    exit();
}

// Get the ticket_id from the URL
if (isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    // Validate the ticket_id to ensure it's an integer
    if (!filter_var($ticket_id, FILTER_VALIDATE_INT)) {
        echo "Invalid Ticket ID.";
        exit();
    }

    // Query to fetch ticket and event details
    $query = "
        SELECT 
            bookings.id AS ticket_id,
            bookings.ticket_number,
            bookings.created_at,
            events.event_name,
            events.event_date,
            events.event_location,
            bookings.user_id
        FROM bookings
        JOIN events ON bookings.event_id = events.id
        WHERE bookings.id = $ticket_id AND bookings.user_id = {$_SESSION['user_id']}
    ";

    $result = mysqli_query($connection, $query);

    // If no matching ticket is found, show an error
    if (mysqli_num_rows($result) === 0) {
        echo "Ticket not found or you don't have access to this ticket.";
        exit();
    }

    // Fetch the ticket details
    $ticket = mysqli_fetch_assoc($result);
} else {
    echo "Ticket ID is missing.";
    exit();
}

// Close the database connection
mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Main content for viewing ticket details -->
<main class="main-content">
    <div class="container">
        <h1>Ticket Details</h1>

        <div class="ticket-info">
            <p><strong>Ticket Number:</strong> <?php echo htmlspecialchars($ticket['ticket_number']); ?></p>
            <p><strong>Event Name:</strong> <?php echo htmlspecialchars($ticket['event_name']); ?></p>
            <p><strong>Event Date:</strong> <?php echo htmlspecialchars($ticket['event_date']); ?></p>
            <p><strong>Event Location:</strong> <?php echo htmlspecialchars($ticket['event_location']); ?></p>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($ticket['created_at']); ?></p>
        </div>

        <div class="button-container">
            <a href="user_events.php" class="btn btn-secondary">Back to Your Events</a>
        </div>
    </div>
</main>

<!-- Include footer -->
<?php include('footer.php'); ?>

<!-- Custom Styling -->
<style>
    /* Reset some default styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    /* Sidebar styling */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background-color: #333;
        color: white;
        padding: 20px;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Main content area */
    .main-content {
        margin-left: 270px; /* Add space for sidebar */
        padding: 20px;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .ticket-info p {
        margin-bottom: 15px;
        font-size: 16px;
    }

    .ticket-info strong {
        color: #333;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-top: 20px;
    }

    .btn-secondary:hover {
        background-color: #bbb;
    }
</style>
