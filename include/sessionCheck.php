<?php
session_start();

if (! isset($_SESSION["USER_ID"])) {
    header('location: ../Login/login.php');
    exit();
}