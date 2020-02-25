<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $db->connectDB();
    $userName=$_POST['username'];
    $email= $_POST['email'];
    $password=$_POST['password'];
    $roomNum=$_POST['roomNum'];
    $exten=$_POST['ext'];
    $file_name = $_FILES['file']['name'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $db->insertUser($userName,$password, $email,$roomNum, $exten, $_FILES['file']['name']);
    move_uploaded_file($file_tmp,"../assets/images/avatars/" . $file_name);
    $db->disconnectDB();
    if ($_POST['URL']=="register"){
        header("Location: ../html/login.html");
    }else if($_POST['URL']=="addUser"){
        header("Location: allUsers.php");
    }
