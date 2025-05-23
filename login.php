<?php

include 'partials/header.php';
include 'partials/navigation.php';

if (is_user_logged_in()) {
    redirect('admin.php');
}
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

<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Login</h2>
            <?php
            if ($error): ?>
                <p style="color:red">
                    <?php
                    echo $error; ?>
                </p>
            <?php
            endif; ?>
            <label for="username">Username:</label>
            <input id="username" type="text" name="username" required>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
mysqli_close($dbConnection);
?>
