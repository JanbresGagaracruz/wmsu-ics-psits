<?php
    session_start(); //start session
    include("database.php");
    $email = "";
    $usertype = "";
    $first_name = "";
    
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $status="check";
        $result = $connect->query("SELECT * FROM request WHERE email='$email' AND password='$password' AND status='$status';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $_SESSION['email'] = $row['email']; 
            $_SESSION['usertype'] = $row['usertype'];  
            $_SESSION['first_name'] = $row['first_name'];

            if($_SESSION['usertype']=="Student"){
                $_SESSION['usertype']='Student';
                header("location: ../view/homepage.php");
                }else if($_SESSION['usertype']=="President"){
                    $_SESSION['usertype']='1';
                    header("location: ../view/dashboard_officer.php");
                }else if($_SESSION['usertype']=="VP"){
                    $_SESSION['usertype']='1';
                    header("location: ../view/dashboard_officer.php");
                }else if($_SESSION['usertype']=="Treasurer"){
                    $_SESSION['usertype']='1';
                    header("location: ../view/dashboard_officer.php");
                }else if($_SESSION['usertype']=="Officer"){
                    $_SESSION['usertype']='1';
                    header("location: ../view/dashboard_officer.php");  
                }else if($_SESSION['usertype']=="admin"){
                    $_SESSION['usertype']='admin';
                    header("location: ../view/dashboard.php"); 
                }
            else{  
                header("location:../view/login.php");  
                $_SESSION['message'] = "Invalid Email or Password, Please try again.";    
            }
        }

    }
    //logout 
    if(isset($_GET['logout']) == 1){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['usertype']);
        header('location: login.php');
    }

?>