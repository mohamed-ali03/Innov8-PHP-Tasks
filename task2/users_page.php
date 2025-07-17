<!DOCTYPE html>
<html>

<head>
    <title>Users Page</title>
</head>

<body>
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
            include "db_class.php";
            $users = DBClass::getAllUsersInfofromDB();

            foreach ($users as $user) {
                echo '<tr>
                        <td>' . $user->userName . '</td>
                        <td>' . $user->email . '</td>
                        <td>' . $user->gender . '</td>
                        <td>' . $user->hobbies . '</td>
                        <td>' . $user->country . '</td>
                        <td><a href="edit_page.php?email=' . urlencode($user->email) . '">Edit</a></td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>


</body>

</html>