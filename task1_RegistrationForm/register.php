<?php
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmedPassword = $_POST["cpassword"];
$gender = $_POST["gender"];
$hobbies = $_POST["hobbies"];
$country = $_POST["userCountry"];

if (empty($name) || empty($email) || empty($password) || empty($confirmedPassword) || empty($gender) || empty($hobbies) || empty($country)) {
    echo "Invalid Input";
} else if ($password != $confirmedPassword) {
    echo "password not matched confirmed password";
} else {
    $hobbiesStr = implode(", ", $hobbies);
    $conn = new mysqli("localhost", "root", "", "test_db");
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare('INSERT INTO USERS(userName,email,password,gender,hobbies,country) VALUES(?,?,?,?,?,?)');
        $stmt->bind_param('ssssss', $name, $email, $password, $gender, $hobbiesStr, $country);
        $stmt->execute();
        header("location: homepage.php?email=" . urlencode($email));
        $stmt->close();
        $conn->close();
        exit();
    }
}
?>