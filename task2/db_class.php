<?php
include "user_class.php";
class DBClass
{
    public static $conn;

    public static function sendUserInfoToDB(UserClass $class)
    {
        if (self::$conn->connect_error) {
            die("Connection Faild: " . self::$conn->connect_error);
        } else {
            $stmt = self::$conn->prepare("INSERT INTO USERS(userName,email,password,gender,hobbies,country) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $class->userName, $class->email, $class->password, $class->gender, $class->hobbies, $class->country);
            $stmt->execute();
        }

    }

    static public function getAllUsersInfofromDB(): array
    {
        $users = [];
        if (self::$conn->connect_error) {
            die("Connection Faild: " . self::$conn->connect_error);
        } else {
            $result = self::$conn->query("SELECT * FROM USERS");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = new UserClass($row["userName"], $row["email"], $row["password"], $row["gender"], $row["hobbies"], $row["country"]);
                }
            }
        }
        return $users;
    }


    static public function getUserInfoFromDB(string $email)
    {
        $email = htmlspecialchars($email);
        if (self::$conn->connect_error) {
            die("Connection Faild: " . self::$conn->connect_error);
        } else {
            $stmt = self::$conn->prepare("SELECT * FROM USERS WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = new UserClass($row["userName"], $row["email"], $row["password"], $row["gender"], $row["hobbies"], $row["country"]);
                }
            }
        }
    }


    public function __destruct()
    {
        self::$conn->close();
    }
}

$conn = new mysqli("localhost", "root", "", "test_db");
DBClass::$conn = $conn;

