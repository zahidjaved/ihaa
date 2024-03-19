<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
		}
		.container {
			max-width: 800px;
			margin: auto;
			padding: 20px;
			background-color: white;
			box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.1);
		}
		form {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}
		form input[type="text"] {
			flex-grow: 1;
			padding: 10px;
			border: none;
			border-radius: 4px;
			font-size: 16px;
			margin-right: 10px;
			box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.1);
		}
		form input[type="submit"] {
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			background-color: #007bff;
			color: white;
			font-size: 16px;
			cursor: pointer;
			box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.1);
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th {
			background-color: #007bff;
			color: white;
			padding: 10px;
			text-align: left;
			font-size: 16px;
			border-bottom: 2px solid white;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			font-size: 16px;
		}
		.delete-btn {
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			background-color: red;
			color: white;
			font-size: 16px;
			cursor: pointer;
			box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.1);
			margin-top: 10px;
		}
		.delete-btn:hover {
			background-color: #dc3545;
		}
	</style>
</head>
<body>
	<h1>Todo List</h1>
	<div class="container">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="task" placeholder="Enter a new task...">
			<input type="submit" name="add_task" value="Add Task">
		</form>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "tbl_to_do_list";
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			// Add task
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$task = $_POST["task"];
				
			
				if (!empty($task)) {
					$sql = "INSERT INTO tbl_todo (task) VALUES ('$task')";
					
					if ($conn->query($sql) === TRUE) {
						header("Location: index.php");
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
			
			// Delete task
			if (isset($_POST["delete_tasks"])) {
				$task_ids = $_POST["task_ids"];
				
				if (!empty($task_ids)) {
					$sql = "DELETE FROM tbl_todo WHERE id IN (" . implode(",", $task_ids) . ")";
					
					if ($conn->query($sql) === TRUE) {
						header("Location: index.php");
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
			
			// Retrieve tasks
			$sql = "SELECT * FROM tbl_todo";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Task</th>
								<th>Select</th>
							</tr>
						</thead>
						<tbody>
				<?php
				$i = 1;
				
				while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row["task"]; ?></td>
						<td><input type="checkbox" name="task_ids[]" value="<?php echo $row["id"]; ?>"></td>
					</tr>
					<?php
					$i++;
				}
				?>
						</tbody>
					</table>
					<input type="submit" name="delete_tasks" value="Delete Selected" class="delete-btn">
				</form>
				<?php
			} else {
				echo "No tasks found.";
			}
			
			$conn->close();
		?>
	</div>
</body>
</html>
