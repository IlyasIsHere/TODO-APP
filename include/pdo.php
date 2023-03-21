<?php
$pdo = new PDO("mysql:host=localhost;dbname=todoapp;charset=UTF8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);