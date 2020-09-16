<!DOCTYPE html>
<html>
<head>
	<title>My Schedule - Completed a Task</title>
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
		  <li class="nav-item active">
			<a class="nav-link" href="complete_task.php">Complete a task</a>
		  </li>
		  <li class="nav-item ">
			<a class="nav-link" href="settings.php">Settings</a>
		  </li>
		</ul>
	  </div>
	</nav>
	
	<div class="progress">
	  	<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
		<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 30%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		<div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 35%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
	</div>

	<?php
	//going to use a form per task with hidden text so each submit button submits the name_and_deadline of the task such that it is unique and the task being updated can be identified on the next page
	// or show options when selected but without leaving the page? then update on submitting - could this just be added as a feature on the list of tasks page (and what to do page?)
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
		
	$sql = "UPDATE colours SET colour_representation = '".$colour_role."' WHERE task_colour = '".$task_colour."'";
	
	result = mysqli_query($conn, $sql);
	$row_count = mysqli_num_rows($result);
	for ($i=0; $i<$row_count; $i++){
		$row = mysqli_fetch_assoc($result);
				
	
	?>
	
	
	

</body>
</html>