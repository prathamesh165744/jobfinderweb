<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <div class="container">
        <h1>Add New User</h1>
        <form action="insert_user.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="number">Number</label>
            <input type="text" id="number" name="number" maxlength="10" pattern="[0-9]{10}" title="Please enter a 10-digit number" required>


            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <input type="submit" value="Add User">
        </form>
    </div>
</body>
<script>
    document.getElementById("number").addEventListener("input", function() {
        var inputValue = this.value.replace(/\D/g, ''); 
        if (inputValue.length > 10) {
            this.value = inputValue.slice(0, 10); 
        }
    });
</script>

</html>
