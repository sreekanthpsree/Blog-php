<?php


require_once "DataBase.php";


class AuthenticationManage
{

    private $db;
    private $userName;
    private $email;
    private $phoneNumber;
    private $password;
    private $status;
    private $userType;
    private $userExist;
    public $noUserName;
    public $error;
    private $userEdited;
    private $userAdded;


    function __construct($userName = null, $email = null, $phoneNumber = null, $password = null, $status = null, $userType = null)
    {
        $this->db = new Database();
        $this->userName = $userName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->status = $status;
        $this->userType = $userType;
    }
    function userExist()
    {
        $this->checkUserExists();
        if ($this->userExist) {
            echo true;
            return $this->userExist;
        } else {
            echo false;
        }
    }
    function userExistUpdate($id)
    {
        $this->checkUserExistsUpdate($id);
        if ($this->userExist) {

            return $this->userExist;
        } else {
            echo false;
        }
    }
    function addUserStatus()
    {
        $this->addUser();
        if ($this->userAdded) {
            return true;
        } else {
            return false;
        }

    }
    function userEdited($id)
    {
        $this->editUser($id);
        if ($this->userEdited) {
            return true;
        } else {
            return false;
        }
    }
    protected function checkUserExists()
    {
        $this->db->query("SELECT * FROM `users_table` WHERE Username=:username OR Email=:email OR Phonenumber=:phoneNumber");
        $this->db->bind(':username', $this->userName);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':phoneNumber', $this->phoneNumber);
        $this->db->execute();
        $users = $this->db->rowCount();

        if ($users > 0) {
            $this->userExist = true;
            return true;
        } else {
            $this->userExist = false;
            return false;
        }

    }
    protected function checkUserExistsUpdate($id)
    {
        echo $id;
        $this->db->query("SELECT * FROM `users_table` WHERE (Username=:username OR Email=:email OR Phonenumber=:phoneNumber)  AND Id != :id");
        $this->db->bind(':username', $this->userName);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':phoneNumber', $this->phoneNumber);
        $this->db->bind(':id', $id);
        $this->db->execute();
        $users = $this->db->rowCount();
        if ($users > 0) {
            $this->userExist = true;

        } else {
            $this->userExist = false;

        }
    }
    protected function addUser()
    {
        $encrptedPassword = password_hash(
            $this->password,
            PASSWORD_DEFAULT
        );
        $this->db->query("INSERT INTO `users_table`( `Username`, `Password`, `Email`, `Phonenumber`, `status`, `position`) VALUES (:username,:password,:email,:phoneNumber,:status,:position)");
        $this->db->bind(':username', $this->userName);
        $this->db->bind(':password', $encrptedPassword);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':phoneNumber', $this->phoneNumber);
        $this->db->bind(':status', $this->status);
        $this->db->bind(':position', $this->userType);

        if ($this->db->execute()) {
            $this->userAdded = true;
        } else {
            $this->userAdded = false;
        }
    }
    protected function editUser($id)
    {
        $this->db->query("UPDATE `users_table` SET `Username`=:userName,`Password`=:Password,`Email`=:Email,`Phonenumber`=:Phonenumber,`status`=:status,`position`=:position WHERE Id = :id");
        $encrptedPassword = password_hash(
            $this->password,
            PASSWORD_DEFAULT
        );

        $this->db->bind(':userName', $this->userName);
        $this->db->bind(':Password', $encrptedPassword);
        $this->db->bind(':Email', $this->email);
        $this->db->bind(':Phonenumber', $this->phoneNumber);
        $this->db->bind(':status', $this->status);
        $this->db->bind(':position', $this->userType);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            $this->userEdited = true;
        } else {
            $this->userEdited = false;
        }
    }

}