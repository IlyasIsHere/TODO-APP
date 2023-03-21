<?php
session_start();
require_once '../include/pdo.php';

$username_err = "";
$password_err = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 0) {
        $username_err = "There is no account with this username.";
    }
    else {
        $user_row = $stmt->fetch();
        $hash = $user_row["hashed_pwd"];
        if (! password_verify($pass, $hash)) {
            $password_err = "Incorrect password.";
        }
        else {
            $_SESSION["USER_ID"] = $user_row["user_id"];
            $_SESSION["USER_EMAIL"] = $user_row["email"];
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="loginStyle.css">
</head>
<body>
    <video autoplay loop playsinline muted>
        <source src="Pexels%20Videos%204703.mp4">
    </video>
    <div class="login-card">
        <h2>Login</h2>
        <form method="post">
            <div class="form-container">
                <div class="form-row">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-row">
                    <?php echo $username_err ?>
                </div>
                <div class="form-row">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-row">
                    <?php echo $password_err ?>
                </div>
                <div class="form-row">
                    <input type="submit">
                </div>
                <div class="form-row create-acc">
                    <p>New here? <a href="#">Create an account</a>.</p>
                </div>
            </div>
        </form>

    </div>
</body>
</html>