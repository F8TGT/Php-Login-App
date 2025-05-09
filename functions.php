<?php

function is_user_logged_in(){
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function redirect($location){
    header("Location: login.php");
    exit;
}

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

function full_month_date($date){
    return  date("F j Y",  strtotime($date));
}
