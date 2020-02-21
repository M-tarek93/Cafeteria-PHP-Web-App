<?php
require_once('databaseHandler.php');
$db = new databaseHandler();
$result = $db->cancelOrder($_POST["oId"]);
$db->disconnectDB();
?>