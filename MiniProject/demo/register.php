<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_finder"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieving user data from the form
$name = $_POST['name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$number = $_POST['number'];
$email = $_POST['email'];
$address = $_POST['address'];

// Validating OTP
$otp_from_user = $_POST['otp'];
$stored_otp = $_SESSION['otp'];

if($otp_from_user != $stored_otp) {
    echo "Invalid OTP. Please enter the correct OTP.";
    exit;
}

// If OTP is valid, continue with registration process (inserting into database, etc.)
// Your database insertion code goes here

// For demonstration, let's just echo the user data
echo "Registration successful!<br>";
echo "Name: $name<br>";
echo "Username: $username<br>";
echo "Number: $number<br>";
echo "Email: $email<br>";
echo "Address: $address<br>";

// Unset the session variable for OTP once registration is completed
unset($_SESSION['otp']);
?>
