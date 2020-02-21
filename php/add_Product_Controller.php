<?php
include ("databaseHandler.php");

$dbObject = new databaseHandler();

$price = '';

$image = '';

$category = '';
$IsAvailable ='';
$productname = '';
$path = "../images/" . $_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'], $path);

if (isset($_POST['submit'])) {

    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $image = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : null;
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $IsAvailable=isset($_POST ['IsAvailable'] )  ? $_POST['IsAvailable'] : 1;
    $dbObject->insertProduct($name, $price, $category, $image,$IsAvailable);

    header("Location: addProduct.php");

}

include('addProduct.php');
