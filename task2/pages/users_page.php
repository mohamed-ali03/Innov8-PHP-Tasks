<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/master.css">
    <title>Users Page</title>
</head>

<body>
    <?php
    include "../classes/db_class.php";
    $status = false;
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $email = $_GET["email"];
        if ($email) {
            $status = DBClass::deleteUser($email);
        }
    }
    ?>
    <table>
        <caption>
            <h1>User Data Table</h1>
        </caption>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Hobbies</th>
                <th>Country</th>
                <th>Modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = DBClass::getAllUsersInfofromDB();

            foreach ($users as $user) {
                echo '<tr>
                        <td>' . $user->userName . '</td>
                        <td>' . $user->email . '</td>
                        <td>' . $user->gender . '</td>
                        <td>' . $user->hobbies . '</td>
                        <td>' . $user->country . '</td>
                        <td>
                            <a href="signUP.php?email=' . urlencode($user->email) . '">Edit</a>
                            <a href="users_page.php?email=' . urlencode($user->email) . '">Delete</a>
                        </td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
    <a href="homepage.php" class="my-link">Go To Home Page</a>

    <?php
    if ($status) {
        echo '<p class="status-msg">User is Deleted successfully</p>';
    }
    ?>



</body>

</html>