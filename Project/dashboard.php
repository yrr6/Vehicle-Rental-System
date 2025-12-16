<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Vehicle Rental System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <div class="logo">
            <h3><a href="index.html">Vehicle Rental System</a></h3>
        </div>
        <div class="nav-links">
            <a href="explore.html">Explore Vehicles</a>
            <a href="booking.html">Book Now</a>
            <a href="services.html">Our Services</a>
            <a href="about.html">About</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="content" style="margin:50px;">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <p>Choose an option below to continue:</p>
        <div style="margin-top:30px;">
            <a href="explore.html" style="padding:15px 30px; background:yellow; color:black; text-decoration:none; margin-right:20px;">Explore Vehicles</a>
            <a href="booking.html" style="padding:15px 30px; background:yellow; color:black; text-decoration:none;">Book Now</a>
        </div>
    </div>

</body>
</html>
