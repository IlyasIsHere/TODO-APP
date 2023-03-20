<?php
require_once '../include/pdo.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a task</title>
    <link rel="stylesheet" href="addTaskStyle.css">
</head>
<body>
<video autoplay loop playsinline muted>
    <source src="../Login/Pexels%20Videos%204703.mp4">
</video>
<div class="addTask-card">
    <h2>Add a Task</h2>
    <form method="post">
        <div class="form-container">
            <div class="form-row">
                <label for="task-name">Task Name</label>
                <input type="text" id="task-name" required>
            </div>
            <div class="form-row">
                <label for="task-category">Task Category</label>
                <select>
                    <?php
                    $query1 = 'SELECT * FROM categories;';
                    $stmt = $pdo->query($query1);
                    while ($row = $stmt->fetch()) {
                        echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="task-description">Description</label>
                <textarea id="task-description"></textarea>
            </div>
            <div class="form-row">
                <label for="duedate">Due Date</label>
                <input type="date" id="duedate" required>
            </div>
            <div class="form-row">
                <input type="submit" value="Add">
            </div>
        </div>
    </form>

</div>
</body>
</html>