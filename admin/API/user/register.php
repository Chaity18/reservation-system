<?php
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$userPassword = sha1($_REQUEST['password']);

require_once '../../config/conf.php';
/** @var $conn */

$query = "SELECT * FROM users where email = '$email' OR phone = '$phone'";
$stmt = $conn->prepare($query);
$stmt->execute();
if ($stmt->rowCount()) {
    $response = array('status' => false, 'message' => 'user already exist');
} else {
    $insertQuery = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `phone`, `password`) 
                    VALUES ('$firstName', '$lastName', '$email', '$phone', '$userPassword')";
    $insertStmt = $conn->prepare($insertQuery);
    if ($insertStmt->execute()) {
        $response = array('status' => true, 'message' => 'successfully registered new user');
    }
}
echo json_encode($response);
