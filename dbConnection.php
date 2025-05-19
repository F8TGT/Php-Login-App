<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "login_app";

$dbConnection = mysqli_connect($host, $username, $password, $database);

if (!$dbConnection) {
    die("Connection failed: ".mysqli_connect_error());
}

function check_query($result): true|string
{
    global $dbConnection;
    if (!$result) {
        return "Error".mysqli_error($dbConnection);
    }
    return true;
}
