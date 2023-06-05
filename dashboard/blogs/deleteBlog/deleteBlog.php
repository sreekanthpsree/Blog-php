<?php
require_once "../../../config/BlogManage.php";

$blogManage = new BlogManage();
if (isset($_POST)) {
    echo $_GET['id'];
    $blogManage->deleteBlog($_GET['id']);
    header("Location:/Project/Dashboard/blogs/");
    exit();
}


?>