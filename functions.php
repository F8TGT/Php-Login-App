<?php

use JetBrains\PhpStorm\NoReturn;

function is_user_logged_in(): bool
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

#[NoReturn]
function redirect($location): void
{
    header("Location: ".$location);
    exit;
}

function setActiveClass($pageName): string
{
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page === $pageName ? 'active' : '';
}

function getPageClass(): string
{
    return basename($_SERVER['PHP_SELF'], ".php");
}

function user_exists($dbConnection, $username): bool
{
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($dbConnection, $sql);
    return mysqli_num_rows($result) > 0;
}

function full_month_date($date): string
{
    return date("F j Y", strtotime($date));
}
