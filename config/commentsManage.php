<?php

require_once "DataBase.php";

class CommentsManage
{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }

    function getComments()
    {
        $this->db->query("SELECT * FROM `comments`");
        return $this->db->results();
    }
    function getCommentsByPost($postId)
    {
        $this->db->query("SELECT * FROM `comments` WHERE PostId = :id AND Approved = 1");
        $this->db->bind(':id', $postId);
        return $this->db->results();
    }
    function addComments($name, $email, $comment, $postId)
    {
        $this->db->query("INSERT INTO `comments`(`Name`, `Email`, `Comment`,`Approved`,`PostId`) VALUES (:name,:email,:comment,:approved,:postId)");
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':comment', $comment);
        $this->db->bind(':approved', false);
        $this->db->bind(':postId', $postId);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function notApprovedComments()
    {
        $this->db->query("SELECT * FROM `comments` WHERE Approved = 0");
    }
    function getPostName($id)
    {
        $this->db->query("SELECT `title` FROM `blog` WHERE Id =:id");
        $this->db->bind(':id', $id);
        $postArr = $this->db->results();
        foreach ($postArr as $postName) {
            return $postName;
        }
    }
    function approveComment($id)
    {
        echo $id;
        $this->db->query("UPDATE `comments` SET `Approved`=:status WHERE Id = :id");
        $this->db->bind(':status', true);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function getApprovalStatus($id)
    {
        $this->db->query("SELECT `Approved` FROM `comments` WHERE Id =:id");
        $this->db->bind(':id', $id);
        $commentArr = $this->db->results();
        foreach ($commentArr as $status) {
            return $status;
        }
    }
    function deleteComments($id)
    {
        $this->db->query("DELETE FROM `comments` WHERE Id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>