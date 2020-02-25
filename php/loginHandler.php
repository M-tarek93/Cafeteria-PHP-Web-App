<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/adduser.css">
    <title>Welcome | Cafeteria</title>
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
session_start();

$email = $password = $user="";
$email_err = $password_err = $vald_err="";
 
class LoginHandler{
        private $conn;
        private const host = '127.0.0.1';
        private const db   = 'cafeteria';
        private const user = 'root';
        private const pass = '';

function checkLogin (){
    $conn= mysqli_connect(self::host,self::user, self::pass) or die ("could not connect to mysql"); 
    mysqli_select_db($conn,self::db);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        #-------------------Check if email is empty----------------#
        if(empty($_POST['email'])){
            $email_err= " *Please return and enter your email.";
            echo $email_err."<br>";
        } else{
            $email = $_POST["email"];
        }
        
        #------------------Check if password is empty----------------#
        if(empty($_POST["password"])){
            $password_err= " *Please return and enter your password.";
            echo $password_err."<br>";
        } else{
            $password = $_POST["password"];
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);
            if($count!=1){
            $vald_err=" Invalid Email or Password!";
            echo $vald_err."<br>";
            }else {
            $sqlu= "SELECT username FROM users WHERE email = '$email' AND password = '$password'";
            $sqlrole= "SELECT role FROM users WHERE email = '$email' AND password = '$password'";
            $user=mysqli_query($conn,$sqlu);
            $role= mysqli_query($conn,$sqlrole);
            $row=mysqli_fetch_row($user);
            $userString = $row[0];
            $rowr=mysqli_fetch_row($role);
            $roleString= $rowr[0];
            $_SESSION['username']=$userString;
            $_SESSION['role']=$roleString;
            //var_dump($_SESSION);
            //echo "<br>".$_SESSION['username'];
                echo "<div style='margin-left:13% ;
                padding-top: 55px;
                background-color: black;
                opacity: 80%;
                width:450px;
                height:250px;
                margin:auto;
                margin-top:25px;
                text-align:center;
                '><h2>welcome back $userString :)</h2><br><h3><a style='color:white;' href='../php/home.php'>Go to Home page</a></h3></div>";
                //header("location: homepage.html");
            }
}
mysqli_close($conn);}    
}}
$log = new LoginHandler();
$log->checkLogin();

