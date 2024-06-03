<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_finder";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
$number = $_POST['number'];
$email = $_POST['email'];
$address = $_POST['address'];

$stmt = $conn->prepare("INSERT INTO users (name, username, password, number, email, address) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $username, $password, $number, $email, $address);

if ($stmt->execute()) {
    // Success: Redirect to homeadmin.php with an alert message
    echo "<script>alert('User added successfully'); window.location.href = 'homeadmin.php';</script>";
} else {
    // Error handling
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
