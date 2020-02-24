<?php
require_once('databaseHandler.php');
$db = new databaseHandler();
$db->getUserOrders($_POST["usr"],$_POST["from"],$_POST["to"]);
$db->disconnectDB();
?>