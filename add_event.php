<?php
session_start();
include('db/db_connect.php');  // Include the database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html");  // Redirect to login if not logged in as Admin
    exit();
}

// Initialize variables for form data and errors
$event_name = $event_description = $event_date =$event_location=$event_price = $book_status = $event_image = "";
$errors = [];

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $event_name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($connection, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($connection, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($connection, $_POST['event_location']);
    $event_price = mysqli_real_escape_string($connection, $_POST['event_price']);
    $book_status = mysqli_real_escape_string($connection, $_POST['book_status']);

    // Validate form data
    if (empty($event_name)) $errors[] = "Event name is required.";
    if (empty($event_description)) $errors[] = "Event description is required.";
    if (empty($event_date)) $errors[] = "Event date is required.";
    if (empty($event_location)) $errors[] = "Event location is required.";
    if (empty($event_price)) $errors[] = "Event price is required.";
    if (empty($book_status)) $errors[] = "Booking status is required.";

    // Handle image upload
    if ($_FILES['event_image']['name']) {
        $target_dir = "uploads/";  // Directory for image uploads
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);  // Create with permissions
        }
        
        $target_file = $target_dir . basename($_FILES['event_image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($_FILES['event_image']['tmp_name']);
        if (!$check) $errors[] = "File is not an image.";

        // Allow only certain formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $errors[] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Move file to target directory if no errors
        if (empty($errors) && move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
            $event_image = $target_file;  // Set the image path
        } else {
            $errors[] = "Failed to upload image.";
        }
    }

    // If there are no errors, insert event into the database
    if (empty($errors)) {
        // SQL query to insert the event, including the image path
        $query = "INSERT INTO events (event_name, event_description, event_date, event_location,event_price, book_status, event_image) 
                  VALUES ('$event_name', '$event_description', '$event_date','$event_location', '$event_price', '$book_status', '$event_image')";
        
        if (mysqli_query($connection, $query)) {
            header("Location: view_events.php?success=Event added successfully.");
            exit();
        } else {
            $errors[] = "Error adding event: " . mysqli_error($connection);
        }
    }
}
?>

<!-- Include header and sidebar -->
<?php include('admin/header.php'); ?>
<?php include('admin/sidebar.php'); ?>

<!-- Main content -->
<main class="main-content">
    <div class="container">
        <h1>Add New Event</h1>

        <!-- Display errors -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Event Form with Image Upload -->
        <form action="add_event.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" name="event_name" id="event_name" class="form-control" value="<?php echo $event_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea name="event_description" id="event_description" class="form-control" required><?php echo $event_description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control" value="<?php echo $event_date; ?>" required>
            </div>

            <div class="form-group">
                <label for="event_location">Event Location</label>
                <input type="text" name="event_location" id="event_location" class="form-control" value="<?php echo $event_location; ?>" required>
            </div>
            <div class="form-group">
                <label for="event_price">Event Price</label>
                <input type="number" name="event_price" id="event_price" class="form-control" value="<?php echo $event_price; ?>" required>
            </div>

            <div class="form-group">
                <label for="book_status">Booking Status</label>
                <select name="book_status" id="book_status" class="form-control" required>
                    <option value="Available" <?php echo ($book_status == 'Available') ? 'selected' : ''; ?>>Available</option>
                    <option value="Booked" <?php echo ($book_status == 'Booked') ? 'selected' : ''; ?>>Booked</option>
                </select>
            </div>

            <div class="form-group">
                <label for="event_image">Event Image</label>
                <input type="file" name="event_image" id="event_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>
    </div>
</main>

<!-- Include footer -->
<?php include('admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    /* Ensure header and footer don't overlap main content */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    
    .main-content {
        flex: 1;
        margin-left: 270px; /* Assuming sidebar width */
        padding: 30px;
        padding-top: 120px; /* Add top padding to avoid header overlap */
        box-sizing: border-box;
        margin-bottom: 50px; /* Space below main content */

    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #f9f9f9; /* Light background to make the form stand out */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .alert {
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #e74c3c;
        color: white;
        padding: 15px;
        border-radius: 5px;
    }
</style>
