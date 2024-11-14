<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page or show error if the user is not an admin
    header("Location: login.html");
    exit();
}

// Fetch all users
$query_users = "SELECT id, name, email FROM user";
$result_users = mysqli_query($connection, $query_users);
$users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);

// Fetch all events
$query_events = "SELECT id, event_name FROM events";
$result_events = mysqli_query($connection, $query_events);
$events = mysqli_fetch_all($result_events, MYSQLI_ASSOC);

// Handle notification sending
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $message = $_POST['message'];

    // Check if the user and event IDs are valid
    if ($user_id && $event_id && $message) {
        // Fetch the user's email
        $query_user_email = "SELECT email FROM user WHERE id = $user_id";
        $result_user_email = mysqli_query($connection, $query_user_email);
        $user_email = mysqli_fetch_assoc($result_user_email)['email'];

        // Send notification (email for example)
        $subject = "Notification for Event";
        $body = "You have a new notification for the event: " . $events[array_search($event_id, array_column($events, 'id'))]['event_name'] . "\nMessage: " . $message;
        $headers = "From: admin@example.com";

        if (mail($user_email, $subject, $body, $headers)) {
            echo "<script>alert('Notification sent successfully!');</script>";
        } else {
            echo "<script>alert('Failed to send notification.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}

mysqli_close($connection);
?>

<!-- Include header and sidebar -->

<!-- Main content for the dashboard -->
<main class="main-content">
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Dashboard</h1>

        <?php if ($_SESSION['role'] === 'admin'): ?>
        <!-- Form to select user and event for sending notification -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Send Notification</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="">--Select User--</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']) . ' (' . htmlspecialchars($user['email']) . ')'; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="event_id" class="form-label">Select Event</label>
                                <select name="event_id" id="event_id" class="form-select" required>
                                    <option value="">--Select Event--</option>
                                    <?php foreach ($events as $event): ?>
                                        <option value="<?php echo $event['id']; ?>"><?php echo htmlspecialchars($event['event_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center">
            You do not have permission to send notifications. Only admins can do this.
        </div>
        <?php endif; ?>

        <!-- Display the list of users -->
        <div class="mt-5">
            <h2 class="text-center text-primary mb-3">Registered Users</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <a href="view_user.php?id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Display the list of events -->
        <div class="mt-5">
            <h2 class="text-center text-primary mb-3">All Events</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                            <td>
                                <a href="view_event.php?id=<?php echo $event['id']; ?>" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Include footer -->

<!-- Bootstrap 5 CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Styling -->
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .table {
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
    }
</style>
