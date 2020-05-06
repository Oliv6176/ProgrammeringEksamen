<?php
    //Start en session til oprettelse af session variabler
    session_start();
    
    //Send til log ind siden, hvis en bruger ikke er logget ind. 
    if (empty($_SESSION['id'])) {
        header('location: usermanagement/login.php');
        exit(0);
    }
    //Checker om der pliver lavet en POST med body
    if (isset($_POST["body"])) {
        //Opret database forbindelse
        $conn = new mysqli('localhost', 'root', '', 'programmering');

        //Hent spilleplade id og bruger id fra session
        $id = $_SESSION['board_id'];
        $user_id = $_SESSION['id'];

        //Hent body fra POST og beskyt mod sql angreb ved, at fjerne speciele tegn og tage højde for serverens charset
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        
        //Find alt fra databasetabellen board_users, hvor brætspils id'et er $id og bruger id'et er $user_id
        $sql = "SELECT * FROM boards_users WHERE boards_id='$id' AND users_id ='$user_id'";
        $result = $conn->query($sql);

        if($result){
            if ($result->num_rows > 0) {     
                while($row = $result->fetch_assoc()) {
                    //Updater spillepladen i databasen, hvor id'et er spillepladens id.
                    $sql = "UPDATE boards SET body = '$body' WHERE id='$id'";
                    $conn->query($sql);
                    exit();
                }
            }else{
                header("location: usermanagement/signout.php");
                exit(0);
            }
        }
        //Luk databaseforbindelse
        $conn->close();
    }
?>