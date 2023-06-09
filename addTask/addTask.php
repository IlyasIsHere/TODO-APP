<?php
require_once '../include/pdo.php';
require_once '../include/sessionCheck.php';
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
    <link rel="stylesheet" href="../include/bg-style.css">
    <link rel="stylesheet" href="../include/navbar-style.css">
    <link rel="stylesheet" href="../include/input-style.css">
</head>
<body>
<video autoplay loop playsinline muted>
    <source src="../Login/Pexels%20Videos%204703.mp4">
</video>
<?php require_once '../include/navbar.php'; ?>

<div class="addTask-card">
    <h2>Add a Task</h2>
    <form method="post" action="">
        <div class="form-container">
            <div class="form-row">
                <label for="task-name">Task Name</label>
                <input type="text" id="task-name" name="name" required>
            </div>
            <div class="form-row">
                <label for="task-category">Task Category</label>
                <select name="category" id="task-category">
                    <?php
                    $query1 = 'SELECT * FROM categories;';
                    $stmt = $pdo->query($query1);
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="task-description">Description</label>
                <textarea id="task-description" name="description"></textarea>
            </div>
            <div class="form-row">
                <label for="duedate">Due Date</label>
                <input type="date" id="duedate" name="date" required>
            </div>
            <div class="form-row">
                <input type="submit" value="Add">
            </div>
        </div>
    </form>

</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO tasks (task_name, task_description, due_date, task_status) VALUES (?, ?, ?, 'in progress')");
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $date = $_POST["date"];
    $categ = $_POST["category"];

    $success1 = $stmt->execute([$name, $desc, $date]);
    $id = $pdo->lastInsertId();
    $user_id = $_SESSION["USER_ID"];

    $success2 = $pdo->exec("INSERT INTO task_category (task_id, category_id) VALUES ($id, $categ)");
    $success3 = $pdo->exec("INSERT INTO user_task (user_id, task_id) VALUES ($user_id, $id)");

    if ($success1 && $success2 && $success3) {
        ?>
<div class="success">Task added!</div>
<?php
    }
}
?>

</body>
</html>