<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $result = $db->UsernameExist($_POST["username"]);
    if( $result > 0){
        echo $result;
    }
    $db->disconnectDB();
?>