<?php session_start();
if ($_SESSION['role']!="1"){
   header("Location: ../html/login.html");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="add-product">
        <section class="main-padding">
            <div class="container">
                <h1>Add Product</h1>
                <form action='addProduct.php' method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="enter product name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Price</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="number" min="5.00" name="price" max="10000.00" placeholder="0.0" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Category</label>
                  
                        <div class="col-sm-4">
                            <select name="category" id='select' class="form-control">

                                <optgroup label='categories'>
                                <?php 
                                    include ("databaseHandler.php");
                                    $db = new databaseHandler();
                                    $categories = $db->getAllCategories();
                                    foreach ($categories as $category) {
                                        echo "<option value='". $category['id'] ."'>". $category['name'] ."</option>";
                                    }
                                ?>
                                </optgroup>


                            </select>
                       
                        </div>
                        <div class="col-sm-2">
                            <a href='addCategory.php'
                                class="btn btn-info w-100">Add Category</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product Picture</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="file" name="img" required/>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="submit" name="submit">Save</button>
                        <button class="btn btn-danger" type="reset">reset</button>
                    </div>
                </form>
                <a href="allProducts.php"><button class="btn btn-info">Go back to all Products</button></a>
            </div>
        </section>
    </main>

    <?php
        $price = '';
        $image = '';
        $category = '';
        $isAvailable ='';
        $productname = '';
        
        if (isset($_POST['submit'])) {
            
            $name = $_POST['name'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['img']['name'];
            $db->insertProduct($name, $price, $category, $image);
            $path = "../assets/images/products/" . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], $path);
            header("Location: addProduct.php");
        }
    ?>
    
    <script>
        function Delete() {

            var el = document.querySelector('select');

            var newEl = document.createElement('input');
            newEl.setAttribute('type', 'text');
            newEl.setAttribute('placeholder', "enter product name");
            newEl.name = "category";

            el.parentNode.replaceChild(newEl, el);

        }
    </script>


</body>

</html>