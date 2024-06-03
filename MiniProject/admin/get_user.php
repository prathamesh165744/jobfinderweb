<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_finder";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = array(
            'name' => $row['name'],
            'email' => $row['email']
        );
    }
}

echo json_encode($users);

$conn->close();
?>
