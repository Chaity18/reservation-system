<?php
session_start();
$email = $_REQUEST['email'];
$userPassword = sha1($_REQUEST['password']);

require_once '../../config/conf.php';
/** @var $conn */

$query = "SELECT * FROM users where email = '$email' AND password = '$userPassword'";
$stmt = $conn->prepare($query);
$stmt->execute();
if ($stmt->rowCount()) {
    $userData = $stmt->fetchAll();
    $userEmail = $userData[0]['email'];
    $isUserDeleted = $userData[0]['is_deleted'];
    $isUserApproved = $userData[0]['is_approved'];

    if ($isUserDeleted) {
        $response = array('status' => false, 'message' => 'user is deleted');
    } elseif (!$isUserApproved) {
        $response = array('status' => false, 'message' => 'user is not verified');
    } else {
        $_SESSION['userEmail'] = $userEmail;
        setcookie("userEmail", $userEmail, time() + (10 * 365 * 24 * 60 * 60), '/');
        $response = array('status' => true, 'message' => 'successfully logged in!');
    }
} else {
   $response = array('status' => false, 'message' => 'invalid email address or password');
}
echo json_encode($response);