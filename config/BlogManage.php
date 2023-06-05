<?php
require_once __DIR__ . "\DataBase.php";
// session_start();
class BlogManage
{
    private $db;
    private $limit = 10;
    private $page;
    public $searchText;
    function __construct()
    {
        $this->db = new Database();
    }
    function setPageNo($page)
    {
        $this->page = $page;
    }
    function getPageNo()
    {
        return $this->page;
    }
    function getPostS($pageNumber = 0)
    {
        $this->page = (($pageNumber) * $this->limit);
        $this->db->query("SELECT * FROM `blog` ORDER BY id DESC LIMIT $this->page,$this->limit ");
        // print_r($this->db->results());
        return $this->db->results();
    }
    function getPostSTable()
    {
        if ($_SESSION['position'] === 'Admin') {
            $this->db->query("SELECT * FROM `blog`");
        } else {
            $this->db->query("SELECT * FROM `blog` WHERE author = :author");
            $this->db->bind(':author', $_SESSION['Username']);
        }
        return $this->db->results();
    }
    function getPostById($id)
    {
        $this->db->query("SELECT * FROM `blog` WHERE Id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    function getPostByCategory($category = "All", $pageNumber = 1)
    {
        $this->page = (($pageNumber - 1) * $this->limit);
        if ($category == "All") {
            $this->db->query("SELECT * FROM `blog` ORDER BY id DESC LIMIT $this->page,$this->limit ");
            return $this->db->results();
        } else {
            $this->db->query("SELECT * FROM `blog` WHERE category = :category ORDER BY id DESC LIMIT $this->page,$this->limit ");
            $this->db->bind(':category', $category);
            return $this->db->results();
        }
    }
    function addBlog($title, $content, $category, $imageName)
    {

        $this->db->query("INSERT INTO `blog`(`title`, `content`, `category`, `image`, `author`) VALUES (:title,:content,:category,:image,:author)");
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':category', $category);
        $this->db->bind(':image', $imageName);
        $this->db->bind(':author', $_SESSION['Username']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function updateBlog($id, $title, $content, $category)
    {
        $this->db->query("UPDATE `blog` SET `title`=:title,`content`=:content,`category`=:category WHERE Id = :id");
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':category', $category);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function deleteBlog($id)
    {
        $this->db->query("DELETE FROM `blog` WHERE Id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function searchBlog($searchText, $pageNumber)
    {
        $this->page = (($pageNumber - 1) * $this->limit);
        $this->db->query("SELECT * FROM `blog` WHERE title LIKE :search_text OR content LIKE :search_text ORDER BY id DESC LIMIT $this->page,$this->limit");
        $this->db->bind(':search_text', "%" . $searchText . "%");
        $this->searchText = $searchText;
        return $this->db->results();
    }
    function getBlogBySearchAndCategory($category = "All", $searchText = "All", $pageNumber = 1)
    {
        $this->page = (($pageNumber - 1) * $this->limit);
        if ($category === "All") {
            $this->db->query("SELECT * FROM `blog` WHERE title LIKE :search_text OR content LIKE :search_text ORDER BY id DESC LIMIT $this->page,$this->limit");
            $this->db->bind(':search_text', "%" . $searchText . "%");
        } else {
            $this->db->query("SELECT * FROM `blog` WHERE category = :category AND (title LIKE :search_text OR content LIKE :search_text) ORDER BY id DESC LIMIT $this->page,$this->limit");
            $this->db->bind(':category', $category);
            $this->db->bind(':search_text', "%" . $searchText . "%");
        }
        return $this->db->results();
    }
    function pageCount($category = "All", $pageNumber = 1, $searchText = "All")
    {
        $searchWord = isset($searchText) ? $searchText : "All";
        $this->page = (($pageNumber - 1) * $this->limit);
        if ($category == "All" && $searchWord == "All") {
            $this->db->query("SELECT count(Id) AS id FROM `blog` ");
        } elseif ($category !== "All") {
            $this->db->query("SELECT count(Id) AS id FROM `blog`WHERE category = :category ");
            $this->db->bind(':category', $category);
        } elseif ($searchWord !== "All") {
            $this->db->query("SELECT count(Id) AS id FROM `blog` WHERE title LIKE :search_text OR content LIKE :search_text");
            $this->db->bind(':search_text', "%" . $searchWord . "%");
        }
        $result = $this->db->results();
        $total = $result[0]['id'];
        $pages = ceil($total / $this->limit);
        return $pages;
    }
}
?>