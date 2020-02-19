<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assests/bootstrap/css/bootstrab.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assests/bootstrap/css/styles.css" />

</head>

<body>
    <main class="add-product">
        <section class="main-padding">
            <div class="container">
                <h1>Add Product</h1>
                <form action='add_Product_Controller.php' method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="enter product name" pattern="[a-zA-Z]{1,}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Price</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="number" min="5.00" name="price" max="10000.00" placeholder="0.0" />
                        </div>
                        <div class="col-sm-1">
                            <span>EGP</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">
                            <select name="category" id='select' class="form-control">

                                <optgroup label='Drinks'>
                                    <option value='".$category[' category']</option> <option value='Hot Drinks'>Hot Drinks</option>
                                    <option value='Cold Drinks'>Cold Drinks</option>
                                </optgroup>


                            </select>
                        </div>
                        <div class="col-sm-2">
                            <!-- add category -->
                            <a href='#' id='cat' onclick="Delete()" class="btn btn-info w-100">Add Category</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="offset-sm-1 col-sm-2 control-label">Product Picture</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="file" name="img" />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="submit" name="submit">Save</button>
                        <button class="btn btn-info" type="reset">reset</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
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