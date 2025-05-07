<?php

function setActiveClass($pageName)
{
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page === $pageName ? 'active' : '';
}

function getPageClass()
{
    return basename($_SERVER['PHP_SELF'], ".php");
}

function user_exists($dbConnection, $username)
{
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($dbConnection, $sql);

    return mysqli_num_rows($result) > 0;
}
