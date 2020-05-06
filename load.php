<?php
    //Start en session til loading af session variabler
    session_start();

    //Send til index.php, hvis der ikke er et id.
    if (empty($_SESSION['view_id'])) {
        header('location: index.php');
    }

    //Starter database forbindelse
    $conn = new mysqli('localhost', 'root', '', 'programmering');

    //Checker om POST har en id parameter
    if (isset($_POST['id'])){
        //Beskytter databasen mod sql angreb
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        //Henter spillebrættet fra databasen
        $sql = "SELECT * FROM boards WHERE id='$id'";
        $result = $conn->query($sql);

        //Checker om der er et spillebræt i databasen
        if($result){
            if ($result->num_rows > 0) {     
                while($row = $result->fetch_assoc()) {
                    //Indsætter spillebrættet i websiden
                    echo $row["body"];
                }
            }
        }
    }
    $conn->close();
?>