<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('db/db_connect.php');
include('header.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure the sidebar and main content do not overlap */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 25%;
            background-color: #f8f9fa;
            padding-top: 20px;
            overflow-y: auto;
        }
        .main-content {
            margin-left: 25%;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
           <?php include('sidebar.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $query = "SELECT * FROM events WHERE book_status = 'Available'";
                $result = mysqli_query($connection, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<h3 class='mb-4'>Select an Event to Book</h3>";
                        echo "<form action='book_event.php' method='POST'>";
                        while ($event = mysqli_fetch_assoc($result)) {
                            echo "<div class='form-check mb-3'>";
                            echo "<input class='form-check-input' type='radio' name='event_id' value='" . $event['id'] . "' id='event_" . $event['id'] . "' required>";
                            echo "<label class='form-check-label' for='event_" . $event['id'] . "'>";
                            echo "<strong>" . htmlspecialchars($event['event_name']) . "</strong><br>";
                            echo "Date: " . htmlspecialchars($event['event_date']) . "<br>";
                            echo "Price: $" . htmlspecialchars($event['event_price']) . "<br>";
                            echo "</label>";
                            echo "</div>";
                        }
                        echo "<button type='submit' class='btn btn-primary'>Book Selected Event</button>";
                        echo "</form>";
                    } else {
                        echo "<p>No available events found.</p>";
                    }
                } else {
                    echo "<p>Error executing query: " . mysqli_error($connection) . "</p>";
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['event_id'])) {
                    $event_id = $_POST['event_id'];
                    $user_id = $_SESSION['user_id'];

                    $event_query = "SELECT * FROM events WHERE id = '$event_id' LIMIT 1";
                    $event_result = mysqli_query($connection, $event_query);

                    if ($event_result) {
                        $event = mysqli_fetch_assoc($event_result);

                        if ($event) {
                            if ($event['book_status'] === 'Booked') {
                                echo "<p>Sorry, this event is already booked.</p>";
                                exit();
                            }

                            $ticket_number = "TICKET-" . strtoupper(uniqid());
                            $update_event_query = "UPDATE events SET book_status = 'Booked' WHERE id = '$event_id'";
                            $update_event_result = mysqli_query($connection, $update_event_query);

                            if ($update_event_result) {
                                $booking_query = "INSERT INTO bookings (event_id, user_id, ticket_number) VALUES ('$event_id', '$user_id', '$ticket_number')";
                                $booking_result = mysqli_query($connection, $booking_query);

                                if ($booking_result) {
                                    // Booking confirmation section
                                    echo "<div id='printArea'>";
                                    echo "<h3>Booking Successful!</h3>";
                                    echo "<p>Your ticket number is: <strong>$ticket_number</strong></p>";
                                    echo "<p>Event: " . htmlspecialchars($event['event_name']) . "</p>";
                                    echo "<p>Event Date: " . htmlspecialchars($event['event_date']) . "</p>";
                                    echo "<p>Event Description: " . htmlspecialchars($event['event_description']) . "</p>";
                                    echo "<p>Event Price: $" . htmlspecialchars($event['event_price']) . "</p>";
                                    echo "<p>Status: Booked</p>";
                                    echo "</div>";
                                    echo '<button onclick="printConfirmation()" class="btn btn-secondary mb-4">Print Booking Confirmation</button>';
                                } else {
                                    echo "<p>Error booking the event. Please try again later. Error: " . mysqli_error($connection) . "</p>";
                                }
                            } else {
                                echo "<p>Error updating event status. Please try again later. Error: " . mysqli_error($connection) . "</p>";
                            }
                        } else {
                            echo "<p>Event not found!</p>";
                        }
                    } else {
                        echo "<p>Error fetching event details: " . mysqli_error($connection) . "</p>";
                    }
                } else {
                    echo "<p>No event selected!</p>";
                }
            }
            mysqli_close($connection);
            ?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>


<!-- JavaScript to print the booking confirmation -->
<script>
    function printConfirmation() {
        var printContents = document.getElementById("printArea").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
