<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=no">
    <title>View Board</title>
    <link rel="stylesheet" href="../style.css">
    <meta http-equiv="refresh" content="2" > 

    <!-- Henter jQuery bibliotek fra Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script>
        //Kører jQuery når siden er indlæst
        $(document).ready(function() {
            setInterval(function() {
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const id = urlParams.get('id')
                //$.post( "getboard.php", { id: id }).done(function( data ) {
                //    $('.grid').html(data);
                //});
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
    <div class="grid" id="draggable">
        <?php
            //Starter database forbindelse
            $conn = new mysqli('localhost', 'root', '', 'programmering');

            //Checker om GET har en id parameter
            if (isset($_GET['id'])){
                //Beskytter databasen mod sql angreb
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                
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
    </div>
</body>
</html>