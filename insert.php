<!DOCTYPE html>
<html>
<head>
	<title>My Schedule - Tasks</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	
	<script>
	 
	function determineColour(colour){
			if (colour == 'Blue'){
				return 'card text-white bg-info mb-3';
			} else if (colour == 'Purple'){
				return 'card text-white bg-secondary mb-3';
			} else if (colour == 'Yellow'){
				return 'card text-white bg-warning mb-3';
			} else if (colour == 'Green'){
				return 'card text-white bg-success mb-3';
			} else if (colour == 'Red'){
				return 'card text-white bg-danger mb-3';
			} else {return 'card text-white bg-dark mb-3';}
	}	
	var colours = [];
	function colourRole(colour){
		var number_of_colours = colours.length;
		for (var i=0; i<number_of_colours; i++){
			if (colours[i][0]==colour){
				return colours[i][1];
			}
		}
		return "Set a topic name for "+colour+" in Settings";
	}
	</script>
	
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
		  <li class="nav-item active">
			<a class="nav-link" href="add_task.php">Add a task</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="complete_task.php">Complete a task</a>
		  </li>
		  <li class="nav-item ">
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
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if($conn->connect_error){
			die("connection failed: ".$conn->connect_error);
		}
		
		$sql_colours = "SELECT task_colour, colour_representation FROM colours";
		$result_colours = mysqli_query($conn, $sql_colours);
		
		while($row = mysqli_fetch_assoc($result_colours)){
			echo
			'<script>
				var colour_role = ["'.$row["task_colour"].'","'.$row["colour_representation"].'"];
				colours.push(colour_role);
				document.getElementById("testing1").innerHTML = colours;
			</script>';
		}
		
		//Create variables
			
		$task_name = $_POST["task_name"]; 
		$start_year = $_POST["start_year"]; 
		$start_month = $_POST["month1"]; 
		$start_day = $_POST["start_day"]; 
		$start_hour = $_POST["start_hour"]; 
		$start_minute = $_POST["start_minute"];	
		$deadline_year = $_POST["deadline_year"];
		$deadline_month = $_POST["month2"]; 
		$deadline_day = $_POST["deadline_day"]; 
		$deadline_hour = $_POST["deadline_hour"]; 
		$deadline_minute = $_POST["deadline_minute"]; 
		$task_duration = $_POST["task_duration"]; 
		$task_duration_unit = $_POST["task_duration_unit"]; 
		$task_colour = $_POST["task_colour"]; 
		$name_and_deadline = $_POST["name_and_deadline"];
		
		$task_colour = explode(" ",$task_colour);
		$task_colour = end($task_colour);
		$task_start = new DateTime(''.$start_year.'-'.$start_month.'-'.$start_day.' '.$start_hour.':'.$start_minute.'');
		$task_deadline = new DateTime("".$deadline_year."-".$deadline_month."-".$deadline_day." ".$deadline_hour.":".$deadline_minute);
		$task_deadline = date_format($task_deadline,'Y-m-d H:i');
		$task_start = date_format($task_start,'Y-m-d H:i');
					
		echo
		'<div class="container">
			<div class="jumbotron">
				<h1 id="heading">Tasks</h1>
			</div>
			<div style="max-width: 20rem;" id="'.$task_name.'_added">
				<div class="card-header" id="'.$task_name.'_Header"></div>
					<div class="card-body">
					<h4 class="card-title">'.$task_name.'</h4>
				</div>
			</div>
			<script>
				document.getElementById("'.$task_name.'_added").className = determineColour("'.$task_colour.'");
				document.getElementById("'.$task_name.'_Header").innerHTML = colourRole("'.$task_colour.'");
			</script>';
		
		$sql = "INSERT INTO tasks (task_name, task_duration, task_duration_unit, task_start, task_deadline, task_colour, name_and_deadline) VALUES ('$task_name','$task_duration','$task_duration_unit', '$task_start', '$task_deadline', '$task_colour', '$name_and_deadline')";

		//send query and check for errors
		if ($conn->query($sql)== TRUE){
			echo "New record created successfully";
		}
		else {
			echo "Error: ".$sql."<br>".$conn->error;
		}
		
		//close connection
		$conn->close(); 
		
	?>
</body>
</html>