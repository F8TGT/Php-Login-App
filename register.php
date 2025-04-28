<?php

include 'partials/header.php';
include 'partials/navigation.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($dbConnection, $_POST['username']);
    $email = mysqli_real_escape_string($dbConnection, $_POST['email']);
    $password = mysqli_real_escape_string($dbConnection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($dbConnection, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($dbConnection, $sql);

        if (mysqli_num_rows($result) === 1) {
            $error = "username already exists, please choose another one";
        }
    }

    if (empty($error)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

        if (mysqli_query($dbConnection, $sql)) {
            echo "DATA INSERTED";
        } else {
            $error = "SOMETHING HAPPENED not data inserted, error: ".mysqli_error($dbConnection);
        }
    }
}
?>

<div class="container">
    <h2>Register</h2>
    <?php
    if ($error): ?>
        <p style="color:red">
            <?php
            echo $error; ?>
        </p>
    <?php
    endif; ?>
    <div class="form-container">
        <form method="POST" action="">
            <label for="username">Username:</label><br>
            <input id="username" type="text" name="username" required><br><br>

            <label for="email">Email:</label><br>
            <input id="email" type="email" name="email" required><br><br>

            <label for="password">Password:</label><br>
            <input id="password" type="password" name="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input id="confirm_password" type="password" name="confirm_password" required><br><br>

            <input type="submit" value="Register">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
mysqli_close($dbConnection);
?>
