<?php
$conn = new mysqli("localhost", "root", "", "vehicle_rental_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Database Connected Successfully!";
?>
