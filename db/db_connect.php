<?php
// Database configuration
define('DB_HOST', 'localhost:3307');       // Database host
define('DB_USER', 'root');   // Database username
define('DB_PASSWORD', ''); // Database password
define('DB_NAME', 'EVENTMANAGEMENT');   // Database name

// Connect to MySQL database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//echo "Connected successfully";

// Optionally, to close the connection at the end
// $connection->close();
?>
