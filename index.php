<!DOCTYPE html>

<! want to put all into php so can use a second table in database to edit settings such as button names - create settings page as well?>

<html>
<head>
	<title>My Schedule</title>
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
		  <li class="nav-item active">
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
		  <li class="nav-item ">
			<a class="nav-link" href="settings.php">Settings</a>
		  </li>
		</ul>
	  </div>
	</nav>
	
	<div class="progress"> <! this will be progress bars to show the number of/progress of completed tasks of each colour>
	  	<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
		<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 30%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	<div class="container">
		<div class="jumbotron">
			<h1>Suggested Tasks</h1> 
	</div>
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
			
			$sql = "SELECT task_name, task_colour FROM tasks";
			
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row = $result->fetch_assoc()){
					echo
					'<div class="col-md-3 col-sm-6 hero-feature">
						<div class="thumbnail"><img src="http://placehold.it/200x100" alt="">
							<div class="caption">
								<h3>'.$row['task_name'].'</h3>
								<p>'.$row['task_colour'].'</p>
								<p>
									<a href="#" class="btn btn-success">BuyNow!</a>
									<a href="#" class="btn btn-info">More Info</a>
								</p>
							</div>
						</div>
					</div>';
				}
			}
			else{
				echo "<p>No products</p>";
			}
			$conn->close();	
		?>
	</div>


</body>
</html>