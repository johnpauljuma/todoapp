<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];
        $date = $_POST['date'];

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO `task` (`task`, `status`, `date`) VALUES (?, 'Pending', ?)");

        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("ss", $task, $date);

            // Execute the statement
            if ($stmt->execute()) {
                // Close the statement
                $stmt->close();

                // Redirect to index.php
                header('location:index.php');
            } else {
                echo "Error: Unable to insert the task.";
            }
        } else {
            echo "Error: Unable to prepare the SQL statement.";
        }
    } else {
        echo "Task name cannot be empty.";
    }
}
?>
