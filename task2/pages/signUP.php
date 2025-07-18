<!DOCTYPE html>
<html>

<head>
    <title>Sign Up Page</title>
</head>

<body>
    <?php
    include "../classes/db_class.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hobbies = $_POST["hobby"];
        $hobbiesStr = implode(", ", $hobbies);
        $user = new UserClass($_POST["name"], $_POST["email"], $_POST["password"], $_POST["cpassword"], $_POST["gender"], $hobbiesStr, $_POST["country"]);

        if ($_POST["status"] == "Update") {
            DBClass::updateUserInfoInDB($user);
        } else if ($_POST["status"] == "Submit") {
            DBClass::sendUserInfoToDB($user);
            header("location: signIn.php");
        }
        $email = $_POST["email"];
    } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $email = $_GET["email"];
    } else {
        $email = "";
    }

    $oldUser = $email != null;

    $user = $oldUser ? DBClass::getUserInfoFromDB($email) : new UserClass("", "", "", "", "", "", "");

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!---------------------------------------------- Name ------------------------------------------->
        <div>
            <label>Name</label>
            <?php echo '<input type="text" name="name" value="' . $user->userName . '" required>' ?>
        </div>
        <!---------------------------------------------- Email ------------------------------------------->
        <div>
            <label>Email</label>
            <?php
            echo '<input type="email" name="email" value="' . $user->email . '"';
            if ($oldUser) {
                echo 'readonly>';
            } else {
                echo '>';
            }
            ?>
        </div>
        <!---------------------------------------------- Password ---------------------------------------->
        <div>
            <label>Password</label>
            <?php echo '<input type="password" name="password" value="' . $user->password . '" minlength="8" maxlength="12" required>' ?>
        </div>

        <div>
            <label>Confirm Password</label>
            <?php echo '<input type="password" name="cpassword" value="' . $user->cpassword . '" minlength="8" maxlength="12" required>' ?>
        </div>
        <!---------------------------------------------- Gender ----------------------------------------->
        <label>Gender</label>
        <div>
            <input id="m" type="radio" name="gender" value="male" required <?php
            if ($user->gender == "male") {
                echo "checked";
            }
            ?>>
            <label for="m">Male</label>
        </div>

        <div>
            <input id="f" type="radio" name="gender" value="female" <?php
            if ($user->gender == "female") {
                echo "checked";
            }
            ?>>
            <label for="f">Female</label>
        </div>

        <div>
            <input id="o" type="radio" name="gender" value="other" <?php
            if ($user->gender == "other") {
                echo "checked";
            }
            ?>>
            <label for="o">Other</label>
        </div>
        <!---------------------------------------------- Hobbies ------------------------------------------->
        <label>Hobbies</label>
        <div>
            <input id="r" type="checkbox" name="hobby[]" value="Reading" <?php
            if (str_contains($user->hobbies, "Reading")) {
                echo "checked";
            }
            ?>>
            <label for="r">Reading</label>
        </div>

        <div>
            <input id="t" type="checkbox" name="hobby[]" value="Traveling" <?php
            if (str_contains($user->hobbies, "Traveling")) {
                echo "checked";
            }
            ?>>
            <label for="t" t>Traveling</label>
        </div>


        <div>
            <input id="s" type="checkbox" name="hobby[]" value="Sports" <?php
            if (str_contains($user->hobbies, "Sports")) {
                echo "checked";
            }
            ?>>
            <label for="s">Sports</label>
        </div>

        <div>
            <input id="ot" type="checkbox" name="hobby[]" value="Other" <?php
            if (!$olduser) {
                echo "checked";
            } else if (str_contains($user->hobbies, "Other")) {
                echo "checked";
            }
            ?>>
            <label for="ot">Other</label>
        </div>
        <!---------------------------------------------- Country ------------------------------------------->
        <label>Country</label>
        <select name="country" required>
            <option value="Egypt">Egypt</option>
            <option value="USA">USA</option>
            <option value="German">German</option>
            <option value="India">India</option>
        </select>
        <br />
        <?php
        if ($oldUser)
            echo '<input type="submit" name="status" value="Update">';
        else
            echo '<input type="submit" name="status" value="Submit">';
        ?>
        <input type="reset">
        <br />
        Already have an Email? <a href="signIn.php">Sign In</a>

    </form>
</body>

</html>