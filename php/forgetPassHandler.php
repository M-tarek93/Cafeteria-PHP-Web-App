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
if(empty($_POST["password"])){
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
    echo " *Please return and enter your password.";
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
    echo" *Your password has been changed successfully"."<br>"."<a href='login.html>Login</a>";
    }