<?php
// Start output buffering and session
ob_start();
session_start();

// Include the database connection file
require_once 'db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape special characters to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];
    
    // Query to check if the user exists
    $query = "SELECT * FROM USER WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login: set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect based on user role
            if ($user['role'] === 'Admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else if ($user['role'] === 'User') {
                header("Location: user_dashboard.php");
                exit();
            } else {
                echo "Invalid role specified.";
            }
        } else {
            // Invalid password
            echo "Invalid username or password.";
        }
    } else {
        // Username not found
        echo "Invalid username or password.";
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($connection);
ob_end_flush();
?>
