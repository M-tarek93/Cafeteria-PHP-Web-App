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
                <h1>Edit Product</h1>
                <form action='../editProduct.php' method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product </label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="enter product name" value="<?php echo $_GET['name'];?>" pattern="[a-zA-Z]{1,}" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Price</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="number" min="5.00" name="price" max="10000.00" placeholder="0.0" value="<?php echo $_GET['price'];?>" required/>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product Picture</label>
                        <div class="col-sm-6">
                            <input class="form-control"value="<?php echo $_GET['image'];?>" type="file" name="image" required/>
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
                     
                    </div>
             
                   
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="submit" name="submit">Save</button>
                        <button class="btn btn-danger" type="reset">reset</button>
                    </div>
                </form>
            </div>
        </section>
    </main>