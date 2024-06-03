<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_finder";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO job_applications (fullname,  age, gender, experience, resume, cover_letter, reason_for_applying,email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssss", $fullname,  $age, $gender, $experience, $resume, $cover_letter, $reason_for_applying,$email);

$fullname = $_POST['fullname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$experience = $_POST['experience'];
$cover_letter = $_POST['cover-letter']; 
$reason_for_applying = $_POST['reason-for-applying'];
$email = $_POST['email'];


if ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
    die("File upload failed with error code " . $_FILES['resume']['error']);
}


$target_file = $target_dir . basename($_FILES["resume"]["name"]);


if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
   
    $resume = $_FILES['resume']['name'];

    if ($stmt->execute()) {
      
        echo "<script>alert('Your application apply sucessfully');</script>";
        header("Location: ./job.html");
        exit;
    } else {
   
        echo "Error: " . $stmt->error;
        echo "<script>alert('Your application failed.');</script>"; // Fixed typo here
    }
} else {
   
    echo "Sorry, there was an error uploading your file.";
}


$stmt->close();
$conn->close();
?>


