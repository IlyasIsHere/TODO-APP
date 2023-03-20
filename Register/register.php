<?php
require_once '../include/pdo.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="registerStyle.css">
</head>
<body>
    <video autoplay loop playsinline muted>
        <source src="../Login/Pexels%20Videos%204703.mp4">
    </video>
    <div class="register-card">
        <h2>Register</h2>
        <form method="post" action="">
        <div class="form-container">
            <div class="form-row">
                    <label>Username:</label>
                    <input type="text" name="username">
                </div>
                <div class="form-row">		
                    <label>Email:</label>
                    <input type="email" name="email">
                </div>
                <div class="form-row">
                    <label>Password:</label>
                    <input type="password" name="password">
                </div>
                <div class="form-row">
                    <label>Confirm Password:</label>
                    <input type="password" name="confirm_password">
                </div>
                <div class="form-row">
                    <input type="submit" name="register" value="Register">
                </div>
        </div>
        </form>
    </div>
	<?php

	if (isset($_POST['register'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
			echo "Please fill in all fields.";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format.";
		} elseif ($password != $confirm_password) {
			echo "Passwords do not match.";
		} else {
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $conn->prepare("INSERT INTO users (username, email, hashed_pwd) VALUES (?, ?, ?)");
			$stmt->execute([$username, $email, $hashed_password]);
			$user_id = $conn->lastInsertId();

			echo "Registration successful.";
		}
	}
	?>
</body>
</html>
