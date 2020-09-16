<!DOCTYPE html>
<html>
<head>
	<title>My Schedule - Tasks</title>
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand navbar-dark bg-primary">
	  <div>
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item">
			<a class="nav-link" href="index.php">What to do...</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="tasks.php">List of Tasks</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="add_task.php">Add a task</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="complete_task.php">Complete a task</a>
		  </li>
		  <li class="nav-item active">
			<a class="nav-link" href="settings.php">Settings</a>
		  </li>
		</ul>
	  </div>
	</nav>
	<?php
	
		//database info:
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "schedule";
		
		//create a connection and check it
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if(mysqli_connect_error()){
			die("connection failed: ".$conn->connect_error);
		}
		
		//Create variables

		$task_colour = $_POST["task_colour_settings"];
		$colour_role = $_POST["colour_role"];
		
		$sql = "SELECT task_colour, colour_representation FROM colours ";
		$result = mysqli_query($conn, $sql);
		$row_count = mysqli_num_rows($result);
		for ($i=0; $i<$row_count; $i++){
			$row = mysqli_fetch_assoc($result);
			if ($row["task_colour"]==$task_colour){
				echo nl2br('This colour previously represented '.$row["colour_representation"].' and now represents '.$colour_role.'!');
				$sql = "UPDATE colours SET colour_representation = '".$colour_role."' WHERE task_colour = '".$task_colour."'";
				break;
			} 
			if ($i==$row_count-1){
				$sql = "INSERT INTO colours (task_colour, colour_representation) VALUES ('$task_colour','$colour_role')";
			}
		}
		if ($conn->query($sql)== TRUE){
			echo nl2br("\n Success!");
		}
		else {
			echo "Error: ".$sql."<br>".$conn->error;
		}
		
			
		
		//close connection
		$conn->close(); 
		
	?>