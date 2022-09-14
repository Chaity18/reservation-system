<?php
session_start();
if (!isset($_SESSION['adminEmail'] ) && !isset($_COOKIE['rememberMe'])) {
    header('location: index.php');
}

require_once 'helper/header.php';
require_once 'helper/footer.php';