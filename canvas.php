<?php

$conn = new mysqli('localhost', 'root', '', 'programmering');
$rbody = "";
$body = "";

if (isset($_REQUEST['update'])) {

    $id = $_REQUEST['id'];
    $rbody = $_REQUEST['update'];
    $sql = "SELECT * FROM boards WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {     
        while($row = $result->fetch_assoc()) {
            $body = $row["body"];
        }
    }else{
        $sql = "INSERT INTO boards (body) VALUES ($rbody)";
        $result = $conn->query($sql);
        echo $rbody;
    }
    if($body !== $rbody){
        $sql = "UPDATE boards SET body= '$rbody' WHERE id = '$id'";
        $result = $conn->query($sql);
        echo $rbody;
    }else{
        echo $body;
    }
}
$conn->close();

