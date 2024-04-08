// add_task.php

<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    if (!empty($_POST['task'])) {
        $task_id = $_POST['task_id'];
        $task = $_POST['task'];
        $date = $_POST['date'];

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO `task` (`task_id`, `status`, `date`) VALUES (?, 'Pending', ?)");

        // Bind the parameter
        $stmt->bind_param("iss", $task, $date);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Redirect to index.php
        header('location:index.php');
    } else {
        echo "Task name cannot be empty.";
    }
}
?>


