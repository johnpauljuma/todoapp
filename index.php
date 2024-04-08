<!DOCTYPE html>
<html lang="en">

<head>
<title>Todo List</title>
<link rel="stylesheet"
		type="text/css" href="styles.css" />
</head>

<body>
<nav>
	<a class="heading" href="#">ToDo App</a>
</nav>
<div class="container">
	<div class="input-area">
	<form method="POST" action="add_task.php">
		<input type="text" name="task_id" placeholder="Enter task ID" required />
		<input type="text" name="task" placeholder="Enter new task" required />
		<input type="date" name="date" placeholder="Due date" required>
		<button class="btn" name="add">
			Add Task
		</button>
	</form>
	</div>
	<table class="table">
	<thead>
		<tr>
		<th>#</th>
		<th>Tasks</th>
		<th>Status</th>
		<th>Due Date</th>
		<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
				require 'config.php';
				/*$fetchingtasks = 
mysqli_query($db, "SELECT * FROM `task` ORDER BY `task_id` ASC")
or die(mysqli_error($db));
				$count = 1;
				while ($fetch = $fetchingtasks->fetch_array()) {
					?>
		<tr class="border-bottom">
		<td>
			<?php echo $fetch['task_id']?>
		</td>
		<td>
			<?php echo $fetch['task'] ?>
		</td>
		<td>
			<?php echo $fetch['status'] ?>
		</td>
		<td>
			<?php echo date('Y-m-d', strtotime($fetch['date'])); ?>
		</td>
		<td colspan="2" class="action">
			<?php if ($fetch['status'] != "Done"): ?>
				<a href="update_task.php?task_id=<?php echo $fetch['task_id']; ?>" class="btn-completed">Mark as Done</a>
				<a href="edit_task.php?task_id=<?php echo $fetch['task_id']; ?>" class="btn-completed">Edit</a>
			<?php endif; ?>
			<a href="delete_task.php?task_id=<?php echo $fetch['task_id']; ?>" class="btn-remove">Delete</a>
		</td>
		</tr>
		<?php
				}*/
				// Fetch tasks from the database using PDO
				try {
					$conn = new PDO("sqlsrv:server = tcp:jptodo.database.windows.net,1433; Database = todoapp", "jp", "myphpserver@1234");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					// Fetch tasks from the database
					$stmt = $conn->query("SELECT * FROM task ORDER BY task_id ASC");
					
					// Check if the query was successful
					if ($stmt !== false) {
						$count = 1;
						// Loop through the result set and display each task
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr class='border-bottom'>";
							echo "<td>{$row['task_id']}</td>";
							echo "<td>{$row['task']}</td>";
							echo "<td>{$row['status']}</td>";
							echo "<td>{$row['date']}</td>";
							echo "<td colspan='3' class='action'>";
							if ($row['status'] != "Done") {
								echo "<a href='update_task.php?task_id={$row['task_id']}' class='btn-completed'>Mark as Done</a>";
								echo "<a href='edit_task.php?task_id={$row['task_id']}' class='btn-completed'>Edit</a>";
							}
							echo "<a href='delete_task.php?task_id={$row['task_id']}' class='btn-remove'>Delete</a>";
							echo "</td>";
							echo "</tr>";
							$count++;
						}
					} else {
						// Display an error message if the query failed
						$errorInfo = $conn->errorInfo();
						echo "<tr><td colspan='5'>Failed to fetch tasks. Error: {$errorInfo[2]}</td></tr>";
					}
				} catch (PDOException $e) {
					print("Error connecting to SQL Server.");
					die(print_r($e));
				}
				
			?>
	</tbody>
	</table>
</div>
</body>

</html>
