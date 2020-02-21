<?php
try {
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $db->deleteUser($_GET['username']);
    $db->disconnectDB();
    header("Location: ../allUsers.php");
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}