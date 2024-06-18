<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/connection/connection.php");
include("{$_SERVER['DOCUMENT_ROOT']}/Application/Model/User.php");

if (isset($_POST["submit"])) {
    $user = User::GetInstance();
    $password = $_POST["password"];
    $username = $_POST["username"];
    if ($user->login($username, $password)) {
        $_SESSION["userid"] = $user->getUserid();
        $_SESSION["user"]= $user;
        $_SESSION["loggedin"] = true;
        header("location: ../View/index/index.php");
    }
}