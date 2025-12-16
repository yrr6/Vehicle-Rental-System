<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        echo "<h2>Password Reset Link Sent!</h2>";
        echo "<p>A link to reset your password has been sent to $email (demo).</p>";
        echo "<a href='index.html'>Back to Home</a>";
    } else {
        echo "<h2>Email Not Found!</h2>";
        echo "<a href='forgot_password.html'>Try Again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
