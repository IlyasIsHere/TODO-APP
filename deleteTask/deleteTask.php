<?php
require_once "../include/pdo.php";
require_once "../include/sessionCheck.php";

if (isset($_GET["deleteTaskID"])) {
    $categID = $_GET["categID"];

    $stmt1 = $pdo->prepare("DELETE FROM tasks WHERE task_id = ?");
    $stmt2 = $pdo->prepare("DELETE FROM task_category WHERE task_id = ?");
    $stmt3 = $pdo->prepare("DELETE FROM user_task WHERE task_id = ?");

    $success1 = $stmt1->execute([$_GET["deleteTaskID"]]);
    $success2 = $stmt2->execute([$_GET["deleteTaskID"]]);
    $success3 = $stmt3->execute([$_GET["deleteTaskID"]]);

    if ($success1 && $success2 && $success3) {
        header("location: ../Dashboard/dashboard.php?taskDeleted=true&id=$categID");
        exit();
    }
}