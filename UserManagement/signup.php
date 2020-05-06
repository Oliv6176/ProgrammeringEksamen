<?php
    //Start en session til oprettelse af session variabler
    session_start();

    //Send til menuen, hvis en bruger allerede er logget ind. 
    if (isset($_SESSION['id'])) {
        header('location: menu.php');
        exit(0);
    }

    //Variable til at gemme brugernavnet i tilfælde af, at koden er forkert. 
    $username = "";

    //Checker om brugeren har klikket på opret knappen
    if (isset($_POST['signup-btn'])) {
        //Opret database forbindelse
        $conn = new mysqli('localhost', 'root', '', 'programmering');

        //Hent brugernavn fra input-feltet "username" og sikre mod sql angreb ved at fjerne speciele tegn og tage højde for serverens charset
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        //Checker om brugeren har skrevet samme adgangskode i de to input-felter
        if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConfirm']) {
            echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
        }
        else{
            //Krypterer adgangskoden
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            //Checker om der allerede er en bruger med samme brugernavn
            $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<script type='text/javascript'>alert('Username already exists');</script>";
            }
            else{
                //Opretter brugeren i databasen
                $sql = "INSERT INTO users (username,password) VALUES ('$username', '$password')";
                $result = $conn->query($sql);
                $user_id = $conn->insert_id;
                $conn->close();

                //Opretter session variabler med id og brugernavn
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                
                //Viderstiller til menuen
                header('location: menu.php');
                exit(0);
            }
        }
        $conn->close();  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="signup.php" method="post" class="signup">
        <div class="box">
            <label>Username</label>
            <br>
            <input type="text" required="required" name="username" maxlength="100" value="<?php echo $username; ?>">
        </div>
        <div class="box">
            <label>Password</label>
            <br>
            <input type="password" maxlength="20" required="required" name="password">
        </div>
        <div class="box">
            <label>Password</label>
            <br>
            <input type="password" maxlength="20" required="required" name="passwordConfirm">
        </div>
        
        <button id="signup" type="submit" required="required" name="signup-btn">Sign Up</button>
        <p id="signin">Already have an account? <a href="login.php">Login</a></p>
        
    </form>
</body>
</html>