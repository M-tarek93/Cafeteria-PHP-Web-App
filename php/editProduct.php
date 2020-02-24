<?php
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $db->updateProduct($_POST['id'],$_POST['name'], $_POST['price'],  $_FILES['image']['name'],$_POST['category'],$_POST['isAvailable']);
    // var_dump($_POST);
    $db->disconnectDB();
    $path = "../assets/images/products/" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    header("Location: allProducts.php");
    ?>