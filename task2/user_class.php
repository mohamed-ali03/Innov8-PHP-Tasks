<?php

class UserClass
{
    public $userName;
    public $email;
    public $password;
    public $cpassword;
    public $gender;
    public $hobbies;
    public $country;

    public function __construct($userName, $email, $password, $cpassword, $gender, $hobbies, $country)
    {
        $this->userName = htmlspecialchars($userName);
        $this->email = htmlspecialchars($email);
        $this->password = htmlspecialchars(($password));
        $this->cpassword = htmlspecialchars(($cpassword));
        $this->gender = htmlspecialchars($gender);
        $this->hobbies = htmlspecialchars($hobbies);
        $this->country = htmlspecialchars($country);
    }

}
?>