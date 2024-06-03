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

function decryptPassword($encrypted_password) {
    return $encrypted_password; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];

    $delete_sql = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($delete_sql) === TRUE) {
      
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Manage Users</title>
    <style> .table-container {
            max-height: 400px; 
            overflow: auto;
        }
        .log_out{
            background: red;
    float: right;
    border: none;
    border-radius: 30px;
    margin: 0px 6px 3px 3px;
    padding: 7px 12px 7px 15px;


        }
        .log_out a{
            text-decoration:none;
            color:white;
        }
        </style>
    <link rel="stylesheet" href="hoad.css">
    <script>
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                
                var form = document.createElement("form");
                form.method = "post";
                form.action = "<?php echo $_SERVER['PHP_SELF']; ?>";
                
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "delete_user";
                input.value = userId;
               
                form.appendChild(input);
                
                document.body.appendChild(form);
                
                form.submit();
            }
        }
    </script>
</head>
<body>
    <div>
        <button class="log_out"><a href="../login.html">logout</a></button>
    </div>
    <div class="container">
        <h1>Admin Page - Manage Users</h1>
        <div class="button-container">
            <button class="add-btn" onclick="location.href='add_user.php';">Add New User</button>
        </div>
        <div class="table-container"> 
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
        </div>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . decryptPassword($row["password"]) . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td><button class='delete-btn' onclick='deleteUser(" . $row["id"] . ")'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
