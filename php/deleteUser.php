<?php
try {
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $db->deleteUser($_POST['username']);
    $db->disconnectDB();
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}