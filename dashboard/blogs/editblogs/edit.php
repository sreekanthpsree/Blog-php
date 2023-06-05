<?php
require_once "../../../config/BlogManage.php";
require_once "../../../config/ValidateUserInput.php";
session_start();

$manageBlog = new BlogManage();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST) {

    $id = $_GET['id'];
    $validateInput = new ValidateInputField($_POST, "/Project/Dashboard/blogs/editBlogs?error=Invalidinput&id=$id");
    $validateInput->validateInput();


    $manageBlog->updateBlog($_GET['id'], $_POST['title'], $_POST['content'], $_POST['category']);
    header("Location:/Project/Dashboard/blogs/");
    exit();

}


?>