<?php
require_once '../config/conf.php';
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $rememberMe = $_POST['remember_me'] ?? 'off';
    $query = "SELECT * FROM admin where email= '$email' AND password='$password'";
    /** @var $conn */
    $queryBuilder = $conn->prepare($query);
    $queryBuilder->execute();

    $res = $queryBuilder->fetchColumn(1);

    if ($queryBuilder->rowCount() > 0) {
        $_SESSION['adminEmail'] = $res;
        if ($rememberMe == 'on') {
            setcookie("rememberMe", true, time() + (10 * 365 * 24 * 60 * 60), '/');
        }
        header('location: ../dashboard.php');
    } else {
        setcookie("wrongPass", true, time() + 5, '/');
        header('location: ../index.php');
    }

}