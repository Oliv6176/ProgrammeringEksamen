<?php
    //Starter en session
    session_start();
    
    //Fjerner session variablerne id, username og board_id
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['board_id']);

    //Sletter session'en
    session_destroy();

    //Viderstiller til forsiden
    header("location: index.php");
?>