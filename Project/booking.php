<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<h2>You must be logged in to book!</h2>";
    echo "<a href='index.html'>Login</a>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $vehicle_type = $_POST['vehicle_type'];
    $vehicle_name = $_POST['vehicle_name'];
    $pickup_date = $_POST['pickup_date'];
    $dropoff_date = $_POST['dropoff_date'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, vehicle_type, vehicle_name, pickup_date, dropoff_date, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $vehicle_type, $vehicle_name, $pickup_date, $dropoff_date, $location);

    if ($stmt->execute()) {
        echo "<h2>Booking Successful!</h2>";
        echo "<p>Vehicle: $vehicle_name ($vehicle_type)</p>";
        echo "<p>Pick-up: $pickup_date | Drop-off: $dropoff_date</p>";
        echo "<p>Location: $location</p>";
        echo "<a href='index.html'>Go to Home</a>";
    } else {
        echo "<h2>Booking Failed!</h2>";
        echo "<a href='booking.html'>Try Again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
