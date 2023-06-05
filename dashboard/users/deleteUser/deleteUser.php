<?php
require_once "../../../config/DataBase.php";

class DeleteUser
{
    private $db;
    private $deletedUser;
    function __construct()
    {

        $this->db = new Database();
    }

    function deletedUser($id)
    {
        $this->deleteUser($id);
        if ($this->deletedUser) {
            return true;
        } else {
            return false;
        }
    }
    protected function deleteUser($id)
    {
        $this->db->query("DELETE FROM `users_table` WHERE Id= :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            $this->deletedUser = true;
        } else {
            $this->deletedUser = false;
        }
    }
}

?>