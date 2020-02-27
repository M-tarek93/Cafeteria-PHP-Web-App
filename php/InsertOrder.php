<?php
    
    session_start();

    require_once 'databaseHandler.php';
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){

        if( isset( $_POST['order'] ) && !empty( $_POST['room'] ) && !empty($_POST['ext']) ){
            
            if( $_SESSION['role'] == 0 ){
                $username = $_SESSION['username'];
            } else {
            
                if(empty($_POST['username'])){
                    header("Location: displayUserOrders.php?msg=empty");
                    exit();
                }
                $username = $_POST['username'];
            }

            $db = new databaseHandler();
            $db->insertOrder($_POST['notes'], $_POST['room'], $_POST['ext'], $_POST['totalprice'], $username);
            $lastOrderId = $db->lastInsertId();
            foreach($_POST['order'] as $order ){
                $productID = explode(":", $order)[0];
                $number = explode(":", $order)[1];
                for( $i = 0; $i < $number; $i++){
                    $db->insertOrderItem($lastOrderId, $productID);
                }
            }
            header("Location: displayUserOrders.php");
        } else {
            if( isset($_SERVER['HTTP_REFERER'])){
                header("Location: displayUserOrders.php?msg=empty");
            } else {
                header("Location: ../index.html");
            }
        }
    // } else {
    //     header("Location: displayUserOrders.php?msg=empty");
    }