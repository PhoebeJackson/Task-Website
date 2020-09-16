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
	echo
	'<form class="AVAST_PAM_signupform AVAST_PAM_loginform" action = "insert_colour.php" method="POST">
	  <fieldset>
		<legend>Update colour</legend>
		<div class="form-group">
		  <label for="task_colour">Task Colour</label>
		  <select class="form-control" id="task_colour_settings" name="task_colour_settings">
			<option>Blue</option>
			<option>Purple</option>
			<option>Green</option>
			<option>Red</option>
			<option>Yellow</option>
		  </select>
		</div>
		
		<div class="form-group">
		  <label for="task_name">Colour Meaning</label>
		  <input class="form-control" id="colour_role" name="colour_role" placeholder="Enter your colour meaning">
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	  </fieldset>
	</form>';
	?>

</body>
</html>