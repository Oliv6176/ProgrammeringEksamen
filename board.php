<?php
    //Start session
    session_start();
    
    //Check brugeren er logget ind og om der er et board_id
	if (empty($_SESSION['id']) OR empty($_SESSION['board_id'])) {
		header('location: ../ProgrammeringEksamen/usermanagement/login.php');
    }
    //Forbinder til databasen
    $conn = new mysqli('localhost', 'root', '', 'programmering');
    
    //Henter brugerens id og spillepladens id
    $user_id = $_SESSION['id'];
    $board_id = $_SESSION['board_id'];

    //Hent spillepladen fra databasen
    $sql = "SELECT boards.id,boards.name,boards.body FROM boards WHERE id = '$board_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
            
            //Gemmer body, name og id
            $body = $row["body"];
            $name = $row["name"];
            $bId = $row["id"];
        }
    }
    else {

        //Viderestil til signout.php, hvis der ikke kan findes et board
        header('location: ../usermanagement/signout.php');
    }

    //lukker forbindelsen til databasen
    $conn->close();

    //Checker om brugeren klikker på "upload"
    if(isset($_POST['submit'])){
        
        //Checker om der er valgt en fil
        if(!empty($_FILES["file"]["name"])) { 

            //Gemmer filnavnet og filtypen
            $fileName = basename($_FILES["file"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
           
            //Godkendte filtyper
            $allowTypes = array('jpg','png','jpeg','gif'); 

            //Checker om den uploadede fil er godkendt
            if( in_array($fileType, $allowTypes )){
                $targetFilePath = "images/";

                //laver et nyt filnavn
                $temp = explode(".", $fileName);
                $newfilename = uniqid (rand (), true).'.'.end($temp);

                //Flyt filen til mappen "images/"
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath . $newfilename)){

                    $conn = new mysqli('localhost', 'root', '', 'programmering');
                    
                    //Uploader "path" til databasen
                    $query = "INSERT INTO images (img) values ('$targetFilePath$newfilename')";
                    $result = $conn->query($query);
                    $conn->close(); 
                }
            }
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

        //Funktion, som fjerner default action fra et event
        function allowDrop(ev) {
            ev.preventDefault();
        }
            
        function drag(ev) {
            //Sætter et events datatype til at være text og sætter eventet ev’s data til at være eventets target’s id.
            ev.dataTransfer.setData("text/plain", ev.target.id);
        }
        
        function drop(ev) {
            //Fjerner default action fra eventet.
            ev.preventDefault();

            //Henter eventets data og gemmer i variablen “data”, samt finder objektet vis id er lig med id’et gemt i variablen “data”.
            var data = ev.dataTransfer.getData("text/plain");
            var object = document.getElementById(data);
            
            //Checker om objektet eksistere
            if(object != null){

                //Checker at objektet ikke er en kopi
                if(object.getAttribute("clone") == "no"){

                    //Laver en kopi af objektet og gemmer kopien i variablen "clone"
                    var clone = object.cloneNode(true);

                    //Giver kopien et nyt id, bestående af millisekunder siden januar 1, 1970, 00:00:00 UTC  
                    var id = Date.now();
                    clone.setAttribute("id",id);

                    //Sætter kopiens attribute "clone" til "yes" og sætter "class" til "item element"
                    clone.setAttribute("clone","yes");
                    clone.setAttribute("class","item element");
                    
                    //Hent target's zIndex og gemmer i variablen "z"
                    var z = parseInt(ev.target.style.zIndex);

                    //Læg 1 til z
                    z = z + 1;

                    //Sæt kopiens zIndex til z
                    clone.style.zIndex = z;

                    //Tilføj kopien til target elementet
                    ev.target.appendChild(clone);
                    
                }
                else if (ev.target != document.getElementById(data)){
                    
                    //Hent target's zIndex og gemmer i variablen "z"
                    var z = parseInt(ev.target.style.zIndex);
                    
                    //Læg 1 til z
                    z = z + 1;

                    //Sætter elementet med id'et "data"'s zIndex til z
                    document.getElementById(data).style.zIndex = z;

                    //Tilføj elementet med id'et "data" til target elementet
                    ev.target.appendChild(document.getElementById(data));
                }
            }
            //Fjerner data fra event
            ev.dataTransfer.clearData();
        }   

        function remove(ev) {
            //Fjerner default action fra eventet.
            ev.preventDefault();

            //Henter eventets data og gemmer i variablen “data”, samt finder objektet vis id er lig med id’et gemt i variablen “data”.
            var data = ev.dataTransfer.getData("text/plain");
            var object = document.getElementById(data);
            
            //Checker om elementet er en kopi
            if(object.getAttribute("clone") == "yes"){
                object.parentNode.removeChild(object);
            }

            //Fjerner data fra event
            ev.dataTransfer.clearData();
        }
        
        //Funktion til tilføjelse af spillefelter til toppen 
        function topHandler(side) {
            
            //Finder elemtenterne med klassen "row" og gemmer i variablen n
            var n = document.getElementsByClassName('row');
            
            //For-løkke, som går igennem n's elementer 
            for(i=0; i< n.length; i++){
                //Checker om der skal tilføjes felter til toppen
                if(side == 1){
                    //Laver en kopi af der første "barn" af elementet i "n" med indexet
                    clone = n[i].children[0].cloneNode(true);

                    //Giver kopien et nyt id, bestående af millisekunder siden januar 1, 1970, 00:00:00 UTC  
                    clone.id = Date.now();

                    //Fjerner spil elementer fra kopien ved at sætte html-tekst til ""
                    clone.innerHTML = "";

                    //Indsæt kopien i elementet med indexet "i" i "n", før det første "barn" af elementet med indexet "i" i "n"
                    n[i].insertBefore(clone,n[i].children[0]);
                }
                //Checker om der skal fjernes felter fra toppen
                else if (side == -1){
                    //Checker om der er mere end en række
                    if(n[i].childElementCount > 1){
                        //Fjerner n's første "barn"
                        n[i].removeChild(n[i].children[0]);
                    }
                }
            }
        }

        //Samme koncept som tidligere bare for bunden
        function bottomHandler(side) {
            
            var n = document.getElementsByClassName('row');
            
            for(i=0; i< n.length; i++){
                if(side == 1){
                    clone = n[i].children[n[i].children.length-1].cloneNode(true);
                    clone.id = Date.now();
                    clone.innerHTML = "";
                    n[i].appendChild(clone);
                }else if (side == -1){
                    if(n[i].childElementCount > 1){
                        n[i].removeChild(n[i].lastChild);
                    }
                }
            }
        }

        //Samme koncept som tidligere bare for højreside
        function rightHandler(side) {
            var n = document.getElementsByClassName('grid');
            for(i=0; i< n.length; i++){
                if(side == 1){
                    clone = n[i].children[n[i].children.length-1].cloneNode(true);
                    clone.id = Date.now();
       
                    for(m=0; m< clone.childElementCount; m++){
                        clone.children[m].id = Date.now();
                        clone.children[m].innerHTML = "";
                    }
                    n[i].appendChild(clone);

                }else if (side == -1){
                    if(n[i].childElementCount > 1){
                        n[i].removeChild(n[i].lastChild);
                    }
                }
                var width = n[i].childElementCount;
                var s = "";
                for(i=0;i<width;i++){
                    s = s + "100px "; 
                }
                document.getElementsByClassName('grid')[0].style.gridTemplateColumns = s;
            }
        }

        //Samme koncept som tidligere bare for venstreside
        function leftHandler(side) {
            var n = document.getElementsByClassName('grid');
            for(i=0; i< n.length; i++){
                if(side == 1){
                    clone = n[i].children[0].cloneNode(true);
                    clone.id = Date.now();
       
                    for(m=0; m< clone.childElementCount; m++){
                        clone.children[m].id = Date.now();
                        clone.children[m].innerHTML = "";
                    }
                    n[i].insertBefore(clone,n[i].children[0]);
                }else if (side == -1){
                    if(n[i].childElementCount > 1){
                        n[i].removeChild(n[i].children[0]);
                    }
                }
                var width = n[i].childElementCount;
                var s = "";
                for(i=0;i<width;i++){
                    s = s + "100px "; 
                }
           
                document.getElementsByClassName('grid')[0].style.gridTemplateColumns = s;
            }
        }

        function update(){
            //Finder det første element med klassen "grid" og gemmer elementets html i variablen kaldet jsBody
            var jsBody = document.getElementsByClassName('grid')[0].innerHTML;
            
            //Bruger jQuery's post funktion til at kalde php-filen updateboard.php, med "body" som key og "jsBody" som value 
            $.post('updateboard.php', { body: jsBody }, function(data){
                //console.log(data);
            });
        }
        
        function back(){
            //Kører update funktionen for at gemme siden
            update();

            //Viderestiller til menu siden
            window.location.href = 'usermanagement/menu.php';
        }

        function share(){
            //Kører update funktionen for at gemme siden
            update();

            //Viderestiller til delings siden
            window.location.href = 'share.php';
        }

        //jQuery som kører når siden er loadet
        $(document).ready(function() {
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
        
            //Gør det muligt at flytte spillebrættet, når man holder shift nede
            $(document).keydown(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable();
                }
                
            });
            
            //Fjern muligheden for at flyte spillebrættet, når man slipper shift
            $(document).keyup(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable("destroy"); 
                }
            });

            //Gemmer spillebrættet hver 1000. millisekunder
            setInterval(function() {
                update();
            }, 1000);
        });
    </script>
</head>
<body>
    <div class="boardMenu" id="backsave">
        <button onclick="back()">Back</button>
        <button onclick="share()">Share</button>    
    </div>
    <div class="boardMenu" id="menu">
        <?php
            //Start databaseforbindelse og hent billeder til Drag and Drop menuen
            $conn = new mysqli('localhost', 'root', '', 'programmering');    
            $query = "SELECT * FROM images";
            $result = $conn->query($query);
            
            //Checker om der er mere end ét billede i databasen
            if($result){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        //Laver en div for hvert af billederne i databasen
                        echo '<div class="item" draggable="true" ondragstart="drag(event)" clone="no" id="'.uniqid().'" style="background-image: '. "url('".$row["img"]."')" .';background-size: contain;"></div>';
                    }
                }
            }
            //Lukker databaseforbindelsen
            $conn->close();
        ?>
   </div>  
    
    <div class="gridMenu">
        <h1 style="margin:0;margin-left:20px;margin-top:10px;"><?php echo $name ?>   id:<?php echo $bId ?></h1>
        <div style="display: flex; justify-content: space-between;">
            <div style="text-align:center;float:left;margin:10px;">
                <button onclick="topHandler(-1)">-</button>    
                <label>Top</label>
                <button onclick="topHandler(1)">+</button>
            </div>
            <div style="text-align:center;float:left;margin:10px;">
                <button onclick="bottomHandler(-1)">-</button>    
                <label>Bottom</label>
                <button onclick="bottomHandler(1)">+</button>
            </div>
            <div style="text-align:center;float:left;margin:10px;">
                <button onclick="rightHandler(-1)">-</button>    
                <label>Right</label>
                <button onclick="rightHandler(1)">+</button>
            </div>
            <div style="text-align:center;float:left;margin:10px;">
                <button onclick="leftHandler(-1)">-</button>    
                <label>Left</label>
                <button onclick="leftHandler(1)">+</button>
            </div>
        </div>
    </div>

    <div class="gridbox">
        <div class="grid" style="width:auto;display: grid;grid-template-columns: 100px;" id="draggable">
            <?php echo $body;?>
        </div>
    </div>

    <form class="boardMenu" action="board.php" method="post" enctype="multipart/form-data">
        <label id="select-image-label">Select Image File:</label>
        <input id="select-image-input" type="file" name="file">
        <input id="select-image-submit" type="submit" name="submit" value="Upload">
    </form>

    <img class="boardMenu" ondrop="remove(event)" ondragover="allowDrop(event)" src="images/bin.png" alt="bin">
</body>
</html>
