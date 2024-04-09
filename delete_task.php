<?php
require_once 'config.php';

if ($_GET['task_id']) {
    $task_id = $_GET['task_id'];

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM task WHERE task_id = :task_id");

        // Bind the parameter
        $stmt->bindParam(':task_id', $task_id);

        // Execute the statement
        $stmt->execute();

        // Redirect to index.php
        header("location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Display any errors
    }
}
?>
