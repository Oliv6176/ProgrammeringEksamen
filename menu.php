<?php
	session_start();
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
    <style>
		* {
			box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
		}

		body {
			margin: 0;
		}
		.header{
			padding: 0 20px;
		}
    	.topnav {
        	overflow: hidden;
        	background-color: #333;
      	}
    	.topnav a{
        	float:right;
			display: block;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
      	}
    	.footer {
        	background-color: #f1f1f1;
			padding: 10px;
			text-align: center;
		}
	
		.column {
			float: left;
			padding: 10px;
			text-align: center;
		}

		.column {
			width: 25%;
		}

		.row:after {
		content: "";
		display: table;
		clear: both;
		}

		@media screen and (max-width: 600px) {
		.column {
			width: 100%;
		}
		}
    </style>
</head>
<body>
	<div class="header">
    	<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
  	</div>
	<div class="topnav">
		<a href="signout.php">Sign Out</a>
	</div>

	<div class="column">
		<h2>Boards</h2>
		<?php
			if (isset($_POST['board-load-btn'])) {
				$board_id = $_POST["board-load-btn"];
				header("location: view.php?id=$board_id");
			}
			/*if (isset($_POST['boards-leave-btn'])) {
				$conn = new mysqli('localhost', 'root', '', 'programmering');
				$boards_id = $_POST["boards-leave-btn"];
				$user_id = $_SESSION['id'];
			
				$sql = "DELETE groups_users FROM groups_users WHERE groups_users.users_id ='$user_id' AND groups_users.groups_id = '$boards_id'";
				$conn->query($sql);
				$conn->close();
			}
			if (isset($_POST['group-delete-btn'])) {
				$conn = new mysqli('localhost', 'root', '', 'teknikfag');
				$group_id = $_POST["group-delete-btn"];
				$user_id = $_SESSION['id'];
		
				$sql = "DELETE groups.*,groups_users.* from groups_users INNER JOIN groups ON groups.id = groups_users.groups_id WHERE groups_users.groups_id = '$group_id' AND groups.owner = '$user_id'";
				$conn->query($sql);
				$conn->close();
			}*/

			$conn = new mysqli('localhost', 'root', '', 'programmering');
			$user_id = $_SESSION['id'];
		
			$sql = "SELECT groups.id,groups.owner,groups.name FROM boards_users INNER JOIN boards on boards.id = boards_users.boards_id WHERE users_id ='$user_id'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<form action="menu.php" method="post"><button id="board-load" type="submit" value="'. $row["id"] .'" name="group-load-btn">'.$row["name"].'</button></form>';
					if($row['owner'] === strval($user_id)){
						echo '<form action="menu.php" method="post"><button id="board-delete" onclick="return confirm(\'Are you sure you want to delete '.$row["name"].'?\');" type="submit" value="'. $row["id"] .'" name="board-delete-btn">Delete</button></form>';
					}else{
						echo '<form action="menu.php" method="post"><button id="board-leave" onclick="return confirm(\'Are you sure you want to leave '.$row["name"].'?\');" type="submit" value="'. $row["id"] .'" name="board-leave-btn">Leave</button></form>';
					}
				}
			}
			$conn->close();
		?>
	</div>

	<div class="column">
		<h2>New Group</h2>
		<form action="menu.php" method="post">
			<input type="text" required="required" name="group-name" placeholder="Group Name">
			<button id="group-create" type="submit" name="group-create-btn">Create new group</button>
			<?php
				if (isset($_POST['group-create-btn'])) {
					$conn = new mysqli('localhost', 'root', '', 'teknikfag');
					$group_name = $_POST["group-name"];
					$user_id = $_SESSION['id'];
			
					$sql = "INSERT INTO groups (name,owner) VALUES ('$group_name','$user_id')";
					$conn->query($sql);		
					$group_id = $conn->insert_id;
					
					$sql = "INSERT INTO groups_users (users_id,groups_id) VALUES ('$user_id','$group_id')";
					$conn->query($sql);
						
					$conn->close();
					header("location: group.php?id=$group_id");
					exit(0);
				}
			?>
		</form>
	</div>
</body>
</html>