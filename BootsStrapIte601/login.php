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

                echo "! Invalid password !";

            }

    }   else {

            echo "! User not found !";

        }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"  href="navbardesign.css">
    <link rel="stylesheet"  href="headerdesign.css">
    
    <?php include "header.php"?>
    <title>Login</title>

</head>

<body>

    <div class="header__menu">

        <?php include 'navbar.php'; ?>

    </div>

    <div class="loginbox">

        <div class="loginpic"></div>

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

        </div>
    </div>

</body>

</html>

<style>

    body {
        background-image:       url('img/rptr.png');
        background-size:        400px 400px;
        background-position:    center;
        font-family:            'Roboto', sans-serif;
    }

    .loginpic {
        background-image:       url('img/RiyoGudako.png'); 
        background-size:        cover;
        background-position:    top;
        height:                 100px; 
        width:                  100px;
        margin-bottom:          20px;
        border-radius:          100px;
    }

    label {
        font-family:            'Roboto', sans-serif; 
        font-size:              16px;  
        font-weight:            500; 
        color:                  white;
        margin-top:             10px;     
        margin-bottom:          8px; 
        display:                block;   
        text-align:             left;
    }

    .loginbox {
        background-color:       rgba(0, 0, 0, 0.7);
        color:                  white;
        padding:                40px;
        border-radius:          8px;
        width:                  100%;
        max-width:              400px;
        text-align:             center;
        box-shadow:             0 4px 8px rgba(0, 0, 0, 0.5);
        font-family:            'Roboto', sans-serif;
        margin:                 50px auto;
        display:                flex;
        flex-direction:         column; 
        align-items:            center; 
        justify-content:        center; 
    }

    input[type="text"], 
    input[type="password"] {
        width:                  80%; 
        padding:                12px;
        margin-bottom:          20px;
        background-color:       #333;
        border:                 1px solid #555;
        border-radius:          4px;
        color:                  white;
        font-size:              16px;
        text-align:             center; 
    }

    input[type="text"]:focus, 
    input[type="password"]:focus {
        outline:                none;
        border-color:           rgb(255, 255, 0);
    }

    button[type="submit"] {
        width:                  100px;
        padding:                12px;
        background-color:       rgb(255, 255, 0);
        color:                  black;
        border:                 none;
        border-radius:          15px;
        font-size:              16px;
        cursor:                 pointer;
</style>