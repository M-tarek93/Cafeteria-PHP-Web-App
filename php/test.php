<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $array=array();
    $result1 = $db->getMyOrderDetails(22);
    array_push($array, $result1);
    $result2 = $db->getMyOrderDetails(21);
    array_push($array, $result2);
    print_r($array);
?>