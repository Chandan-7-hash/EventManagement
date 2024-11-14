<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Check if an event ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage_events.php"); // Redirect if no event ID
    exit();
}

$event_id = mysqli_real_escape_string($connection, $_GET['id']);

// Fetch event details based on the provided event ID
$query = "SELECT * FROM events WHERE id = '$event_id'";
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Event not found!";
    exit();
}

$event = mysqli_fetch_assoc($result);

// Update event details on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($connection, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($connection, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($connection, $_POST['event_location']);
    $event_price = mysqli_real_escape_string($connection, $_POST['event_price']);
    $book_status = mysqli_real_escape_string($connection, $_POST['book_status']);

    $update_query = "UPDATE events SET 
                        event_name='$event_name', 
                        event_description='$event_description', 
                        event_date='$event_date', 
                        event_location='$event_location', 
                        event_price='$event_price', 
                        book_status='$book_status' 
                    WHERE id='$event_id'";

    if (mysqli_query($connection, $update_query)) {
        header("Location: manage_events.php?success=Event updated successfully!");
        exit();
    } else {
        echo "Error updating event: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content for editing event -->
<main class="main-content">
    <div class="container">
        <h1>Edit Event</h1>

        <form action="edit_event.php?id=<?php echo $event_id; ?>" method="POST">
            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" id="event_name" name="event_name" class="form-control" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea id="event_description" name="event_description" class="form-control" rows="4" required><?php echo htmlspecialchars($event['event_description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" class="form-control" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_location">Event Location</label>
                <input type="text" id="event_location" name="event_location" class="form-control" value="<?php echo htmlspecialchars($event['event_location']); ?>" required>
            </div>

            <div class="form-group">
                <label for="event_price">Event Price</label>
                <input type="number" id="event_price" name="event_price" class="form-control" value="<?php echo htmlspecialchars($event['event_price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="book_status">Booking Status</label>
                <select id="book_status" name="book_status" class="form-control" required>
                    <option value="Open" <?php if ($event['book_status'] === 'Open') echo 'selected'; ?>>Open</option>
                    <option value="Closed" <?php if ($event['book_status'] === 'Closed') echo 'selected'; ?>>Closed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="manage_events.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>

<!-- Include footer -->
<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px;
    }

    h1 {
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #bbb;
    }
</style>
