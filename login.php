<?php 
    session_start();
    $username = "";
 
    $conn = new mysqli('localhost', 'root', '', 'programmering');

    if (isset($_POST['login-btn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $conn->query($sql);
   
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $conn->close();
                        header('location: menu.php');
                        exit(0);
                    } 
                    else {
                        echo "<script type='text/javascript'>alert('Password does not match');</script>";
                    }
                }
            }
        else{
            echo "<script type='text/javascript'>alert('Username is invalid');</script>"; 
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            height: 30%;
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
            font-size: 1.4em;
            padding: 0px 6px;
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

    </style>
</head>
<body>
    <form action="login.php" method="post">
        <div class="box">
            <label>Username</label>
            <input type="text" required="required" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="box">
            <label>Password</label>
            <input type="password" required="required" name="password">
        </div>
        <button id="signup" type="submit" name="login-btn">Login</button>
    </form>
</body>
</html>