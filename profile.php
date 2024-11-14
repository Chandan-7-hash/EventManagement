<?php
session_start();
include('db/db_connect.php'); // Database connection file

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT username, email, created_at FROM user WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>User not found.</div>";
    exit();
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            max-width: 600px;
            margin: auto;
            margin-top: 5%;
        }
        .profile-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .btn-custom {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="profile-card card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h5 class="card-title">Username</h5>
                <p class="card-text"><?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <div class="mb-3">
                <h5 class="card-title">Email</h5>
                <p class="card-text"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="mb-3">
                <h5 class="card-title">Account Created</h5>
                <p class="card-text"><?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>
            <div class="text-center">
                <a href="edit_profile.php" class="btn btn-primary btn-custom">Edit Profile</a>
                <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
                <a href="index.php" class="btn btn-secondary btn-custom">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
