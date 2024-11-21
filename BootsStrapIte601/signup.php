<?php

include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username   = $_POST['username'];
    $age        = $_POST['age'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO users (username, age, password) VALUES ('$username', '$age', '$password')";

    if ($conn->query($sql) === TRUE) {

        echo "Registration successful!";

    }   else {

            echo "Error: " . $sql . "<br>" . $conn->error;

        }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="navstyle.css">
    <title>Sign Up</title>

</head>

<body>

    <div class="header__menu">

        <?php include 'navbar.php'; ?>
        
    </div>

    <form method="POST" action="signup.php">

        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="age">Age: </label>
        <input type="number" id="age" name="age" required>
        <br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Sign Up</button>

    </form>

</body>

</html>
