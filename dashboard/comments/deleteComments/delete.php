<?php

require_once "../../../config/commentsManage.php";

$deleteComment = new CommentsManage();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['id']) {
    $deleteComment->deleteComments($_GET['id']);
    header("Location:/Project/Dashboard/comments/");
    exit();
}



?>