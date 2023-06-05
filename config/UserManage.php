<?php

require_once __DIR__ . "\DataBase.php";


class UserManage
{

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function getUsers()
    {
        $this->db->query("SELECT * FROM `users_table`");
        return $this->db->results();
    }
    function getUserById($id)
    {
        $this->db->query("SELECT * FROM `users_table` WHERE Id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();

    }


}

?>