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
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboardStyle.css">
    <link rel="stylesheet" href="../include/bg-style.css">
    <link rel="stylesheet" href="../include/navbar-style.css">
    <link rel="stylesheet" href="../include/input-style.css">
</head>
<body>
    <video autoplay loop playsinline muted>
        <source src="../Login/Pexels%20Videos%204703.mp4">
    </video>
    <?php require_once '../include/navbar.php'; ?>
    <div id="categories">
        <div class="study">
            <a href="dashboard.php?id=3" class="btn">Study</a> 
        </div>

        <div class="personal">
            <a href="dashboard.php?id=1" class="btn">Personal</a> 
        </div>
        <div class="work">
            <a href="dashboard.php?id=2" class="btn">Work</a> 
        </div>
    </div>
<?php
class TaskManager
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function displayTasksByCategory($category): void
    {
        $query = "SELECT t.task_name, t.task_description, t.due_date, t.task_status 
                  FROM tasks t 
                  INNER JOIN task_category tc ON t.task_id = tc.task_id 
                  INNER JOIN categories c ON c.category_id = tc.category_id 
                  WHERE c.category_id = :category";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':category', $category);
        $stmt->execute();
        
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table class='task-table'>";
        echo "<tr><th>Task Name</th><th>Description</th><th>Due Date</th><th>Status</th></tr>";
        foreach ($tasks as $task) {
            echo "<tr class='task-row'>";
            echo "<td class='task-name'>".$task['task_name']."</td>";
            echo "<td class='task-description'>".$task['task_description']."</td>";
            echo "<td class='due-date'>".$task['due_date']."</td>";
            echo "<td class='task-status'>".$task['task_status']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    }
}
$taskManager = new TaskManager($pdo);

if (isset($_GET['id'])) {
        $category = $_GET['id'];
        $taskManager->displayTasksByCategory($category);
    }



?>
           
</body>
</html>
