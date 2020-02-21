
<?php
    
    require_once("databaseHandler.php");
    $product= new databaseHandler ();
    $allProducts= $product->selectAll();
    
    // header("Location: allProducts.php");

?>