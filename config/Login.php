<?php

require_once __DIR__ . "\DataBase.php";
session_start();

class Login
{
    private $db;

    private $username;
    private $password;


    private $result;

    function __construct($username, $password)
    {
        $this->db = new Database();
        $this->username = $username;
        $this->password = $password;
    }

    function userFound()
    {
        $this->getUser();
        if ($this->result) {
            return $this->result;
        } else {
            return $this->result;
        }


    }
    protected function getUser()
    {

        $this->db->query("SELECT * FROM `users_table` WHERE Username=:username");
        $this->db->bind(':username', $this->username);
        $result = $this->db->single();
        if (password_verify($this->password, $result['Password']) && isset($result)) {
            $_SESSION['Username'] = $result['Username'];
            $_SESSION['Email'] = $result['Email'];
            $_SESSION['position'] = $result['position'];
            $_SESSION['Id'] = $result['Id'];
            $this->result = true;
        } else {

            $this->result = false;
        }

    }
}

?>