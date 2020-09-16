<!DOCTYPE html>
<html>
<head>
	<title>My Schedule - New Task</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	<script> 
	var now = new Date();
	var sDay = now.getDate();
	var sMonth = now.getMonth();
	var sYear = now.getFullYear();
	var sHour = now.getHours();
	var sMinutes = now.getMinutes();
	var eDay = sDay;
	var eMonth = sMonth;
	var eYear = sYear;
	var eHour = sHour;
	var eMinutes = sMinutes;	
	
	function updateDayInput(val) {
		updateDeadlineDay(val, false);
        document.getElementById('start_day').value=val;
		document.getElementById('day1').value=val;
		sDay = val;
		checkDate(true);
	}
	
	var months = [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	
	function numericalMonth(str){
		for (i=0;i<12;i++){
			if (months[i]==str){
				return (i+1) ;
			}
		}
	}
	
	function updateMonthInput(val) {
		updateDeadlineMonth(val, false);
        document.getElementById('start_month').value=months[val-1]; 
		document.getElementById('month1').value=val;
		sMonth = val-1;
		checkDate(true);
    }

	function updateYearInput(val) {
		updateDeadlineYear(val, false);
        document.getElementById('start_year').value=val;
		sYear = val;
		checkDate(true);
	}
		
	function updateHourInput(val) {
		updateDeadlineHour(val, false);
        document.getElementById('start_hour').value=("0"+val).slice(-2);
		document.getElementById('hour1').value=val; 
		sHour = val;
		checkDate(true);
    }

	function updateMinuteInput(val) {
		updateDeadlineMinute(val, false);
        document.getElementById('start_minute').value=("0"+val).slice(-2);
		document.getElementById('minute1').value=val;
		sMinutes = val;
		checkDate(true);		
    }
		
	var deadlineUpdated = false;
	function updatedDeadline(){
		deadlineUpdated = true;
	}
	
	function updateDeadlineDay(val, Deadline){
		if (!deadlineUpdated || Deadline) {
			document.getElementById('day2').value=val;
			document.getElementById('deadline_day').value=val
			eDay = val;
			calculateTime();
			checkDate(false);
			checkDuplication();
			}
	}
	
	function updateDeadlineMonth(val, Deadline){
		if (!deadlineUpdated || Deadline){
			document.getElementById('month2').value=val;
			document.getElementById('deadline_month').value=months[val-1];
			eMonth = val-1;
			calculateTime();
			checkDate(false);
			checkDuplication();
			}
	}
	
	function updateDeadlineYear(val, Deadline){
		if (!deadlineUpdated || Deadline){
			document.getElementById('deadline_year').value=val;
			eYear = val;
			calculateTime();
			checkDate(false);
			checkDuplication();
			}
	}
	
	function updateDeadlineHour(val, Deadline){
		if (!deadlineUpdated || Deadline){
			document.getElementById('hour2').value=val;
			document.getElementById('deadline_hour').value=("0"+val).slice(-2);
			eHour = val;
			calculateTime();
			checkDate(false);
			checkDuplication();
			}
	}
	
	function updateDeadlineMinute(val, Deadline){
		if (!deadlineUpdated || Deadline){			
			document.getElementById('minute2').value=val;			
			document.getElementById('deadline_minute').value=("0"+val).slice(-2);
			eMinutes = val;
			calculateTime();
			checkDate(false);
			checkDuplication();
			}
	}
	
	function calculateTime(){
		var end = new Date(eYear, eMonth, eDay, eHour, eMinutes);
		var nowMilliseconds = now.getTime();
		nowMilliseconds = nowMilliseconds - nowMilliseconds%(1000*60); //rounding to nearest minute to avoid implication that two different times are "now" etc
		var endMilliseconds = end.getTime();
		endMilliseconds = endMilliseconds - endMilliseconds%(1000*60);
		var diff = endMilliseconds - nowMilliseconds;
		var message = "";
		if (diff<1000*60 && diff>-1000*60){
			message=message+"Deadline is now!";
		} else{
			if (diff<0){ message = message + "Deadline was "; document.getElementById("countdown").style="color: orange ";}
			else {message = message + "Deadline is in "; document.getElementById("countdown").style="font-size:80%;";}
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
		document.getElementById('countdown').innerHTML = message;
		
	}
	
	function checkDate(Start){
		if(Start){
			var startDate=new Date(sYear, sMonth, sDay);
			if (startDate.getDate()!=sDay) {
				document.getElementById('validDate1').style.display = "block" ;
				document.getElementById('validDate1').style = "top:-2";
				document.getElementById('validDate1Text').innerHTML = "This date does not exist!";
			} else {
				document.getElementById('validDate1').style.display = "none" ;
				document.getElementById('validDate1Text').innerHTML = "";
			} 
		} else {
			var endDate=new Date(eYear, eMonth, eDay);
			if (endDate.getDate()!=eDay){
				document.getElementById('validDate2').style = "top:-2; display: 'block'";
				document.getElementById('validDate2Text').innerHTML = "This date does not exist!";
			} else {
				document.getElementById('validDate2').style.display = "none" ;
				document.getElementById('validDate2Text').innerHTML = "";
			} 
		}
	}
		
	function colourRole(colour){
		var number_of_colours = colours.length;
		for (var i=0; i<number_of_colours; i++){
			if (colours[i][0]==colour){
				return colours[i][1];
			}
		}
		return "Set a topic name for "+colour+" in Settings";
	}
	
	var names_and_deadlines = [];
	
	function checkDuplication(){
		var name_and_deadline = document.getElementById("task_name").value+" "+eYear+"-"+("0"+(eMonth+1)).slice(-2)+"-"+("0"+eDay).slice(-2)+" "+("0"+eHour).slice(-2)+":"+("0"+eMinutes).slice(-2);
		document.getElementById("name_and_deadline").value = name_and_deadline;
		var number_of_tasks = names_and_deadlines.length;
		var duplicated=false;
		for (i=0;i<number_of_tasks;i++){
			if (name_and_deadline == names_and_deadlines[i]){
				duplicated = true;
				document.getElementById("task_name").className = "form-control is-invalid";
				document.getElementById("task_name_div").className = "form-group has-danger";
				document.getElementById("task_name_error").className = "invalid-feedback";
				document.getElementById('submit_task').disabled = true;
				break;
			}
		} 
		if (!duplicated){
			document.getElementById("task_name").className = "form-control";
			document.getElementById("task_name_div").className = "form-group";
			document.getElementById("task_name_error").className = "ghost invalid-feedback";
			document.getElementById('submit_task').disabled = false;
		}
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
	<! this is the typical form but will be where the new tasks are submitted and sent to insert.php >
	<! potentially add a check that dates entered are valid dates - include leap years etc? >
	<?php
	
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
	
	
	date_default_timezone_set("Europe/London");
	
	echo
	'<form class="AVAST_PAM_signupform AVAST_PAM_loginform" action = "insert.php" method="POST">
	  <fieldset>
		<legend>Add a new task</legend>
		<div class="form-group">
			<label for="task_colour">Task Colour - Add/Update in Settings</label>
			<select class="form-control" id="task_colour" name="task_colour">';
			while($row = mysqli_fetch_assoc($result_colours)){
				echo
				'<option id="'.$row[task_colour].'_option">'.$row[colour_representation].' - '.$row[task_colour].'</option>';
			}
			echo
		    '</select>
		</div>';
		
			
		$sql_duplicates = "SELECT name_and_deadline FROM tasks";
		$result_duplicates = mysqli_query($conn, $sql_duplicates);

		while($row = mysqli_fetch_assoc($result_duplicates)){
			echo
			'<script>
				names_and_deadlines.push("'.$row["name_and_deadline"].'");				
			</script>';
		}
		
		echo	
		'<div class="form-group" id="task_name_div">
			<label for="task_name">Task Name</label>
			<input class="form-control" id="task_name" name="task_name" placeholder="Enter your task name" onchange="checkDuplication();">
			<div class="ghost invalid-feedback" id="task_name_error">There is already a task with this name and this deadline. Try another?</div>	
		</div>
		
		<div class="form-group">
		  <label style="float:left; width:100%">When can you start the task?</label>
		  <input type="number" style="width:20%" id="start_day" name="start_day" min="1" max="31" value="'.date("d").'" onchange="updateDayInput(this.value);">
		  <input type="range" style="float:left; width: 80%" class="custom-range" id="day1" min="1" max="31" value="'.date("d").'" onchange="updateDayInput(this.value);">
		  <input style="width:20%" id="start_month" id="start_month" name="start_month" value="'.date("F").'" onchange="updateMonthInput(numericalMonth(this.value));">
		  <input type="range" style="float:left; width: 80%" class="custom-range" id="month1" name="month1" min="1" max="12" value="'.date("m").'" onchange="updateMonthInput(this.value);">
		  <input type="number" style="float:right; width:100%" id="start_year" name="start_year" value="'.date("Y").'" min="1900" onchange="updateYearInput(this.value);">
		  <div id="validDate1" class="card text-white bg-danger mb-3" style="display:none; max-width: 20rem;">
			<div class="card-body">
				<p class="card-text" id="validDate1Text"></p>
			</div>
		  </div>
		  <input style="width:40%" type="range" class="custom-range" id="hour1" min="0" max="23" value="'.date("H").'" onchange="updateHourInput(this.value);">
		  <input style="width:8%" type="number" id="start_hour" name="start_hour" min="0" max="23" value="'.date("H").'" onchange="updateHourInput(this.value);"> 
		  : 
		  <input style="width:8%" type="number" id="start_minute" name="start_minute" min="0" max="59" value="'.date("i").'" onchange="updateMinuteInput(this.value);">
		  <input style="width:40%" type="range" class="custom-range" id="minute1" min="0" max="59" value="'.date("i").'" onchange="updateMinuteInput(this.value);">
		  
		</div>
		
		<div class="form-group">
		  <label style="float:left; width:100%">When is the deadline?</label>
		  <input type="number" style="width:20%" id="deadline_day" name="deadline_day" min="1" max="31" value="'.date("d").'" onchange="updateDeadlineDay(this.value);">
		  <input type="range" style="float:left; width: 80%" class="custom-range" id="day2" min="1" max="31" value="'.date("d").'" onchange="updateDeadlineDay(this.value, true) + updatedDeadline();">
		  <input style="width:20%" id="deadline_month" name="deadline_month" value="'.date("F").'">
		  <input type="range" style="float:left; width: 80%" class="custom-range" id="month2" name="month2" min="1" max="12" value="'.date("m").'" onchange="updateDeadlineMonth(this.value, true) + updatedDeadline();">
		  <input type="number" style="float:right; width:100%" id="deadline_year" name="deadline_year" min="1900" value="'.date("Y").'" onchange="updatedDeadline();">
		  <div id="validDate2" class="card text-white bg-danger mb-3" style="display:none; max-width: 20rem;">
			<div class="card-body">
			  <p class="card-text" id="validDate2Text"></p>
			</div>
		  </div>
		  <input style="width:40%" type="range" class="custom-range" id="hour2" min="0" max="23" value="'.date("H").'" onchange="updateDeadlineHour(this.value, true) + updatedDeadline();">
		  <input style="width:8%" type="number" id="deadline_hour" name="deadline_hour" min="0" max="23" value="'.date("H").'" onchange="updateDeadlineHour(this.value);">
		  : 
		  <input style="width:8%" type="number" id="deadline_minute" name="deadline_minute" min="0" max="59" value="'.date("i").'" onchange="updateDeadlineMinute(this.value);">
		  <input style="width:40%" type="range" class="custom-range" id="minute2" min="0" max="59" value="'.date("i").'" onchange="updateDeadlineMinute(this.value, true) + updatedDeadline();">
		  <p id="countdown" style="font-size:80%;">Deadline is now!</p>
		</div>

		<div id="validDate2" class="card text-white bg-danger mb-3" style="display:none; max-width: 20rem;">
		  <div class="card-body">
			<p class="card-text" id="validDate2Text"></p>
		  </div>
		</div>
		
		<div class="form-group">
		  <label for="task_duration">How long will it take?</label>
		  <input type="number" min="0" class="form-control" id="task_duration" name="task_duration">
		  <select class="form-control" id="task_duration_unit" name="task_duration_unit">
			<option>day(s)</option>
			<option>hour(s)</option>
			<option>minute(s)</option>
		  </select>
		</div>
		<input style="display: none" id="name_and_deadline" name="name_and_deadline">
		<button class="btn btn-primary" id="submit_task">Submit</button>
	  </fieldset>
	</form>';
	?>

</body>
</html>