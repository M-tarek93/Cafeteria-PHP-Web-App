<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>All Products</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="../../assets/css/styles.css" />
</head>

<body>
    <main class="admin-all-products">
        <section class="main-padding">
            <div class="container">
                <h1>All Products</h1>
                <div class="add-product">
                    <a href="addProduct.php" class="btn btn-info">Add
                        Product</a>
                </div>

                <!-- products-panel -->
                <div class="products-panel">

                    <?php
                        require_once("databaseHandler.php");
                        $db = new databaseHandler ();
                        $allProducts = $db->selectAllProducts();               
                            // foreach($allProducts as $product){
                            //    echo " 
                            // <tr class='each-product'>
                            //     <td>".$product['name']."</td>
                            //     <td><span>".$product['price']."</span> EGP</td>
                            //     <td>
                            //         <img src='".$product['image']."' width='50' height'50' alt='' />
                            //     </td>
                            //     <td>
                            //         <div>
                            //             <button class='available btn btn-primary'>"
                            //              .$product['isAvailable'].   
                            //             "</button>";
                            //        echo"<a href='editProductForm_controller.php?id=";echo $product['id']."'> <button class='edit btn btn-secondary'>edit</button> </a>";
                            //     echo"<a href='deleteProduct_controller.php?id=";echo $product['id']."'> <button class='edit btn btn-secondary'>delete</button> </a>";
                            //        echo" </div>
                            //     </td>
                            // </tr>";
                            // }

                        echo '<table class="table table-bordered justify-content-center text-center"><tr class="thead-dark"><th>Product Name</th><th>price</th><th>image</th>
                        <th>Category</th><th>Availability</th><th colspan=2>Action</th></tr>';
                        foreach ($allProducts as $product) {
                            echo "<tr><td class='align-middle'>" . $product['name']. "</td>
                            <td class='align-middle'>" . $product['price']. "$</td>
                            <td class='align-middle'>
                            <img class='img-thumbnail rounded' width=200px height=200px src = ../assets/images/products/". $product['image']. ">
                            </td><td class='align-middle'>";
                            $category = $db->getCategory($product['category']);
                            echo $category[0]["name"] . "</td><td class='align-middle'>";
                            if ($product['isAvailable']==1){echo "Available";}else{echo "Unavailable";}
                            echo "</td><td class='align-middle'><a href=editProduct.php/?name=".$product['name'].
                            "&price=".$product['price']."&category=".$product['category']."&image=".$product['image']."&isAvailable=".$product['isAvailable']."&id=".$product['id'].">
                            <button class='btn btn-primary'>update</button></a></td><td class='align-middle'><a href=deleteProduct.php/?name=".$product['name'].">
                            <button class='btn btn-danger'>delete</button></a></td>
                            
                            </tr>" ;
                        }
                        echo '</table>';
                    ?>
                </div>
            </div>
        </section>
    </main>

    <script src="../../assets/js/jquery-3.3.1.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/modules/05_all-products.js"></script>
</body>

</html>