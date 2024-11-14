<?php
session_start();
include('db/db_connect.php'); // Include the database connection

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.html"); // Redirect to login if not logged in as Admin
    exit();
}

// Fetch all users
$query = "SELECT id, name, email, role FROM user";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error fetching users: " . mysqli_error($connection));
}
?>

<!-- Include header -->
<?php include('Admin/header.php'); ?>

<!-- Flex container for sidebar and main content -->
<div class="dashboard-container">
    <?php include('Admin/sidebar.php'); ?>

    <!-- Main content for managing users -->
    <main class="main-content">
        <div class="container">
            <h1>Manage Users</h1>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <a href="view_user.php?id=<?php echo $user['id']; ?>" class="btn btn-info">View</a>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Include footer -->
<?php include('Admin/footer.php'); ?>

<!-- Custom Styling -->
<style>
    /* Universal box-sizing rule */
    * {
        box-sizing: border-box;
    }

    /* Flex container for sidebar and main content */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    /* Sidebar styling */
    .sidebar {
        width: 250px; /* Set a fixed width for sidebar */
        background-color: #333;
        color: #fff;
        padding: 15px;
        position: fixed;
        height: 100vh;
    }

    /* Main content styling */
    .main-content {
        margin-left: 250px; /* Matches the width of the sidebar */
        padding: 20px;
        flex-grow: 1;
        background-color: #f9f9f9;
    }

    /* Table and buttons styling */
    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
    }

    .btn-info { background-color: #3498db; }
    .btn-warning { background-color: #f39c12; }
    .btn-danger { background-color: #e74c3c; }

    .btn-info:hover { background-color: #2980b9; }
    .btn-warning:hover { background-color: #e67e22; }
    .btn-danger:hover { background-color: #c0392b; }
</style>

<?php mysqli_close($connection); ?>
