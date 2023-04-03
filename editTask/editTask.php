<?php
require_once '../include/sessionCheck.php';
require_once '../include/pdo.php';

if ((! isset($_GET["editTaskID"])) || (! isset($_GET["categID"]))) {
    header('location: ../Dashboard/dashboard.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Task</title>
    <link rel="stylesheet" href="../include/bg-style.css">
    <link rel="stylesheet" href="../include/navbar-style.css">
    <link rel="stylesheet" href="../include/input-style.css">
    <link rel="stylesheet" href="editTaskStyle.css">
</head>
<body>
    <video autoplay loop playsinline muted>
        <source src="../Login/Pexels%20Videos%204703.mp4">
    </video>
    <?php
    require_once '../include/navbar.php';

    $tcategory = $_GET["categID"];
    $taskid = $_GET["editTaskID"];
    $stmt = $pdo->query("SELECT t.task_name, t.task_description, t.due_date FROM tasks t WHERE t.task_id = $taskid");
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    $tname = $task["task_name"];
    $tdescription = $task["task_description"];
    $tduedate = $task["due_date"];
    ?>

    <div class="editTask-card">
        <h2>Edit Task</h2>
        <form method="post" action="">
            <div class="form-container">
                <div class="form-row">
                    <label for="task-name">Task Name</label>
                    <input type="text" id="task-name" name="name" value="<?php echo $tname; ?>" required>
                </div>
                <div class="form-row">
                    <label for="task-category">Task Category</label>
                    <select name="category" id="task-category">
                        <?php
                        $query1 = 'SELECT * FROM categories;';
                        $stmt = $pdo->query($query1);
                        while ($row = $stmt->fetch()) {
                            if ($row['category_id'] == $tcategory) {
                                echo "<option value='" . $row['category_id'] . "' selected>" . $row['category_name'] . "</option>";
                            }
                            else {
                                echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-row">
                    <label for="task-description">Description</label>
                    <textarea id="task-description" name="description"><?php echo $tdescription; ?></textarea>
                </div>
                <div class="form-row">
                    <label for="duedate">Due Date</label>
                    <input type="date" id="duedate" name="date" value="<?php echo $tduedate; ?>" required>
                </div>
                <div class="form-row">
                    <input type="submit" value="Apply">
                </div>
            </div>
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $stmt1 = $pdo->prepare("UPDATE tasks SET task_name = ?, task_description = ?, due_date = ? WHERE task_id = $taskid");
        $stmt2 = $pdo->prepare("UPDATE task_category SET task_id = ?, category_id = ? WHERE task_id = $taskid AND category_id = $tcategory");
        $name = $_POST["name"];
        $desc = $_POST["description"];
        $date = $_POST["date"];
        $categ = $_POST["category"];

        $success1 = $stmt1->execute([$name, $desc, $date]);
        $success2 = $stmt2->execute([$taskid, $categ]);

        if ($success1 && $success2) {
            header("location: ../Dashboard/dashboard.php?taskEdited=true&id=$tcategory");
            exit();
        }

    }
    ?>
</body>
</html>
