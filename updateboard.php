<?php
session_start();
if (empty($_SESSION['id'])) {
	header('location: ../ProgrammeringEksamen/usermanagement/login.php');
}
$conn = new mysqli('localhost', 'root', '', 'programmering');

$id = $_SESSION['board_id'];
$body = $_POST['body'];
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM boards_users WHERE boards_id='$id' AND users_id ='$user_id'";
$result = $conn->query($sql);

if($result){
    if ($result->num_rows > 0) {     
        while($row = $result->fetch_assoc()) {
            if($row['users_id'] === $user_id && $row['boards_id'] === $id){
                $sql = "UPDATE boards SET body = '$body' WHERE id='$id'";
                $conn->query($sql);
                exit;
            }else{
                header("location: ../ProgrammeringEksamen/usermanagement/signout.php");
            }
        }
    }
}
$conn->close();


