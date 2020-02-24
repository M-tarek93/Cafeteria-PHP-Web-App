<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $pathStripped = preg_replace('/\s/', '', $_FILES['image']['name']);
    $db->updateUser($_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext'], $pathStripped, $_POST['role']);
    var_dump($_POST);
    $db->disconnectDB();
    $path = "../assets/images/avatars/" . $pathStripped;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    header("Location: allUsers.php");
?>