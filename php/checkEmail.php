<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $result = $db->CheckEmailExist($_POST["email"]);
    if( $result > 0){
        echo $result;
    }
    $db->disconnectDB();
?>