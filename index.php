<?php
    //Start en session til oprettelse af session variabler
    session_start();

    //Send til menu, hvis en bruger er logget ind. 
    if (isset($_SESSION['id'])) {
        header('location: UserManagement/menu.php');
        exit(0);
    }

    if (isset($_POST['view-btn'])) {
        
        //Set session variable
        $_SESSION["view_id"] = $_POST["view-i"];

        //Viderestil til view.php
        header('location: view.php');
        exit(0);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spillebræt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, design your DnD board now!</h1>
    </div>
    <div class="topnav">
        <form action="index.php" method="post" style="float:left;">
            <input style="width: 300px;"type="text" required="required" name="view-i" placeholder="Board ID" value="">
            <button id="view" type="submit" name="view-btn">View</button>
        </form>
        <a href="UserManagement/signup.php">Sign Up</a>
        <a href="UserManagement/login.php">Sign In</a>
    </div>
</body>
</html>