<div class="grid" id="draggable">
            <div id="0">
                <div class="container" id="0" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="1" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="2" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
            <div id="1">
                <div class="container" id="0" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="1" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="2" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
            <div id="2">
                <div class="container" id="0" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="1" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                <div class="container" id="2" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
        </div>









        <div class="menu">
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag1" style="background-image: url('1.png');background-size: contain;"></div>
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag2" style="background-image: url('2.png');background-size: contain;"></div>
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag3" style="background-image: url('3.jpg');background-size: contain;"></div>
        
    </div>

    <div class="gridbox">
        <div class="grid" id="draggable">
            <?php echo $body;?>
        </div>
    </div>


    $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
        // Find billedes fil type
        $imageFileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));
        echo $imageFileType;
      
        // Godkendte filtyper
        $extensions_arr = array("jpg","jpeg","png","gif");
      
        // Check om filtype er gyldig
        if( in_array($imageFileType,$extensions_arr) ){
            
            // Lav billede til base64 format til database 
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            //echo $image;
            echo "<img src='$image>";
            // Push til database
            $query = "INSERT INTO images (image) Values ('".$image."')";
            $conn->query($sql);
        }