<?php

class UserClass
{
    public $userName;
    public $email;
    public $password;
    public $gender;
    public $hobbies;
    public $country;

    public function __construct($userName, $email, $password, $gender, $hobbies, $country)
    {
        $this->userName = htmlspecialchars($userName);
        $this->email = htmlspecialchars($email);
        $this->password = htmlspecialchars(md5($password));
        $this->gender = htmlspecialchars($gender);
        $this->hobbies = htmlspecialchars($hobbies);
        $this->country = htmlspecialchars($country);
    }

}
?>