<?php
require 'config.php';

if (isset($_POST['update'])) {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $date = $_POST['date'];

    // Prepare and execute SQL statement to update task details
    $stmt = $db->prepare("UPDATE `task` SET `task` = ?, `date` = ? WHERE `task_id` = ?");
    $stmt->bind_param("ssi", $task, $date, $task_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to edit_task.php with success message
    header('location: index.php?task_id=' . $task_id . '&success=true');
    exit;
} else {
    // If the update button was not clicked, redirect to edit_task.php with error message
    header('location: edit_task.php?task_id=' . $task_id . '&error=true');
    exit;
}
?>
