<?php

require_once "../../../config/CategoryManage.php";
require_once "../../../config/ValidateUserInput.php";
$categories = new CategoryManage();
$categoryId = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST) {

    $id = $_GET['id'];
    $validateUser = new ValidateInputField($_POST, "/Project/Dashboard/categories/editCategory?error=InvalidInput&id=$id");
    $validateUser->validateInput();


    $categories->editCategory($_GET['id'], $_POST['category'], $_POST['status']);
    header("Location:/Project/Dashboard/categories/");
    exit();
}

?>