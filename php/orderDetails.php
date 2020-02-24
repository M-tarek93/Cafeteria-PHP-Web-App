<?php
require_once('databaseHandler.php');
$db = new databaseHandler();
$db->getOrderDetails($_POST["oId"]);
$db->disconnectDB();
?>