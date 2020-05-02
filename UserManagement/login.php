<?php
    //Start en session til oprettelse af session variabler
    session_start();
    
    //Send til menuen, hvis en bruger allerede er logget ind. 
    if (isset($_SESSION['id'])) {
        header('location: menu.php');
    }
    
    //Variable til at gemme brugernavnet i tilfælde af, at koden er forkert. 
    $username = "";

    //Checker om brugeren har klikket på login knappen
    if (isset($_POST['login-btn'])) {
        //Opret database forbindelse
        $conn = new mysqli('localhost', 'root', '', 'programmering');

        //Hent brugernavn og password fra input-felter og sikre mod sql angreb ved at fjerne speciele tegn og tage højde for serverens charset
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    
        //Finder bruger ved hjælp af id
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $conn->query($sql);
   
        if($result){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    //Checker om adgangskoderne matcher
                    if (password_verify($password, $row['password'])) {
                        //Opretter session variabler med id og brugernavn
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        
                        //Lukker databaseforbindelse
                        $conn->close();

                        //Viderstiller til menuen
                        header('location: menu.php');
                        exit(0);
                    } 
                    else {
                        //Fejlbesked hvis adgangskoden ikke passer
                        echo "<script type='text/javascript'>alert('Password does not match');</script>";
                    }
                }
            }
            else{
                //Fejlbesked hvis brugernavnet ikke passer
                echo "<script type='text/javascript'>alert('Username is invalid');</script>"; 
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
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="login.php" method="post" class="login">
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