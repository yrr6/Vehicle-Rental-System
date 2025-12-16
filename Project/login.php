<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, name FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $name);
    $stmt->fetch();

    if ($stmt->num_rows == 1 && password_verify($password, $hashed_password)) {
        // Set session
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<h2>Login Failed!</h2>";
        echo "<p>Invalid Email or Password</p>";
        echo "<a href='index.html'>Try Again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
