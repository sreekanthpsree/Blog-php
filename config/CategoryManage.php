<?php

require_once __DIR__ . "\DataBase.php";

class CategoryManage
{
    private $db;
    function __construct()
    {
        $this->db = new Database();

    }

    function getCategory()
    {
        $this->db->query("SELECT * FROM `categories`");
        return $this->db->results();
    }
    function getCategoryById($id)
    {
        $this->db->query("SELECT * FROM `categories` WHERE Id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    function addCategory($categoryName, $categoryStatus)
    {
        $this->db->query("INSERT INTO `categories`(`categories`, `status`) VALUES (:categoryName,:categoryStatus)");
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryStatus', $categoryStatus);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function getActiveCategotires()
    {
        $this->db->query("SELECT * FROM `categories` WHERE `status`= 'active'");
        return $this->db->results();
    }
    function editCategory($id, $categoryName, $categoryStatus)
    {
        $this->db->query("UPDATE `categories` SET `categories`=:categoryName,`status`=:categoryStatus WHERE Id = :id");
        $this->db->bind(':id', intval($id));
        $this->db->bind(':categoryName', $categoryName);
        $this->db->bind(':categoryStatus', $categoryStatus);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function delteCategory($id)
    {
        $this->db->query("DELETE FROM `categories` WHERE Id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }




}


?>