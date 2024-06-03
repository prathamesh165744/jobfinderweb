<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];

   
    $conn = new mysqli("localhost", "root", "", "job_finder");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $updateStmt->bind_param("ss", $hashedNewPassword, $username);
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        echo '<script>alert("Password updated successfully.");</script>';
        echo '<script>window.location.href = "login.html";</script>';
        exit; 
    } else {
        echo "Failed to update password. User not found.";
    }

    $updateStmt->close();
    $conn->close();
}
?>
