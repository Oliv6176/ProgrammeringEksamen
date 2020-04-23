<?php

$conn = new mysqli('localhost', 'root', '', 'programmering');
$rbody = "";
$body = "";

if (isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM boards WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {     
        while($row = $result->fetch_assoc()) {
            $body = $row["body"];
            echo $body;
        }
    }
}
$conn->close();

