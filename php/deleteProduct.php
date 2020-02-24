<?php
require_once ("databaseHandler.php");
 $product= new databaseHandler ();

 $name=$_GET['id'];
 $product->deleteProduct($name);

 header("Location: ../allProducts.php");
