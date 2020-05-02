<?php
    //Start en session til oprettelse af session variabler
    session_start();

    //Send til log ind siden, hvis brugeren ikke er logget ind eller der ikke er et brætspils id
	if (empty($_SESSION['id']) OR empty($_SESSION['board_id'])) {
		header('location: ../ProgrammeringEksamen/usermanagement/login.php');
    }

    //Checker om brugeren har klikket på del knappen
    if (isset($_POST['share-btn'])) {

        //Opret database forbindelse
        $conn = new mysqli('localhost', 'root', '', 'programmering');

        //Hent spilleplade id fra session
        $board_id = $_SESSION['board_id'];
        
        //Hent brugernavn fra input-felter og sikre mod sql angreb ved at fjerne speciele tegn og tage højde for serverens charset
        $share_name = mysqli_real_escape_string($conn, $_POST['username']);

        $sql = "SELECT * FROM users WHERE username='$share_name'";
        $result = $conn->query($sql);

        if($result){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    //Hent brugernavnets id
                    $share_id = $row['id'];

                    //Tilføj bruger til spilleplade
                    $sql = "INSERT INTO boards_users (users_id, boards_id)
                    SELECT * FROM (SELECT '$share_id', '$board_id') AS tmp
                    WHERE NOT EXISTS (
                        SELECT users_id FROM boards_users WHERE users_id = '$share_id'
                    ) LIMIT 1;";

                    $conn->query($sql);
                    
                    //Lukker databaseforbindelse
                    $conn->close();

                    //Viderstiller til menuen
                    header('location: usermanagement/menu.php');
                    exit(0);
                } 
            }
            else {
                //Fejlbesked hvis brugernavn ikke passer
                echo "<script type='text/javascript'>alert('Username does not match');</script>";
            }
        }else{
            //Luk databaseforbindelse
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="share.php" method="post" class="share">
        <div class="box">
            <label>Username to share with</label>
            <input type="text" required="required" name="username" value="">
        </div>
        <button id="share" type="submit" name="share-btn">Share</button>
    </form>
</body>
</html>