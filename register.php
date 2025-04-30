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
            <h2>Create your Account</h2>
            <label for="username">Username:</label>
            <input placeholder="Enter your username" id="username" type="text" name="username" required>

            <label for="email">Email:</label>
            <input placeholder="Enter your email" id="email" type="email" name="email" required>

            <label for="password">Password:</label>
            <input placeholder="Enter your password" id="password" type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input placeholder="Confirm your password" id="confirm_password" type="password" name="confirm_password"
                   required>

            <input type="submit" value="Register">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
mysqli_close($dbConnection);
?>
