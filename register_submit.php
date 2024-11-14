<?php
// Include database connection
include 'db/db_connect.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $role = mysqli_real_escape_string($connection, $_POST['role']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        die("Error: Passwords do not match.");
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert user into the USER table
    $sql = "INSERT INTO USER (role, name, email, username, phone, password) 
            VALUES ('$role', '$name', '$email', '$username', '$phone', '$hashedPassword')";

    // Execute the query and check if it was successful
    if (mysqli_query($connection, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Redirect to the registration form if not accessed via POST
    header("Location: register.html");
    exit();
}
?>
