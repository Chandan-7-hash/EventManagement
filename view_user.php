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
?>

<!-- Include header and sidebar -->
<?php include('Admin/header.php'); ?>
<?php include('Admin/sidebar.php'); ?>

<!-- Main content for viewing user details -->
<main class="main-content">
    <div class="container">
        <h1>View User</h1>
        
        <div class="user-details">
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        </div>

        <a href="manage_users.php" class="btn btn-secondary">Back to Users</a>
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
        margin-bottom: 20px;
    }

    .user-details p {
        font-size: 16px;
        margin: 8px 0;
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

<?php mysqli_close($connection); ?>
