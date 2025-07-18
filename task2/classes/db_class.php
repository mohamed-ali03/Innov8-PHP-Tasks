<?php
include "../classes/user_class.php";
class DBClass
{
    public static $conn;

    public static function sendUserInfoToDB(UserClass $class)
    {
        if (empty($class->userName) || empty($class->email) || empty($class->password) || empty($class->cpassword) || empty($class->country) || empty($class->gender) || empty($class->hobbies)) {
            echo "Invaild Data Input";
        } else if ($class->password != $class->cpassword) {
            echo "Comfirmed Password not match Password";
        } else {
            if (self::$conn->connect_error) {
                die("Connection Faild: " . self::$conn->connect_error);
            } else {
                echo '<h1>' . $class->password . '</h1';
                $class = self::protectXSS($class);
                $stmt = self::$conn->prepare("INSERT INTO USERS(userName,email,password,gender,hobbies,country) VALUES(?,?,?,?,?,?)");
                $stmt->bind_param("ssssss", $class->userName, $class->email, $class->password, $class->gender, $class->hobbies, $class->country);
                $stmt->execute();
                echo "New User created Successfully<br/>";
            }
        }
    }

    private static function protectXSS(UserClass $class)
    {
        $class->userName = htmlspecialchars($class->userName);
        $class->email = htmlspecialchars($class->email);
        $class->password = htmlspecialchars($class->password);
        $class->cpassword = htmlspecialchars($class->cpassword);
        $class->gender = htmlspecialchars($class->gender);
        $class->hobbies = htmlspecialchars($class->hobbies);
        $class->country = htmlspecialchars($class->country);
        return $class;
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
                    $users[] = new UserClass($row["userName"], $row["email"], $row["password"], $row["password"], $row["gender"], $row["hobbies"], $row["country"]);
                }
            }
        }
        return $users;
    }


    static public function getUserInfoFromDB(string $email)
    {
        $user = null;
        if ($email) {
            $email = htmlspecialchars($email);
            if (self::$conn->connect_error) {
                die("Connection Faild: " . self::$conn->connect_error);
            } else {
                $stmt = self::$conn->prepare("SELECT * FROM USERS WHERE email=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user = new UserClass($row["userName"], $row["email"], $row["password"], $row["password"], $row["gender"], $row["hobbies"], $row["country"]);
                }
            }
        }
        return $user;
    }

    static public function updateUserInfoInDB(UserClass $class)
    {
        if (empty($class->userName) || empty($class->email) || empty($class->password) || empty($class->cpassword) || empty($class->country) || empty($class->gender) || empty($class->hobbies)) {
            echo "Invaild Data Input";
        } else if ($class->password != $class->cpassword) {
            echo "Comfirmed Password not match Password";
        } else {
            if (self::$conn->connect_error) {
                die("Connection Faild: " . self::$conn->connect_error);
            } else {

                $class = self::protectXSS($class);
                $stmt = self::$conn->prepare("  UPDATE USERS 
                                                SET userName=?, password=?, gender=?, hobbies=?, country=? 
                                                WHERE email=?");
                $stmt->bind_param("ssssss", $class->userName, $class->password, $class->gender, $class->hobbies, $class->country, $class->email);
                $stmt->execute();
                echo "User Data Updated Successfully<br/>";
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

