<?php
require_once 'config.php';

if (isset($_POST['update'])) {
    if (!empty($_POST['task_id']) && !empty($_POST['task']) && !empty($_POST['date'])) {
        $task_id = $_POST['task_id'];
        $task = $_POST['task'];
        $date = $_POST['date'];

        try {
            // Prepare and execute SQL statement to update task details
            $stmt = $conn->prepare("UPDATE task SET task = ?, date = ? WHERE task_id = ?");
            $stmt->bindParam(1, $task);
            $stmt->bindParam(2, $date);
            $stmt->bindParam(3, $task_id);
            $stmt->execute();
            
            // Redirect back to index.php with success message
            header('location: index.php?task_id=' . $task_id . '&success=true');
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Display any errors
        }
    } else {
        // If any of the required fields are empty, redirect to edit_task.php with error message
        header('location: edit_task.php?task_id=' . $task_id . '&error=true');
        exit;
    }
} else {
    // If the update button was not clicked, redirect to edit_task.php with error message
    header('location: edit_task.php?task_id=' . $task_id . '&error=true');
    exit;
}
?>
