<?php

require_once "../../../config/Login.php";
require_once "../../../config/ValidateUserInput.php";
if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $validateUserInput = new ValidateInputField($_POST, "/Project/Dashboard/users/login?message=Invalidusercredentials");
    $validateUserInput->validateInput();

    $userName = $_POST['Username'];
    $password = $_POST['Password'];




    $findUser = new Login($userName, $password);
    if ($findUser->userFound()) {
        header("Location:/Project/Dashboard/");
        exit();
    } else {
        header("Location:/Project/Dashboard/users/login?message=Invalidusercredentials");
        exit();
    }
    ;
}


?>