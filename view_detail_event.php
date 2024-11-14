<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Check if an event ID is provided in the query string
if (!isset($_GET['id'])) {
    header("Location: manage_events.php?error=No event ID provided."); // Redirect if no event ID
    exit();
}

$event_id = $_GET['id'];

// Fetch event details based on the provided event ID
$query = "SELECT * FROM events WHERE id = $event_id";
$result = mysqli_query($connection, $query);

// Check if the event exists
if (mysqli_num_rows($result) === 0) {
    echo "Event not found!";
    exit();
}

$event = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content for viewing event details -->
<main class="main-content">
    <div class="container">
        <h1>Event Details</h1>
        <div class="event-details">
            <div class="event-detail">
                <p><strong>Event Name:</strong> <span class="event-value"><?php echo htmlspecialchars($event['event_name']); ?></span></p>
            </div>
            <div class="event-detail">
                <p><strong>Description:</strong> <span class="event-value"><?php echo htmlspecialchars($event['event_description']); ?></span></p>
            </div>
            <div class="event-detail">
                <p><strong>Date:</strong> <span class="event-value"><?php echo htmlspecialchars($event['event_date']); ?></span></p>
            </div>
            <div class="event-detail">
                <p><strong>Location:</strong> <span class="event-value"><?php echo htmlspecialchars($event['event_location']); ?></span></p>
            </div>
            <div class="event-detail">
                <p><strong>Price:</strong> <span class="event-value">$<?php echo htmlspecialchars($event['event_price']); ?></span></p>
            </div>
            <div class="event-detail">
                <p><strong>Booking Status:</strong> <span class="event-value"><?php echo htmlspecialchars($event['book_status']); ?></span></p>
            </div>
        </div>

        <a href="manage_events.php" class="btn btn-secondary">Back to Events</a>
    </div>
</main>

<!-- Include footer -->
<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #ecf0f1;
        margin-left: 250px;
        padding-bottom: 50px;
        transition: margin-left 0.3s;
    }

    .main-content {
        margin-top: 60px; /* Add margin to create space from the top */
    }

    .container {
        max-width: 800px;
        margin-top: 150px; /* Adjust the value to your preference */

        margin: 50px auto;
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    h1 {
        margin-top: 50px; /* Adjust the value to your preference */

        font-size: 2.5rem;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
    }

    .event-details {
        margin-top: 30px;
        font-size: 18px;
        line-height: 1.8;
    }

    .event-detail {
        margin-bottom: 15px;
    }

    .event-value {
        font-weight: bold;
        color: #34495e;
        font-size: 1.1rem;
    }

    .btn-secondary {
        display: inline-block;
        background-color: #3498db;
        color: #fff;
        padding: 12px 25px;
        font-size: 1.2rem;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-secondary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px;
        }

        h1 {
            font-size: 2rem;
        }

        .btn-secondary {
            font-size: 1rem;
            padding: 10px 20px;
        }
    }
</style>
