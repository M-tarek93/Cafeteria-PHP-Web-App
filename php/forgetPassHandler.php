<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Pass | Cafeteria</title>
    <link rel="stylesheet" href="../css/forgetPass.css">
</head>
<body>
        <header>
            <ul class="navLinks">
                <li><a href="#">Home</a></li>
                <li><a href="../php/allProducts.php">Products</a></li>
                <li><a href="../php/allUsers.php">Users</a></li>
                <li><a href="#">Manual Order</a></li>
                <li><a href="../php/checks.php">Checks</a></li>
            </ul>
        </header>
<?php
require_once('databaseHandler.php');
$database = new databaseHandler();

$email=$password=$confpassword=$username="";
$email_err=$pass_err=$confpass_err=$valid_err=$username_err="";
$host = '127.0.0.1';
$db   = 'cafeteria';
$user = 'root';
$pass = '';
#-------------------Validate the user to reset his password by his username and his email-------------#

#---------------------------------Check if username is empty---------------------------------#
if(empty($_POST['username'])){
    $username_err= " *Please enter your username.";
    echo $username_err."<br>";
} else{
    $username = $_POST["username"];
    $countu=$database->UsernameExist($username);
    if($countu<1){
        $username_err= " *Invalid username";
        echo $username_err."<br>";
    }
}
#-------------------------------Check if Email is empty------------------------------#
if(empty($_POST['email'])){
    $email_err= " *Please enter your email.";
    echo $email_err."<br>";
} else{
    $email = $_POST["email"];
    #---------------------------validate user's Email---------------------------#
    $counte=$database->CheckEmailExist($email);
    if($counte<1){
        $email_err= " *Invalid Email";
        echo $email_err."<br>";
    }
}

#-----------------------------Check if Password is empty----------------------------#
if(empty($_POST['password'])){
    $pass_err= " *Please return and enter your password.";
    echo $pass_err."<br>";
} else{
    $password = $_POST["password"];
    if(! preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',$password)){
        $pass_err= " *Your password must contains Upper & lower letters and special characters and numbers ";
        echo $pass_err."<br>";
    };
}

#------------------------------Check if confPassword is empty------------------------#
if(empty($_POST["confpassword"])){
    $confpass_err= " *Please return and enter your confirmation password.";
    echo $confpass_err;
} else{
        #---------------to make sure that confirm Password equal password---------------------#
        $confpassword = $_POST["confpassword"];
        if($confpassword != $password){
            $confpass_err= " *Confirmation password is not matching Password";
            echo $confpass_err."<br>";
        }
    }
    
#-----------------------------------Reset user's Password--------------------------------#
    if($email_err==="" & $pass_err==="" & $confpass_err==="" & $valid_err==="" & $username_err===""){
    $database->resetPass($_POST['password'],$_POST['username']);
    $database->disconnectDB();
    echo" <div style='margin-left:13% ;
    padding-top: 55px;
    background-color: black;
    opacity: 80%;
    width:450px;
    height:250px;
    margin:auto;
    margin-top:25px;
    text-align:center;
    '><h2>*Your password has been changed successfully</h2> <br> <a style='color:white;' href='login.html'><h3>Login</h3></a>";
    }
?>
</body>