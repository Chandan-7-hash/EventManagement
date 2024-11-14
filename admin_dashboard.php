<?php
session_start();

// Redirect to login page if user is not logged in or not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Include Sidebar -->
    <?php include 'Admin/sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Include Header -->
        <?php include 'Admin/header.php'; ?>

        <div class="content">
            <h2>Admin Dashboard</h2>
            <p>Welcome to the admin panel, <?php echo $_SESSION['username']; ?>! Here you can manage users, products, and view site statistics.</p>
            <!-- Example Content -->
            <div class="stats">
                <div class="stat-box">
                    <h3>Total Users</h3>
                    <p>100</p>
                </div>
                <div class="stat-box">
                    <h3>Total Events</h3>
                    <p>50</p>
                </div>
            </div>
        </div>

        <!-- Include Footer -->
        <?php include 'Admin/footer.php'; ?>
    </div>

    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 80px; /* To account for the fixed header */
            box-sizing: border-box;
        }

        .content {
            background-color: #ECF0F1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .stat-box {
            background-color: #3498DB;
            padding: 20px;
            color: white;
            border-radius: 8px;
            width: 200px;
            text-align: center;
        }

        .stat-box h3 {
            margin: 0;
            font-size: 18px;
        }

        .stat-box p {
            font-size: 24px;
            margin-top: 10px;
        }
    </style>
</body>
</html>
