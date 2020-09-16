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
	
	var tasks_completed = [];	
	function hideOrShowCompleted(val){ 
		if (val == "Hide Completed"){ 
			for (i=0;i<tasks_completed.length;i++){
				if (tasks_completed[i][1]==1){
					document.getElementById(tasks_completed[i][0]).style.display ="none";
				}
			}
		} else if (val == "Show Completed"){
			for (i=0;i<tasks_completed.length;i++){
				document.getElementById(tasks_completed[i][0]).style.display ="block";
			}
		}
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
	
	function calculateTime(ID, end){		
		var now = new Date();
		var nowMilliseconds = now.getTime();
		nowMilliseconds = nowMilliseconds - nowMilliseconds%(1000*60); //rounding to nearest minute to avoid implication that two different times are "now" etc
		var endMilliseconds = end.getTime();
		endMilliseconds = endMilliseconds - endMilliseconds%(1000*60);
		var diff = endMilliseconds - nowMilliseconds;
		var message = "";
		if (diff<1000*60 && diff>-1000*60){
			message=message+"Deadline is now!";
		} else{
			if (diff<0){ message = message + "Deadline was ";}
			else {message = message + "Deadline is in ";}
			var diffAbsolute = Math.abs(diff);
			var days = Math.floor(diffAbsolute / (1000*60*60*24) );
			diffAbsolute = diffAbsolute % (1000*60*60*24);
			var hours = Math.floor(diffAbsolute / (1000*60*60) );
			diffAbsolute = diffAbsolute % (1000*60*60);
			var minutes = Math.floor(diffAbsolute / (1000*60) );
			diffAbsolute = diffAbsolute % (1000*60);
			if (days>1){ message = message + days + " days";}
			else if (days==1){ message = message + days + " day ";}
			if ((days>0 && hours>0 && minutes==0)||(days>0 && hours==0 && minutes>0)){ message = message + " and ";}
			else if (days>0 && hours>0) { message = message + ", ";}
			if (hours>1){ message = message + hours + " hours";}
			else if (hours==1){ message = message + hours + " hour";}
			if (hours>0 && minutes>0){ message = message + " and ";}	
			if (minutes>1){ message = message + minutes + " minutes";}
			else if (minutes==1){ message = message + minutes + " minute";}		
			if (diff<0){message = message + " ago!";}
		}		
		document.getElementById(ID).innerHTML = message + " (" + end.toDateString()+")";
		
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
		  <li class="nav-item active">
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
	
	
	<?php
		//want to look into making cards go next to each other rather than only below
		//look into adjusting when window size is changed?
		//look into the navigational list!
		//using procedural style php (object orientated is alternative! see: https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp)
		//database info:
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "schedule";
		
		//create a connection and check it
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if(mysqli_connect_error()){
			die("connection failed: ".mysqli_connect_error());
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
		

		$sql = "SELECT task_name, task_colour, task_complete, amount_done, name_and_deadline, task_deadline, task_duration, task_duration_unit FROM tasks "; //alternatively try using WHERE
		$result = mysqli_query($conn, $sql);		
		
		echo 
		'<form>
			<div class="form-group">			  
			  <select style="width:175px; float: right" class="form-control" id="show_completed" name="show_completed" checked="" onchange="hideOrShowCompleted(this.value);">
				<option>Hide Completed</option>
				<option>Show Completed</option>
			  </select>
			</div>
		</form>
		<div class="container">
					<div class="jumbotron">
						<h1 id="heading">Tasks</h1>
					</div>';
				
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$task_deadline = new DateTime($row["task_deadline"]);
				//a line may be needed here to determine the category associated with the row (aka task) colour 
				echo
				'<div style="max-width: 20rem;" id="'.$row["name_and_deadline"].'">
					<div class="card-header" id="'.$row['name_and_deadline'].'_Header"></div>
					<div class="card-body">
						<h4 class="card-title">'.$row['task_name'].'</h4>
						<div class="progress">
							<div class="progress-bar bg-dark" role="progressbar" style="width: '.$row["amount_done"].'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					<p>'.$row["amount_done"].'% complete, you have done '.round($row["amount_done"]/100*$row["task_duration"],1).' of '.$row["task_duration"].' '.$row["task_duration_unit"].'</p>
					<p class="card-text" id="'.$row['name_and_deadline'].'_countdown">This should not show</p>
					</div>
				</div>
				<script>
					document.getElementById("'.$row["name_and_deadline"].'").className = determineColour("'.$row["task_colour"].'");
					var task = ["'.$row["name_and_deadline"].'","'.$row["task_complete"].'"];
					tasks_completed.push(task);
					if (document.getElementById("show_completed").value == "Hide Completed"){
						if ('.$row["task_complete"].'==1){
							document.getElementById("'.$row['name_and_deadline'].'").style.display ="none";
						}
					}
					document.getElementById("'.$row['name_and_deadline'].'_Header").innerHTML = colourRole("'.$row["task_colour"].'");
					var eDay = '; echo date_format($task_deadline,"d"); echo';
					var eMonth =  '; echo date_format($task_deadline,"m"); echo'-1;
					var eYear =  '; echo date_format($task_deadline,"Y"); echo';
					var eHour =  '; echo date_format($task_deadline,"H"); echo';
					var eMinutes =  '; echo date_format($task_deadline,"i"); echo';
					var end = new Date(eYear, eMonth, eDay, eHour, eMinutes);
					calculateTime("'.$row['name_and_deadline'].'_countdown",end);
				</script>';
			}
		}
		else{
			echo '<p>No tasks</p>';
		}
		mysqli_close($conn);	
	?>
	</div>


</body>
</html>