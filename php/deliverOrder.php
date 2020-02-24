<?php
require_once('databaseHandler.php');
$db = new databaseHandler();
$result = $db->deliverOrder($_POST["oId"]);
$db->disconnectDB();
?>