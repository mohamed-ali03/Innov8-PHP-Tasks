<!DOCTYPE html>
<html lang="en">

<head>

    <title>Sign In Page</title>
</head>

<body>

    <?php
    include "../classes/db_class.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $user = DBClass::getUserInfoFromDB($email);
        if ($user) {
            if ($user->password === htmlspecialchars($_POST["password"])) {
                header("location: homepage.php?email:" . urlencode($user->email));
            } else {
                echo "password is not correct";
            }
        } else {
            echo "User not found";
        }
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" minlength="8" maxlength="12" required>
        </div>

        <input type="submit">
        <br />
        Don't have an Account? <a href="signUP.php">Sign Up</a>
    </form>
</body>

</html>