<?php
require_once "../../../config/CategoryManage.php";

$categoryManage = new CategoryManage();

if (isset($_POST)) {

    $categoryManage->delteCategory($_GET['id']);
    header("Location:/Project/Dashboard/categories/");
    exit();

}

?>