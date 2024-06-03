<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "demo_registration"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert user data into the database
function insertUserData($name, $username, $password, $number, $email, $address) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (name, username, password, number, email, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $username, $password, $number, $email, $address);

    if ($stmt->execute()) {
        return true; // Insertion successful
    } else {
        return false; // Insertion failed
    }

    $stmt->close();
}

// Close database connection
function closeDBConnection() {
    global $conn;
    $conn->close();
}
?>
