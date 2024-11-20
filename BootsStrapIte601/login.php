<?php

include 'db.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

         $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['username'] = $username;
            $_SESSION['age'] = $user['age'];
            header("Location: index.php");
            exit();

        }   else {

                echo "Invalid password!";

            }

    }   else {

            echo "User not found!";

        }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>

<body>

    <form method="POST" action="login.php">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>  
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Login</button>

    </form>

    <p>Don't have an account yet? <a href="signup.php">Sign up</a></p>

</body>

</html>

