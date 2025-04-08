<?php

global $dbConnection;
include 'dbConnection.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($dbConnection, $_POST['username']);
    $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
    $password = mysqli_real_escape_string($dbConnection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($dbConnection, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "passwords do not match";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($dbConnection, $sql)) {
            echo "DATA INSERTED";
        } else {
            echo "SOMETHING HAPPENED not data inserted, error: ".mysqli_error($dbConnection);
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
    <title>Register</title>
</head>
<body>
<form method="POST" action="">
    <label for="username">Username:</label>
    <input id="username" type="text" name="username" required>

    <label for="email">Email:</label>
    <input id="email" type="email" name="email" required>

    <label for="password">Password:</label>
    <input id="password" type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input id="confirm_password" type="password" name="confirm_password" required>

    <input type="submit" value="Register">
</form>
</body>
</html>
