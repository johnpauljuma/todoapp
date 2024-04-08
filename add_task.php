<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    if (!empty($_POST['task']) && !empty($_POST['task_id'])) {
        $task_id = $_POST['task_id'];
        $task = $_POST['task'];
        $date = date('Y-m-d H:i:s'); // Assuming the date format is YYYY-MM-DD HH:MM:SS and you want to insert the current date/time.

        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO task (task_id, task, status, date) VALUES (?, ?, 'Pending', ?)");

            // Bind the parameters
            $stmt->bindParam(1, $task_id);
            $stmt->bindParam(2, $task);
            $stmt->bindParam(3, $date);

            // Execute the statement
            $stmt->execute();

            // Redirect to index.php
            header('location:index.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display any errors
        }
    } else {
        echo "Task name and task ID cannot be empty.";
    }
}
?>
