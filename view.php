<?php
    session_start();

    //Send til index, hvis der ikke er et id. 
    if (empty($_SESSION['view_id'])) {
        header('location: index.php');
    }

    //Sætter id
    $id = $_SESSION["view_id"];

    //Forbinder til databasen
    $conn = new mysqli('localhost', 'root', '', 'programmering');

    //Hent spillepladen fra databasen
    $sql = "SELECT * FROM boards WHERE id = '$id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
        
    }
    else {

        //Viderestil til signout.php, hvis der ikke kan findes et board
        header('location: usermanagement/signout.php');
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=no">
    <title>View Board</title>
    <link rel="stylesheet" href="style.css">
    <!-- Henter jQuery bibliotek fra Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
            
        function drag(ev) {

        }
        
        function drop(ev) {

        }   

        //Kører jQuery når siden er indlæst
        $(document).ready(function() {
            setInterval(function() {
                var id = "<?php echo $id?>";
                
                $.post( "load.php", { id: id }).done(function( data ) {
                    $('.grid').html(data);
                });
                //Sætter variablen "width" til at være antallet af "børn" i det første element med klassen "grid"
                var width = document.getElementsByClassName('grid')[0].childElementCount;
                
                //Bestemmer antallet af kolonner på baggrund af bredden "width"
                var s = "";
                for(i=0;i<width;i++){
                    s = s + "100px "; 
                }

                //Sætter bredden af spillebrættet
                document.getElementsByClassName('grid')[0].style.gridTemplateColumns = s;
                s="";
            }, 1000);
        
            $(document).keydown(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable();
                }
        
            });
            $(document).keyup(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable("destroy"); 
                }
            });
        });
    </script>
</head>
<body>
    <div class="grid" style="width:auto;display: grid;grid-template-columns: 100px;" id="draggable">
    </div>
</body>
</html