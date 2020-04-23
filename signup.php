<?php
    session_start();

    if (isset($_SESSION['id'])) {
        header('location: menu.php');
    }

    $username = "";
    $error = false;
    
    $conn = new mysqli('localhost', 'root', '', 'programmering');

    if (isset($_POST['signup-btn'])) {
        if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
            echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
        }
        else{
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Krypter adgangskoden

            // check om der allerede er en bruger med samme brugernavn
            $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<script type='text/javascript'>alert('Email already exists');</script>";
            }else{
                $sql = "INSERT INTO users (username,password) VALUES ('$username', '$password')";
                $result = $conn->query($sql);
                
                $user_id = $conn->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                $conn->close();
                header('location: menu.php');
                exit(0);
            }
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        * {
			box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
		}
		body {
			margin: 0;
            background-color: darkslategrey;
		}
        form {
            background-color: lightskyblue;
            position: absolute;
            right: 20%;
            left: 20%;
            top:25%;
            bottom: 25%;
            padding: 25px;
            border-radius: 25px;
        }
        .box {
            float:none;
            height: 20%;
        }
        .box label {
            color:white;
            font-size: 2em;
        }
        .box input{
            background-color: slategray;
            border:2px solid darkslategray;
            width: 100%;
            height: 40px;
            color: white;
            padding: 0px 6px;
            font-size: 1.4em;
        }
        #signup {
            height:40px;
            width: 100%;
            text-align:center;
            background-color: #4CAF50;
            border:2px solid darkslategray;
            color: white;
            font-size:1.5em;
        }
        #signin{
            bottom: 0;
            color:white;
            font-size: 1.5em;
        }    
    </style>
</head>
<body>
    <form action="signup.php" method="post">
        <div class="box">
            <label>Username</label>
            <br>
            <input type="text" required="required" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="box">
            <label>Password</label>
            <br>
            <input type="password" required="required" name="password">
        </div>
        <div class="box">
            <label>Password</label>
            <br>
            <input type="password" required="required" name="passwordConf">
        </div>
        
        <button id="signup" type="submit" required="required" name="signup-btn">Sign Up</button>
        <p id="signin">Already have an account? <a href="login.php">Login</a></p>
        
    </form>
</body>
</html>