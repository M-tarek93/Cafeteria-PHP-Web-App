<?php

session_start();

require_once('databaseHandler.php');

class Register{
    public function insertconn(){
        $Datbase = new databaseHandler();
        $Datbase->connectDB();
        $userNameErr=$emailErr=$passErr=$confPassErr=$roomErr=$extErr=$fileErr="";
        $userName=$roomNum=$password=$confPassword=$exten=$email=$role="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        #username validation
            if(empty($_POST['nameuser']))
            {
                $userNameErr=" *UserName is required";
            }else{
                $userName=$_POST['nameuser'];
            }
            
        #----------------------Email validation----------------------#
        if(empty($_POST['email'])){
            $emailErr=" *Email is required";
        }else{
            $email= $_POST['email'];
            if(! preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$email)){
                $emailErr= $emailErr. " *Wrong E-mail";
            };
        }

        #--------------------Password validation----------------------#
        if(empty($_POST['password'])){
            $passErr=" *Password is required";
        }else{
            $password=$_POST['password'];
            if(! preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',$password)){
                $passErr= $passErr. " *Your password must contains Upper & lower letters and special characters and numbers ";
            };
            
            }

        #----------------Confirm Password validation---------------#
        if(empty($_POST['confpass'])){
            $confPassword= " *Password Confirmation must be filled";
        }else{
            $confPassword=$_POST['confpass'];
            if($confPassword != $password){
                $con_passErr= " *Confirmation password is not matching Password";
            }
            }
        }

        #---------------------Room validation-------------------------#
        if(empty($_POST['roomNum'])){
            $roomErr = " *Room number is required";
        }else{
            $roomNum=$_POST['roomNum'];
            if(!preg_match('/^[0-9]*$/',$roomNum)){
                $roomErr= $roomErr." *You must enter number only";
            }
        }

        #---------------------Extention validation---------------------#
        if(empty($_POST['ext'])){    
            $extErr= " *Extention can't be empty";
        }else{
            $exten=$_POST['ext'];
            if(!preg_match('/^[0-9]*$/',$exten)){
                $extErr= $extErr." *Extention must be a number";
            }
        }
        #---------------------Profile picture validation-----------------#
        
        if(isset($_FILES['file'])){
          if(($_FILES['file']['name'])!= NULL){  $errors= array();
           $file_name = $_FILES['file']['name'];
           $file_size =$_FILES['file']['size'];
           $file_tmp =$_FILES['file']['tmp_name'];
           $file_type=$_FILES['file']['type'];
           $ext=explode('.',$_FILES['file']['name']);
           $file_ext=strtolower(end($ext));
        
           $extensions= array("jpeg","jpg","png");
           
           if(in_array($file_ext,$extensions)=== false){
               $errors[]="extension not allowed, please choose a JPEG or PNG file.";
           }
           if($file_size > 1000000){
               $errors[]='File size must be excately 2 MB';
           }
           if(empty($errors)==true){
               if(move_uploaded_file($file_tmp,"../images/" . $file_name)){;
            }
           }else{
               print_r($errors);
           }
        }}
        
        #---------------------inserting data after validation----------------#
            if($userNameErr==="" & $emailErr=== "" & $passErr==="" & $confPassErr==="" & $roomErr==="" & $extErr===""){
                if(($_FILES['file']['name'])==NULL){
            $Datbase->insertUser($userName,$password, $email,$roomNum, $exten, "NOT EXIST", 0);        
                }else{
            $Datbase->insertUser($userName,$password, $email,$roomNum, $exten, $_FILES['file']['name'], 0);
                }
            echo $userName." account has been added successfully"."<br>"."<a href='../html/login.html'>Login</a>";
            }else{
                echo "*********************** ERRORS PAGE ***********************<br>";
                echo $userNameErr."<br>";
                echo $emailErr."<br>";
                echo $passErr."<br>";
                echo $confPassErr."<br>";
                echo $roomErr."<br>";
                echo $extErr."<br>";
                echo $fileErr."<br>";
                echo "****************You must fill all required fields****************";
          }
    }
}

$regis = new Register();
$regis->insertconn();
$db= new databaseHandler();
$db->disconnectDB();
