<?php
require_once "../../../config/commentsManage.php";
$comments = new CommentsManage();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['id']) {
    $comments->approveComment($_GET['id']);
    header("Location:/Project/Dashboard/comments/");
    exit();
}
?>