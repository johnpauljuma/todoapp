<?php
require 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    // Retrieve task details from the database
    $stmt = $db->prepare("SELECT * FROM `task` WHERE `task_id` = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Task</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <div class="container" style="margin-top: 20px;">
        <div class="input-area">
            <form method="POST" action="update.php">
                <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                <input type="text" name="task" placeholder="Enter task" value="<?php echo $task['task']; ?>" required>
                <input type="date" name="date" placeholder="Due date" value="<?php echo $task['date']; ?>" required>
                <button class="btn" type="submit" name="update">Update Task</button>
            </form>
        </div>
    </div>
</body>

</html>
