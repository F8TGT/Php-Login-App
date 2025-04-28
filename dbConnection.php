<?php

$dbConnection = mysqli_connect("localhost", "root", "root", "login_app");

if ($dbConnection) {
//    echo "connected";
} else {
    echo "not connected".mysqli_error($dbConnection);
}
