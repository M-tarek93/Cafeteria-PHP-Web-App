<?php
session_start();

$email = $password = "";
//$email_err = $password_err = "";
 
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
    
        #-------------------Check if username is empty----------------#
        if(empty($_POST['email'])){
            echo " *Please return and enter your email.";
        } else{
            $email = $_POST["email"];
        }
        
        #------------------Check if password is empty----------------#
        if(empty($_POST["password"])){
            echo " *Please return and enter your password.";
        } else{
            $password = $_POST["password"];
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);
            if($count!=1){
                echo " Invalid Email or Password!";
            $sqlu= "SELECT username FROM users WHERE email = '$email' AND password = '$password'";
            $user=mysqli_query($conn,$user);
    }else {
        echo "welcome back!"." $user"."<br>"."<a href='#'>Go to Home page</a>";
        //header("location: homepage.html");
    }
    mysqli_close($con);
}}
}

function disconnect(){

}

}
$log = new LoginHandler();
$log->checkLogin();

    