<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
</head>

<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "test_db");
    if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
    } else {
        $sql = "SELECT userName ,email ,gender ,hobbies ,country FROM USERS WHERE email='engmohamedali65@gmail.com'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            echo "Name: " . $row["userName"], "<br />";
            echo "Email: " . $row["email"], "<br />";
            echo "Gender: " . $row["gender"], "<br />";
            echo "Hobbies: " . $row["hobbies"], "<br />";
            echo "Country: " . $row["country"], "<br />";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    ?>
</body>

</html>