<?php
session_start();

// Redirect to login page if not logged in or not a 'User'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'User') {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Roboto', sans-serif; }
        
        body {
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 { text-align: center; color: #4CAF50; margin-bottom: 1rem; }
        .sidebar ul { list-style-type: none; }
        .sidebar ul li { padding: 15px; }
        .sidebar ul li a {
            color: #ddd;
            text-decoration: none;
            display: block;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .sidebar ul li a:hover { background-color: #4CAF50; color: #fff; }
        .sidebar ul li a i { margin-right: 10px; }

        /* Header */
        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 500;
            margin-left: 250px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Dashboard content */
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .content h2 { color: #333; margin-bottom: 15px; }
        .content p { font-size: 1.1rem; color: #666; line-height: 1.6; }

        /* Carousel */
        .carousel-container img {
            width: 100%;  
            max-width: 250px; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .carousel-slide img {
            width: 100%;
            transition: transform 0.5s ease-in-out;
        }
        
        /* Events section */
        .events-list {
            margin-top: 20px;
        }
        .events-list h3 {
            color: #4CAF50;
            font-size: 1.4rem;
            margin-bottom: 10px;
        }
        .event-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border-left: 4px solid #4CAF50;
        }
        .event-item p {
            font-size: 1rem;
            color: #555;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            margin-top: auto;
            font-size: 0.9rem;
            margin-left: 250px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include('sidebar.php'); ?>
    </div>

    <!-- Header -->
    <div class="header">
        Welcome, <?php echo $_SESSION['username']; ?>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Carousel section -->

        <?php
include('db/db_connect.php');
$sql = "SELECT event_image FROM events where book_status='Available'   "; // Replace 'events' with your table name
        $result = $connection->query($sql);
        
        $images = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['event_image']; // Add each image path to the images array
            }
        }
        
        
        ?>

        <!-- Dashboard information section -->
        <div class="content">
            <h2>Dashboard Overview</h2>
            <p>Welcome to your dashboard, <?php echo $_SESSION['username']; ?>! Here you can view your booked events, manage settings, and much more.</p>
        </div>

        <!-- Booked Events Section -->
        <div class="content events-list">
            <h3>Your Booked Events</h3>
            <div class="event-item">
                <p><strong>Event Name:</strong> Music Concert</p>
                <p><strong>Date:</strong> 15th December 2024</p>
                <p><strong>Location:</strong> Grand Arena</p>
            </div>
            <div class="event-item">
                <p><strong>Event Name:</strong> Art Exhibition</p>
                <p><strong>Date:</strong> 20th December 2024</p>
                <p><strong>Location:</strong> Downtown Gallery</p>
            </div>
            <!-- Additional booked events can be added here -->
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; <?php echo date("Y"); ?> Your Company Name. All rights reserved.
    </div>

    <script>
        // Carousel effect
        const carouselSlide = document.querySelector('.carousel-slide');
        const images = document.querySelectorAll('.carousel-slide img');

        let counter = 0;
        setInterval(() => {
            counter = (counter + 1) % images.length; //the counter never exceeds the number of images. 
            carouselSlide.style.transform = `translateX(-${counter * 100}%)`; //left
        }, 3000); // Change every 3 seconds
    </script>
</body>
</html>
