<?php
session_start();
require_once('databaseHandler.php');
$db = new databaseHandler();
$email = $_POST["email"];
$password = $_POST["password"];
$count=$db->CheckLogin($email,$password);
if($count!=1){
    $response_array['status'] = 'error_login_failed'; 
}else {
    $user=$db->getUserByEmail($email);
    $userString = $user['username'];
    $roleString= $user['role'];
    $_SESSION['username']=$userString;
    $_SESSION['role']=$roleString;
    $response_array['status'] = 'success'; 
    $response_array['role']= $roleString; 
}
    header('Content-type: application/json');
    echo json_encode($response_array);
?>