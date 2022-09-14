<?php
//session_start();
//unset($_SESSION['adminEmail']);
//unset($_COOKIE['rememberMe']);
//session_destroy();
//if (isset($_COOKIE['rememberMe'])) {
//    setcookie('rememberMe', '', -1);
//}
//
//header('location: ../index.php');
if (!isset($_SESSION)) { session_start(); }
$_SESSION = array();
session_destroy();

unset($_COOKIE['rememberMe']);
setcookie('rememberMe', null, -1, '/');

header("Location: ../index.php");