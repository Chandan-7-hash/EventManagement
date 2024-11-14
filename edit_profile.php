<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}


// Get the current user's ID
$user_id = $_SESSION['id'];

// Fetch the current user details from the database
$query = "SELECT name, email FROM user WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);

// If the form is submitted, update the user's profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize it
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // Check if passwords match (if password is changed)
    if (!empty($password) && $password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // If password is provided, hash it
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_query = "UPDATE user SET name = '$name', email = '$email', password = '$hashed_password' WHERE id = '$user_id'";
        } else {
            // If no password is provided, just update name and email
            $update_query = "UPDATE user SET name = '$name', email = '$email' WHERE id = '$user_id'";
        }

        // Update the user details in the database
        if (mysqli_query($connection, $update_query)) {
            $success_message = "Profile updated successfully!";
            // Refresh the session data
            $_SESSION['name'] = $name;
        } else {
            $error = "Error updating profile. Please try again.";
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<main class="main-content">
    <div class="container">
        <h1>Edit Profile</h1>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>

        <!-- Profile Edit Form -->
        <form method="POST" action="edit_profile.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">New Password (Leave empty if not changing)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</main>

<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin-left: 250px;
        transition: margin-left 0.3s;
        padding-bottom: 60px;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2.5rem;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 5px;
        text-align: center;
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

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
</style>
