<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
</head>

<body>
    <?php
    $email = $_GET["email"];
    $conn = new mysqli("localhost", "root", "", "test_db");
    if ($conn->connect_error) {
        die("Connection Failed :" . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT userName, email, gender, hobbies, country FROM USERS WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "Name: " . $row["userName"], "<br />";
            echo "Email: " . $row["email"], "<br />";
            echo "Gender: " . $row["gender"], "<br />";
            echo "Hobbies: " . $row["hobbies"], "<br />";
            echo "Country: " . $row["country"], "<br />";
        } else {
            echo "User Not Found";
        }
        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>