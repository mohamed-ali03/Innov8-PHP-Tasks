<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/master.css">
    <title>Sign In Page</title>
</head>

<body>

    <?php
    include "../classes/db_class.php";
    $msg;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $user = DBClass::getUserInfoFromDB($email);
        if ($user) {
            if ($user->password === htmlspecialchars($_POST["password"])) {
                header("location: homepage.php?email:" . urlencode($user->email));
            } else {
                $msg = "password is not correct";
            }
        } else {
            $msg = "User not found";
        }
    }

    ?>

    <form class="submission-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <p class="headers">Sign In</p>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" minlength="8" maxlength="12" required>
        </div>

        <input type="submit" value="Sign In" class="btn">
        Don't have an Account? <a href="signUP.php">Sign Up</a>
    </form>

    <?php
    if ($msg) {
        echo '<p class="status-msg">' . $msg . '</p>';
    }
    ?>
</body>

</html>