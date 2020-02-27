<?php session_start();
if ($_SESSION['role']!="1"){
   header("Location: ../html/login.html");
    }
?>

<h1>Add Category</h1>
                <form action='addCategory.php' method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Category</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="category" placeholder="enter Category name" pattern="[a-zA-Z]{1,}" required/>

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="submit" name="submit">Save</button>
                        <button class="btn btn-danger" type="reset">reset</button>
                    </div>
                </form>

                    <?php

include 'databaseHandler.php';
$category = '';
if (isset($_POST['submit'])) {

$category = $_POST['category'];
$db=new databaseHandler();
$db->insertCategory($category);
header("Location: addProduct.php");
// header("Location: allProducts.php");

}


?>