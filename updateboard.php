<?php
session_start();
if (empty($_SESSION['id'])) {
	header('location: login.php');
}
$conn = new mysqli('localhost', 'root', '', 'programmering');
$rbody = "";
$body = "";

if (isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    $body = $_REQUEST['body'];
    $user_id = $_SESSION['id'];
    
    $sql = "SELECT * FROM boards WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {     
        while($row = $result->fetch_assoc()) {
            if($row['owner'] === strval($user_id)){
                $sql = "UPDATE boards SET body = '$body' WHERE id='$id' AND owner='$user_id'";
                $conn->query($sql);
            }else{
                header("location: signout.php");
            }
        }
    }
}
$conn->close();

