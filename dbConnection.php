<?php

$dbConnection = mysqli_connect("localhost", "root", "root", "login_app");

if ($dbConnection) {
//    echo "connected";
} else {
    echo "not connected".mysqli_error($dbConnection);
}

function check_query($result): true|string
{
    global $dbConnection;
    if (!$result) {
        return "Error".mysqli_error($dbConnection);
    }
    return true;
}
