<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "login_app";

$dbConnection = mysqli_connect($host, $username, $password, $database);

if (!$dbConnection) {
    die("Connection failed: ".mysqli_connect_error());
}

function check_query($dbConnection, $result): true|string
{
    if (!$result) {
        return "Error".mysqli_error($dbConnection);
    }
    return true;
}

function user_exists($dbConnection, $username): bool
{
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($dbConnection, $sql);
    return mysqli_num_rows($result) > 0;
}

function create_user($dbConnection, $username, $email, $password): mysqli_result|bool
{
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
    return mysqli_query($dbConnection, $sql);
}

function update_user($dbConnection, $user_id, $new_username, $new_email): mysqli_result|bool
{
    $sql = "UPDATE users SET email = '$new_email', username = '$new_username' WHERE id = $user_id";
    return mysqli_query($dbConnection, $sql);
}

function delete_user($dbConnection, $user_id): mysqli_result|bool
{
    $sql = "DELETE FROM users WHERE id = $user_id";
    return mysqli_query($dbConnection, $sql);
}
