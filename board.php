<?php
	session_start();
	if (empty($_SESSION['id']) OR empty($_SESSION['board_id'])) {
		header('location: login.php');
    }
    $conn = new mysqli('localhost', 'root', '', 'programmering');
    $user_id = $_SESSION['id'];
    $board_id = $_SESSION['board_id'];
    $body="";

    $sql = "SELECT boards.id,boards.owner,boards.body FROM boards WHERE owner ='$user_id' AND id = '$board_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row['owner'] === strval($user_id)){
                $body = $row["body"];
            }
            else {
                header('location: signout.php');
            }
		}
    }
    $conn->close();
    if(isset($_POST['submit'])){
        if(!empty($_FILES["image"]["name"])) { 
            $conn = new mysqli('localhost', 'root', '', 'programmering');
            
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            
            $allowTypes = array('jpg','png','jpeg','gif'); 

            if( in_array($fileType, $allowTypes )){
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
            
                $query = "INSERT INTO images (img) values ('$imgContent')";
                $result = $conn->query($query);
            }
            $conn->close(); 
        }
    }		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=no">
    <title>Board</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
            
        function drag(ev) {
            ev.dataTransfer.setData("text/plain", ev.target.id);
        }
        
        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text/plain");
            var object = document.getElementById(data);
            if(object != null){
            if(object.getAttribute("clone") == "yes"){
                var clone = object.cloneNode(true);
                var id = Date.now();
                clone.setAttribute("id",id);
                clone.setAttribute("clone","no");
                clone.setAttribute("class","item element");
                
                var z = parseInt(ev.target.style.zIndex);
                z = z + 1;
                console.log(z);
                clone.style.zIndex = z;
    
                

                ev.target.appendChild(clone);
            }else if (ev.target != document.getElementById(data)){
                var z = parseInt(ev.target.style.zIndex);
                z = z + 1;
                document.getElementById(data).style.zIndex = z;
                ev.target.appendChild(document.getElementById(data));
            }}
            ev.dataTransfer.clearData();
        }

        function remove(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text/plain");
            var object = document.getElementById(data);
            if(object.getAttribute("clone") == "no"){
                object.parentNode.removeChild(object);
            }
            ev.dataTransfer.clearData();
        }
        

        $(document).ready(function() {

            $(document).keydown(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable();
                    console.log("geheh");
                }
                
            });
            $(document).keyup(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable("destroy"); 
                }
            });

            setInterval(function() {
                var jsId = '<?php echo $_SESSION['id']; ?>'
                var jsBody = $('.grid').html()

                $.post( "updateboard.php", { body: jsBody})
                
            }, 1000);
        });
    </script>
</head>
<body>

<form action="board.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form>
<div class="menu">
<?php
    $conn = new mysqli('localhost', 'root', '', 'programmering');    
    $query = "SELECT * FROM images";
    $result = $conn->query($query);
    if($result){
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="'.uniqid().'" style="background-image: '. "url('data:image/jpg;charset=utf8;base64,".base64_encode($row['img'])."')" .';background-size: contain;"></div>';
            }
        }
    }

    $conn->close();
?>
   </div>  
    
   <div class="gridbox">
        <div class="grid" id="draggable">
            <?php echo $body;?>
        </div>
    </div>



    <img ondrop="remove(event)" ondragover="allowDrop(event)" src="bin.png" alt="bin" style="width:50px;height:50px;position:absolute;right:0px;bottom:10px;">
    
    
</body>
</html>
