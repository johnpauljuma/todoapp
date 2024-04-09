<?php
require_once 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    try {
        // Retrieve task details from the database
        $stmt = $conn->prepare("SELECT * FROM task WHERE task_id = ?");
        $stmt->bindParam(1, $task_id);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Display any errors
    }
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
