<?php
session_start();
include('db/db_connect.php');  // Include the database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html");  // Redirect to login if not logged in as Admin
    exit();
}

// Fetch events from the database
$query = "SELECT * FROM events ORDER BY event_date DESC";  // Fetch all events ordered by event date
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error fetching events: " . mysqli_error($connection));
}

?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content -->
<main class="main-content">
    <div class="container">
        <h1>View Events</h1>

        <!-- Success Message (if any) -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_GET['success']; ?>
            </div>
        <?php endif; ?>

        <!-- Events Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Booking Status</th>
                    <th>View Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_description']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_location']); ?></td>
                        <td><?php echo htmlspecialchars($event['event_price']); ?></td>
                        <td><?php echo htmlspecialchars($event['book_status']); ?></td>
                        <td>
                            <a href="view_detail_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">View</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Include footer -->
<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
        .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #f9f9f9; /* Light background to make the form stand out */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px; /* Space below main content */

    }
    .main-content {
        flex: 1;
        margin-left: 270px; /* Assuming sidebar width */
        padding: 30px;
        padding-top: 90px; /* Add top padding to avoid header overlap */
        box-sizing: border-box;
        margin-bottom: 50px; /* Space below main content */

    }


    h1 {
        color: #2c3e50;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
    }

    .btn {
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .alert {
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #2ecc71;
        color: white;
        padding: 15px;
        border-radius: 5px;
    }

</style>
