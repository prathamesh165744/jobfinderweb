<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "job_finder";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("SELECT password FROM admin_log WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

  
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $row['password'];

        if (password_verify($password, $hashedPasswordFromDatabase)) {
         
            $_SESSION['loggedin'] = true;
  
            header('Location: homeadmin.php');
            exit;
        } else {

            header('Location: admin.html?error=1');
            exit;
        }
    } else {

        header('Location: admin.html?error=1');
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
