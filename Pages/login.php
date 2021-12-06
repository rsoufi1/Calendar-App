<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Project Login Page</title>
        <link rel="stylesheet" href="../CSS/login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="../jquery-3.6.0.js"></script>
        <script src="../JavaScript/login.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="LoginPage">
            <div class="LoginBox">
                <div>Welcome Back</div>
                <form id="loginForm">
                    <input type="text" placeholder="Username" id="username">
                    <input type="text" placeholder="Password" id="password">
                    <button id="login">Login</button>
                </form>
            </div>
        </div>
        <button id="createNewAccount">Create New Account</button>
        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>
    </body>
</html>