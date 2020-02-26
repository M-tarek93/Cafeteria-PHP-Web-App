<?php session_start();
//if ($_SESSION['role']!="0"){
//    header("Location: ../html/login.html");
//}
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $image = $db->getUserImage($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cafeteria</title>
    <link rel="stylesheet" href="../assets/css/home.css">
			<link rel="stylesheet" href="../css/font-awesome.min.css">
			<link rel="stylesheet" href="../css/bootstrap.css">
			<link rel="stylesheet" href="../css/main.css">
</head>
<body>
        <header>
            <ul class="navLinks">
                <li><a href="homeadmin.html">Home</a></li>
                <li><a href="../php/myOrders.php">My Orders</a></li>
                
               <div class="logandreg">
                <li><a href="../php/logout.php">Log out</a></li>
                <li><a href="register.html.html">Register</a></li>
                <li><a href="../php/logout.php">Log out</a></li>
                   <li> <img width='700' height='700' src="../assets/images/avatars/<?=$image[0]['profile_pic']?>" class="userphoto">
                     <h4 class="username" class="username"><?= $_SESSION['username']?></h4></li>
                
                </div>
            </ul>
            <!-- <span class="userhead">
                <img src="../images/user.png" class="userphoto">
                <h4 class="username" class="username">Admin</h4>
            </span> -->
        </header>
        
        <!-- Start menu Area -->
        <section class="menu-area section-gap" id="coffee">
            <h1 style="color:burlywood; text-align: center; margin-bottom: 10%; font-size:65px;  -webkit-text-stroke: 1.5px black; font-weight:bold;
            ">Cafeteria</h1>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-60 col-lg-10">
                        <div class="title text-center">
                            <h1 style="color:bisque">What kind of Products we serve for you</h1>
                            <p>Who are in extremely love with eco friendly system.</p>
                        </div>
                    </div>
                </div>						
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Cappuccino</h4>
                                <img class="product" src="../assets/images/products/cappuccino.png">
                            </div>
                            <p>
                                Dream with a cup of cappuccino in our Cafeteria
                            </p>		
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Tea</h4>
                                <img class="product" src="../assets/images/products/tea.png">
                            </div>
                            <p>
                                If you need to be relax take your tea in our cafeteria
                            </p>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Milkshake</h4>
                                <img class="product milk" src="../assets/images/products/milkshake.png">
                            </div>
                            <p>
                                Enjoy your time with your friend and with our milkshake in our cafeteria
                            </p>								
                        </div>
                    </div>	
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Macchiato</h4>
                                <img class="product" src="../assets/images/products/macchiato.webp">
                                <p class="price float-right">
                                    SOON!
                                </p>
                            </div>
                            <p>
                                It will be a surprise!
                            </p>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Mocha</h4>
                                <img class="product" src="../assets/images/products/mocha.jpeg">
                            </div>
                            <p>
                                Mocha is different in our cafeteria :)
                            </p>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Cocacola</h4>
                                <img class="product" src="../assets/images/products/coca.png">
                            </div>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Mint</h4>
                                <img class="product" src="../assets/images/products/mint.png">
                            </div>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Pepsi</h4>
                                <img class="product" src="../assets/images/products/pepsi.png">
                            </div>								
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-menu">
                            <div class="title-div justify-content-between d-flex">
                                <h4>Cake</h4>
                                <p class="price float-right">
                                    SOON
                                </p>
                                <img class="product" src="../assets/images/products/cake.jpg">
                            </div>
                            <p>
                                You will love it :)
                            </p>								
                        </div>
                    </div>															
                </div>
            </div>	
        </section>
        <!-- End menu Area -->
        
        
        <!-- start footer Area -->		
        <footer class="footer-area section-gap">
            <div class="con2" style="text-align: center;">
                <a href="aboutus.html"><h5 style="display: inline; color:bisque">About Us</h5></a>
                <span>|</span>
                <a href="Contactus.html"><h5 style="display: inline; color: bisque;">Contact Us</h5></a>
                <p>Copyright © 2020 by M.Tarek Team</p>

            </div>
        </footer>	
        <!-- End footer Area -->	

       
</body>
