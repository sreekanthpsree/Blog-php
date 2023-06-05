<?php

require_once "deleteUser.php";
session_start();
if ($_SESSION['position'] !== "Admin") {
    header("Location:/Project/Dashboard/?error=NoAccess");
    exit();
}
$delete = new DeleteUser();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    echo "dle";
    $delete->deletedUser($_GET['id']);
    header("Location:/Project/Dashboard/users/");
    exit();
}
?>