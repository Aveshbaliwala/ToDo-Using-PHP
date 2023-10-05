<?php
	$errors = "";
	//connecting database
	$conn = mysqli_connect("localhost","root","","todo") or die("Connection Failed");

	if(isset($_POST['submit']))
	{
		$task = $_POST['task'];

		if(empty($task))
		{
			$errors = "You Must fill the task";
		}
		else
		{
			mysqli_query($conn,"INSERT INTO `tasks`(`task`) VALUES ('$task')");
			header("location:ToDo.php");
		}
	}
	//deleting the tasks
	if(isset($_GET['del_task']))
	{
		$id = $_GET['del_task'];
		mysqli_query($conn,"DELETE FROM `tasks` WHERE id=$id");
		header("location:ToDo.php");
	}

	//store the data into an object
	$tasks = mysqli_query($conn,"SELECT * FROM `tasks`");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>ToDo List</title>
</head>
<body class="body_class">
	<form action="ToDo.php" method="POST">
		<div class = "Container">
			<div class="row">
				<h3>ToDo List</h3>
				<div class="data">
					<input type="text" name="task" class="task_input" placeholder="Enter Your Task">
					<button type="submit" class="add_btn" name="submit">Add</button>
				</div>
			</div>
		</div>
	</form>
	<table class="tbl_data">
		<thead>
			<tr>
				<th>No</th>
				<th>Tasks</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			while ($row = mysqli_fetch_array($tasks)) { 
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td class="task"><?php echo $row['task'];?></td>
				<td class="delete">
					<a href="ToDo.php?del_task=<?php echo $row['id'];?>">Delete</a>
				</td>
			</tr>
			<?php 
			$i++;}
			?>
		</tbody>
	</table>
	<div>
		<table>
			<tbody>
			</tbody>
		</table>
	</div>
</body>
</html>