<?php session_start();
$_SESSION['username']='Breanna';
if ($_SESSION['role']!="1"){
   header("Location: ../html/login.html");
}
    require_once('databaseHandler.php');
    $db = new databaseHandler();
    $image = $db->getUserImage($_SESSION['username']);
    echo($image);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/adduser.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <title>Add User | Cafeteria</title>
</head>
<body>
    <header>
        
        <ul class="navLinks">
                <li><a href="homeadmin.html">Home</a></li>
                <li><a href="../php/allProducts.php">Products</a></li>
                <li><a href="../php/allUsers.php">Users</a></li>
                <li><a href="../php/InsertOrder.php">Manual Order</a></li>
                <li><a href="../php/currentOrders.php">Current Orders</a></li>
                <li><a href="../php/checks.php">Checks</a></li>
                <div class="logandreg">
                    <li><a href="../php/logout.php">Log out</a></li>
                </div>
        </ul>
        <!-- <label for="user"><php? echo "$_SESSION[‘username’]" ?></label> -->
        <!-- <span class="userhead">
            <img src="../images/user.png" class="userphoto">
            <h4 class="username" class="username">Admin</h4>
        </span> -->
    </header>
    <section >
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
    <script>

        let emailFlag = 0
        let usernameFlag = 0
        let passFlag = 0
        let confPassFlag = 0
        
        function checkPassword(){
            if(document.querySelector("#pass").value.length < 8){
                document.querySelector("#pass_error").textContent = "*Your password must be 8 characters at least";
                document.querySelector("#pass_error").setAttribute('class', "error");
                passFlag=1
            }
            else{
                document.querySelector("#pass_error").textContent = "";
                document.querySelector("#pass_error").setAttribute('class', "");
                passFlag=0
            }
            checkConfirmPassword();
            submitButtonHandling();
        }
        
        function checkConfirmPassword(){
            if(document.querySelector("#pass").value != document.querySelector("#confpass").value){
                document.querySelector("#confpass_error").textContent = "*Your password doesn't match";
                document.querySelector("#confpass_error").setAttribute('class', "error");
                confPassFlag=1
            }
            else{
                document.querySelector("#confpass_error").textContent = "";
                document.querySelector("#confpass_error").setAttribute('class', "");
                confPassFlag=0
            }
            submitButtonHandling();
        }

        function checkUsername(){
            username=document.querySelector(".username").value;
            var info = 'username=' + username;
            $.ajax({
                type: 'POST',
                url: '../php/checkUsername.php',
                data: info,
                success: function(data) {
                    if(data!=""){
                        usernameFlag=1;
                    }else{
                        usernameFlag=0;
                    }
                    usernamePopUP();
                },
                error: function() {
                    console.log('There was some error performing the AJAX call!');
                }
            });
        }
        
        function checkEmail(){
            email=document.querySelector(".email").value;
            var info = 'email=' + email;
            $.ajax({
                type: 'POST',
                url: '../php/checkEmail.php',
                data: info,
                success: function(data) {                    
                    if(data!=""){
                        emailFlag=1;
                    }else{
                        emailFlag=0;
                    }
                    emailPopUP();
                },
                error: function() {
                    console.log('There was some error performing the AJAX call!');
                }
            });
        }

        function emailPopUP(){
            if(emailFlag==1){
                document.querySelector("#email_error").textContent = "*This Email Already Exist";
                document.querySelector("#email_error").setAttribute('class', "error");
            }
            else{
                document.querySelector("#email_error").textContent = "";
                document.querySelector("#email_error").setAttribute('class', "");
            }
            submitButtonHandling();
        }
        
        function usernamePopUP(){
            if(usernameFlag==1){
                document.querySelector("#username_error").textContent = "*This Username has been taken";
                document.querySelector("#username_error").setAttribute('class', "error");
            }
            else{
                document.querySelector("#username_error").textContent = "";
                document.querySelector("#username_error").setAttribute('class', "");
            }
            submitButtonHandling();
        }
        
        function submitButtonHandling(){
            if(confPassFlag == 1 || passFlag == 1 ||usernameFlag == 1 ||emailFlag == 1 ){
                document.querySelector("#submitbtn").disabled= true;
                document.querySelector("#submitbtn").style.backgroundColor="grey";
            }else{
                document.querySelector("#submitbtn").disabled= false;
                document.querySelector("#submitbtn").style.backgroundColor="wheat";
            }
        }
    </script>
    <div>
        <form action="../php/registerHandler.php" method="post" enctype="multipart/form-data">
            <h1 class="regHead">Add User</h1>
            <div class="fields" id="username">
                <span class="label">Username</span>
                <input type="text" name="username" class="username" onfocusout="checkUsername()">
                <span id="username_error" ></span>
            </div>
            <div class="fields">
                <span class="label">Email</span>
                <input type="email" name="email" class="email" onfocusout="checkEmail()">
                <span id="email_error" ></span>
            </div>
            <div class="fields">
                <span class="label">Password</span>
                <input id="pass" type="password" name="password" class="pass" onfocusout="checkPassword()" >
                <span id="pass_error" ></span>
            </div>
            <div class="fields">
                <span class="label" name="confpasslabel"> Confirm Password</span>
                <input id="confpass" type="password" name="confpass" class="conpass" onfocusout="checkConfirmPassword()">
                <span id="confpass_error" ></span>
            </div>
            <div class="fields">
                <span class="label">Room No.</span>
                <input type="number" name="roomNum" class="romnum" required>
            </div>
            <div class="fields">
                <span class="label">Ext.</span>
                <input type="text" name="ext" class="ext" required>
            </div>
            <div class="fields" id='file'>
                <span class="label">Profile picture</span>
                <input type="file" name="file" value="browse" required>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            </div>
            <div class="fields" id="but" style="margin-right: 5%;">
                <button id="submitbtn" type="submit" style="margin:0; margin-top: 5%;">Submit</button>
                <button type="reset">Reset</button>
            </div>
            <input name="URL" type="hidden" value="addUser" />
        </form>
    </div>
    
    </section>

</body>
</html>