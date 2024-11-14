<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header("Location: login.html"); // Redirect to login if not logged in as User
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch events related to the logged-in user
$query = "
    SELECT 
        bookings.id AS ticket_id,
        bookings.user_id,
        bookings.event_id,
        bookings.ticket_number,
        bookings.created_at,
        events.event_name,
        events.event_date,
        events.event_location
    FROM bookings
    JOIN events ON bookings.event_id = events.id
    WHERE bookings.user_id = $user_id
    ORDER BY bookings.created_at DESC
";
$result = mysqli_query($connection, $query);

// Check if there are any events for the user
if (mysqli_num_rows($result) === 0) {
    echo "No events found for this user.";
    exit();
}

// Prepare data for displaying events
$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

// Close the database connection
mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Main content for viewing user-specific events -->
<main class="main-content">
    <div class="container">
        <h1>Your Booked Events</h1>

        <!-- Event Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Location</th>
                    <th>Booking Date</th>
                    <th>Ticket No</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_location']); ?></td>
                        <td><?php echo htmlspecialchars($event['created_at']); ?></td>
                        <td>
                            <a href="ticket_details.php?ticket_id=<?php echo $event['ticket_id']; ?>">
                                <?php echo htmlspecialchars($event['ticket_number']); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="profile.php" class="btn btn-secondary">Back to Profile</a>
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

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px; /* Adds space below the table */
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
    }

    /* Styling for the button */
    .btn-secondary {
        background-color: #ccc;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 10px; /* Adds space between buttons */
        margin-top: 20px; /* Adds space from the top */
    }

    /* Hover effect for button */
    .btn-secondary:hover {
        background-color: #bbb;
    }
</style>
