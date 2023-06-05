<?php
session_start();
require_once "../../config/commentsManage.php";
require_once "../../config/ValidateUserInput.php";


$commentManage = new CommentsManage();

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_GET['id'];
    echo $_POST['email'];


    //Checking input validation

    $validateUserInput = new ValidateInputField($_POST, "http://localhost/Project/pages/postDetailed.php?id=$id");
    $validateUserInput->validateInput();


    $postId = $_GET['id'];
    $commentManage->addComments($_POST['name'], $_POST['email'], $_POST['comment'], $postId);
    unset($_SESSION['valueArray']);
    unset($_SESSION['errorArray']);
    header("Location:/Project/pages/postDetailed.php?id=$postId");
    exit();
}

?>