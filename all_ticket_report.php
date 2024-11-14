<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Fetch all ticket details, joining the events and users tables to get more info
$query = "
SELECT 
    bookings.id AS ticket_id,
    bookings.user_id,
    bookings.event_id,
    bookings.ticket_number,
    bookings.created_at,
    events.event_name,
    events.event_date,
    user.name AS user_name,
    user.email AS user_email
FROM bookings
JOIN events ON bookings.event_id = events.id
JOIN user ON bookings.user_id = user.id
ORDER BY bookings.created_at DESC
";
$result = mysqli_query($connection, $query);

// Check if there are any tickets available
if (mysqli_num_rows($result) === 0) {
    echo "<div class='alert alert-warning'>No tickets found.</div>";
    exit();
}

// Prepare data for the report
$ticket_details = [];
while ($row = mysqli_fetch_assoc($result)) {
    $ticket_details[] = $row;
}

// Close the database connection
mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content for all ticket report -->
<main class="main-content">
    <div class="container">
        <h1>All Ticket Details Report</h1>
        
        <!-- Ticket Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Booking Date</th>
                        <th>Ticket No</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ticket_details as $ticket): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ticket['ticket_id']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['user_email']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['event_date']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['ticket_number']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="manage_events.php" class="btn btn-primary">Back to Manage Events</a>
    </div>
</main>

<!-- Include footer -->
<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin-left: 250px; /* Space for the sidebar */
        transition: margin-left 0.3s;
        padding-bottom: 60px; /* Space between content and footer */
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2.5rem;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        font-size: 1rem;
        vertical-align: middle;
    }

    .table th {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
    }

    .table tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .btn-primary {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 20px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        margin-top: 20px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    /* Sidebar styling */
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #343a40;
        padding-top: 50px;
        z-index: 999;
    }

    #sidebar ul {
        list-style: none;
        padding: 0;
    }

    #sidebar ul li {
        padding: 15px;
        text-align: left;
    }

    #sidebar ul li a {
        color: #fff;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: background-color 0.3s;
    }

    #sidebar ul li a:hover {
        background-color: #007bff;
    }

    #sidebar .active {
        background-color: #007bff;
    }

    /* Sidebar toggle button */
    #sidebarToggle {
        display: none;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        body {
            margin-left: 0; /* Remove space for sidebar on small screens */
        }

        #sidebar {
            width: 100%;
            position: relative;
            height: auto;
        }

        #sidebar ul li {
            text-align: center;
        }

        .table th, .table td {
            padding: 8px;
            font-size: 0.9rem;
        }

        .container {
            padding: 20px;
        }
    }

    /* Footer Styling */
    footer {
        background-color: #343a40;
        color: white;
        padding: 20px;
        text-align: center;
        position: relative;
        bottom: 0;
        width: 100%;
        margin-top: 40px; /* Add space above the footer */
    }
</style>
