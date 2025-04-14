<?php

global $dbConnection;
include 'dbConnection.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($dbConnection, $_POST['username']);
    $password = mysqli_real_escape_string($dbConnection, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($dbConnection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header('Location: admin.php');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "User not found";
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
</head>
<body>
<h2>Login</h2>
<?php
if ($error): ?>
    <p style="color:red">
        <?php
        echo $error; ?>
    </p>
<?php
endif; ?>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input id="username" type="text" name="username" required>

    <label for="password">Password:</label>
    <input id="password" type="password" name="password" required>

    <input type="submit" value="Login">
</form>
</body>
</html>

<?php
mysqli_close($dbConnection);
?>
