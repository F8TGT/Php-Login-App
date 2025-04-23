<?php

$current_page = basename($_SERVER['PHP_SELF']);
echo $current_page;
?>

<nav>
    <ul>
        <li>
            <a class="<?php
            if ($current_page === "index.php") {
                echo "active";
            } ?>" href="index.php">Home</a>
        </li>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li>
                <a class="<?php
                if ($current_page === "admin.php") {
                    echo "active";
                } ?>" href="admin.php">Admin</a>
            </li>
            <li>
                <a class="<?php
                if ($current_page === "logout.php") {
                    echo "active";
                } ?>" href="logout.php">Logout</a>
            </li>
        <?php
        else: ?>
            <li>
                <a class="<?php
                if ($current_page === "register.php") {
                    echo "active";
                } ?>" href="register.php">Register</a>
            </li>
            <li>
                <a class="<?php
                if ($current_page === "login.php") {
                    echo "active";
                } ?>" href="login.php">Login</a>
            </li>
        <?php
        endif; ?>
    </ul>
</nav>
