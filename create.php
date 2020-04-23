<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=no">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
            }
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
                }
                
            });
            $(document).keyup(function (e){
                if(e.keyCode == 16){
                    $( "#draggable" ).draggable("destroy"); 
                }
            });

            $.post( "canvas.php", { update: $('.grid').html(), id: 1 })
            .done(function( data ) {
                $('.grid').html(data);
            });
        });
    </script>
</head>
<body>
    <div class="menu">
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag1" style="background-image: url('1.png');background-size: contain;"></div>
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag2" style="background-image: url('2.png');background-size: contain;"></div>
        <div class="item" draggable="true" ondragstart="drag(event)" clone="yes" id="drag3" style="background-image: url('3.jpg');background-size: contain;"></div>
        
    </div>

    <div class="gridbox">
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
    </div>
    
    <img ondrop="remove(event)" ondragover="allowDrop(event)" src="bin.png" alt="bin" style="width:50px;height:50px;position:absolute;right:0px;bottom:10px;">
</body>
</html>
