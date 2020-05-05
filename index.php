<?php
    //Start en session til oprettelse af session variabler
    session_start();

    //Send til menu, hvis en bruger er logget ind. 
    if (isset($_SESSION['id'])) {
        header('location: /UserManagement/menu.php');
    }

?>
<!DOCTYPE html>
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
        <a href="UserManagement/signup.php">Sign Up</a>
		<a href="UserManagement/login.php">Sign In</a>
	</div>
</body>
</html>