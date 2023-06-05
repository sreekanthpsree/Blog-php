<?php

require_once "../../config/AuthenticationManage.php";
require_once "../../config/ValidateUserInput.php";
session_start();

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_POST);

    $userName = $_POST['Username'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['Phonenumber'];
    $password = $_POST['Password'];
    $status = $_POST['status'];
    $userType = $_POST['position'];

    global $errorArray;
    global $valueArray;

    $validateInput = new ValidateInputField($_POST, "/Project/Dashboard/users/signup/?error=InvalidUserInput");
    $validateInput->validateInput();

    $signUp = new AuthenticationManage($userName, $email, $phoneNumber, $password, $status, $userType);
    if ($_GET['method'] === "add") {
        if ($signUp->userExist()) {
            header("Location:/Project/Dashboard/users/login?error=userAlreadyExits");
            exit();
        }
        if (!isset($errorArray) && !$signUp->userExist()) {
            $userAddStatus = $signUp->addUserStatus();
            unset($_SESSION['valueArray']);
            unset($_SESSION['errorArray']);
            header("Location:/Project/Dashboard/users?message=userAddedSuccessfully");
            exit();
        }
    }
    if ($_GET['method'] === "edit") {
        if ($signUp->userExistUpdate($_GET['id'])) {
            header("Location:/Project/Dashboard/users?error=AnotherUserAlreadyExists");
            exit();
        }
        if (!isset($errorArray)) {

            $userAddStatus = $signUp->userEdited($_GET['id']);
            echo $userAddStatus;
            unset($_SESSION['valueArray']);
            unset($_SESSION['errorArray']);
            header("Location:/Project/Dashboard/users?message=userEditedSuccessfully");
            exit();
        }
    }


}





?>