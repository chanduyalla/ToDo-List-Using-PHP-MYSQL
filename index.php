<?php

// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "", "todo");

// insert a quote if submit button is clicked
if (isset($_POST['submit'])) {
  if (empty($_POST['task'])) {
    $errors = "You must fill in the task";
  }else{
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    mysqli_query($db, $sql);
    header('location: index.php');
  }
}	
// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="card text-center m-5">
  <div class="card-header">
     ToDo List
  </div>
  <div class="card-body m-5">
  <!--Form-->
    <form method="POST" action="index.php" class="input_form m-5">
    <input type="text" name="task" class="task_input" style="width:70%; height:40px;margin-top:10px;" required>
    <button type="submit" name="submit" class="btn btn-primary m-1">Add Task</button>
    </form>
    <center>
    <table>
	<thead >
		<tr>
			<th>N&nbsp;&nbsp;</th>
			<th>Tasks&nbsp;&nbsp;</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?>&nbsp;&nbsp; </td>
				<td class="task"> <?php echo $row['task']; ?>&nbsp;&nbsp; </td>
				<td class="delete"> <center>
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> </center>
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</center>
  </div>
  <div class="card-footer text-muted">
  Design and Developedy by Y.Naga Chandrika
  </div>
</div>
    
</body>
</html>