<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Check if a user ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage_users.php"); // Redirect to manage users if no user ID
    exit();
}

$user_id = $_GET['id'];

// Fetch user details based on the provided user ID
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "User not found!";
    exit();
}

$user = mysqli_fetch_assoc($result);

// Update user details on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_query = "UPDATE users SET name = '$name', email = '$email', role = '$role' WHERE id = $user_id";
    if (mysqli_query($connection, $update_query)) {
        header("Location: manage_users.php?success=User updated successfully!");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content for editing user -->
<main class="main-content">
    <div class="container">
        <h1>Edit User</h1>

        <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="Admin" <?php if ($user['role'] === 'Admin') echo 'selected'; ?>>Admin</option>
                    <option value="User" <?php if ($user['role'] === 'User') echo 'selected'; ?>>User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
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
