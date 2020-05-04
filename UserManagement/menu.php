<?php
	//Start en session til oprettelse af session variabler
    session_start();

    //Send til menuen, hvis en bruger allerede er logget ind. 
    if (empty($_SESSION['id'])) {
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu</title>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	<div class="header">
    	<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
  	</div>
	<div class="topnav">
		<a href="signout.php">Sign Out</a>
	</div>

	<div class="column">
		<h2>Gameboards</h2>
		<?php
			//Check om der er blevet klikket på load-knappen
			if (isset($_POST['board-load-btn'])) {
				
				//Start databaseforbindelse
				$conn = new mysqli('localhost', 'root', '', 'programmering');

				//Set spillebræts id og bruger id
				$board_id = mysqli_real_escape_string($conn, $_POST["board-load-btn"]);
				$user_id = $_SESSION['id'];
			
				//Henter de spillebræt som brugeren har adgang til
				$sql = "SELECT * FROM boards_users WHERE users_id ='$user_id'";
				$result = $conn->query($sql);

				//Checker om der er mere end ét spillebræt i databasen
				if($result){
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							//Gemmer id'et for spillebrættet i sessionen
							$_SESSION['board_id'] = $board_id;

							//Lukker databaseforbindelsen
							$conn->close();

							//Viderstil til board.php
							header("location: ../board.php");
							exit(0);
						}
					}
				}
				$conn->close();
			}

			if (isset($_POST['board-leave-btn'])) {
				$conn = new mysqli('localhost', 'root', '', 'programmering');
				
				$board_id = mysqli_real_escape_string($conn, $_POST["board-leave-btn"]);
				$user_id = $_SESSION['id'];
			
				$sql = "DELETE boards_users FROM boards_users WHERE boards_users.users_id ='$user_id' AND boards_users.boards_id = '$board_id'";
				$conn->query($sql);
				$conn->close();
			}

			if (isset($_POST['board-delete-btn'])) {
				$conn = new mysqli('localhost', 'root', '', 'programmering');
				
				$board_id = mysqli_real_escape_string($conn, $_POST["board-delete-btn"]);
				$user_id = $_SESSION['id'];
		
				$sql = "DELETE boards.*,boards_users.* from boards_users INNER JOIN boards ON boards.id = boards_users.boards_id WHERE boards_users.boards_id = '$board_id' AND boards.owner = '$user_id'";
				$conn->query($sql);
				$conn->close();
			}

			$conn = new mysqli('localhost', 'root', '', 'programmering');
			$user_id = $_SESSION['id'];
		
			$sql = "SELECT boards.id,boards.owner,boards.name FROM boards_users INNER JOIN boards on boards.id = boards_users.boards_id WHERE users_id ='$user_id'";
			$result = $conn->query($sql);

			if($result){
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<form action="menu.php" class="boardform" method="post"><button class="boardsbutton" id="board-load" type="submit" value="'. $row["id"] .'" name="board-load-btn">'.$row["name"].'</button></form>';
						if($row['owner'] === strval($user_id)){
							echo '<form action="menu.php" class="boardform" method="post"><button class="boardsbutton" id="board-delete" onclick="return confirm(\'Are you sure you want to delete '.$row["name"].'?\');" type="submit" value="'. $row["id"] .'" name="board-delete-btn">Delete</button></form>';
						}else{
							echo '<form action="menu.php" class="boardform" method="post"><button class="boardsbutton" id="board-leave" onclick="return confirm(\'Are you sure you want to leave '.$row["name"].'?\');" type="submit" value="'. $row["id"] .'" name="board-leave-btn">Leave</button></form>';
						}
						echo("<br>");
					}
				}
			}
			$conn->close();
		?>
	</div>

	<div class="column">
		<h2>New Gameboard</h2>
		<form action="menu.php" method="post">
			<input type="text" required="required" name="board-name" placeholder="Board Name">
			<button id="board-create" type="submit" name="board-create-btn">Create new board</button>
			<?php
				if(isset($_POST['board-create-btn'])) {
					$conn = new mysqli('localhost', 'root', '', 'programmering');
					
					$board_name = mysqli_real_escape_string($conn, $_POST["board-name"]);
					$user_id = $_SESSION['id'];

					$sql = "INSERT INTO boards (name,owner) VALUES ('$board_name', '$user_id')";
					$result = $conn->query($sql);

					$board_id = $conn->insert_id;
					$sql = "INSERT INTO boards_users (users_id,boards_id) VALUES ('$user_id', '$board_id')";
					$result = $conn->query($sql);

					$conn->close();

					//Opretter session variabler til spillebræts id
					$_SESSION['board_id'] = $board_id;
					
					//Viderstiller til board.php
					header('location: ../board.php');
					exit(0);
				}
			?>
		</form>
	</div>
</body>
</html>