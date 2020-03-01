<?php
    session_start();
    if ($_SESSION['username']==null){
        header("Location: ../html/login.html");
         }
    require_once "databaseHandler.php";
    if( isset($_SESSION['username']) && isset($_SESSION['role'])  ){
        $db = new databaseHandler();
        
        
?>
        <!DOCTYPE html>
        <html>
            <head>
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <link rel = "stylesheet" type = "text/css" href = "../assets/css/displayUserOrders.css">
            <title><?php echo $_SESSION['username'];?> Orders</title>
    <link rel="stylesheet" href="../assets/css/home.css">

            </head>

            <body>
            <ul class="navLinks">
            <?php
            if( $_SESSION['role'] == 1){
                echo "
                <li><a href='homeadmin.php'>Home</a></li>
                <li><a href='allProducts.php'>Products</a></li>
                <li><a href='allUsers.php'>Users</a></li>
                <li><a href='displayUserOrders.php'>Manual Order</a></li>
                <li><a href='currentOrders.php'>Current Orders</a></li>
                <li><a href='checks.php'>Checks</a></li>
                
               <div class='logandreg'>
                <li><a href='logout.php'>Log out</a></li>
                <li><a href='adduser.php'>Add User</a></li>
                </div>
                ";
            }else{
                echo "
                <li><a href='homeuser.php'>Home</a></li>
                <li><a href='displayUserOrders.php'>Make Order</a></li>
                <li><a href='myOrders.php'>My Orders</a></li>
                
               <div class='logandreg'>
                <li><a href='logout.php'>Log Out</a></li>                
                </div>
                ";
            }
                ?>
            </ul>
                <div class="">
                    <?php
                        if( isset($_GET['msg'])){
                            switch($_GET['msg']){
                                case 'empty':
                                    echo "<div class='alertOrders'>Fill your order</div>";
                                break;
                            }
                        }
                    ?>
                
                    <main>
                        <section class="formToOrder">
                            <form action="InsertOrder.php" id="orderForm" method="POST">
                                
                                <?php 
                                    if( $_SESSION['role'] == 1){
                                        echo "<select name='username'>";
                                        echo "<option value=''>Choose a user</option>";
                                        $db = new databaseHandler();
                                        $users = $db->getUsers();
                                        foreach($users as $user){
                                            echo "<option value='" . $user['username'] . "'>" . $user['username'] . "</option>";
                                        }
                                        echo "</select>";
                                    }
                                ?>

                                <select name="room" id="room">
                                    <option value="">Choose a room</option>
                                    <?php
                                        $db = new databaseHandler();
                                        $rooms = $db->getDistinctRooms();
                                        foreach($rooms as $room){
                                            echo "<option value='" . $room['room'] . "'>" 
                                            . $room['room'] . "</option>";
                                        }
                                        ?>
                                </select>

                                <select name="ext" id="ext">
                                    <option value="">Choose an ext</option>
                                    <?php
                                        $db = new databaseHandler();
                                        $exts = $db->getDistinctExt();
                                        foreach($exts as $ext){
                                            echo "<option value='" . $ext['ext'] . "'>" 
                                            . $ext['ext'] . "</option>";
                                        }
                                        ?>
                                </select>
                                    <textarea name="notes" ></textarea>
                                    <label for="toalprice">Total: </label>
                                    <input type="text" value="0" id="totalprice" readonly name="totalprice">
                                <input type="submit" value="Send Order">
                            </form>
                        </section>
                        <section class="OrdersToDisplay">
                            <h1>Latest Orders</h1>
                            <div class="latestOrders">
                                <?php
                                    $db = new databaseHandler();
                                    $orders = $db->displayUserOrders($_SESSION['username']);

                                    foreach( $orders as $order ){
                                        echo "<div class='order'><h3>" . $order['name'] . "</h3>";
                                        echo "<img src='../assets/images/products/" . $order['image'] . "'>";
                                        echo "<span>" . $order['date'] . "</span>";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
                            <hr>
                            <h1>Available to order</h1>
                            <div class="availableProducts">
                                <?php
                                    $db = new databaseHandler();
                                    $products = $db->displayProducts();

                                    foreach($products as $product){
                                        echo "<div class='product' data-price='" . $product['price'] ."' data-name='" 
                                        . $product['name'] . "' data-id='" . $product['id'] 
                                        . "'><h3>" . $product['name'] . "</h3>";
                                        echo "<img src='../assets/images/products/" . $product['image'] . "'>";
                                        echo "<span>Price: " . $product['price'] . "</span>";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
                            
                        </section>
                    </main>
                
                </div>

                <script src="../JS/displayUserOrders.js"></script>
            </body>
        </html>
<?php
        
                                }    



// unset($_SESSION);
// session_destroy();
