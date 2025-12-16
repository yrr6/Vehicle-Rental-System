<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<h2>Password Mismatch!</h2>";
        echo "<a href='register.html'>Go Back</a>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<h2>Email already registered!</h2>";
        echo "<a href='register.html'>Try Again</a>";
        exit();
    }

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "<h2>Account Created Successfully!</h2>";
        echo "<a href='index.html'>Go to Home</a>";
    } else {
        echo "<h2>Something went wrong!</h2>";
        echo "<a href='register.html'>Try Again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
