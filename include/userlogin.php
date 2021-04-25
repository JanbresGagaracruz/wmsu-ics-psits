<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");

    $email = "";
    $usertype = "";
    $first_name = "";
    $status="active";
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($connect,$_POST['email']);
        $password= mysqli_real_escape_string($connect,$_POST['password']);
        $sql = "SELECT * FROM request WHERE email='$email' AND password='$password' AND status='$status';";
        $result=mysqli_query($connect, $sql);
            if($email == "" && $password == ""){
                header("location:../view/login.php");
                $_SESSION['message'] = "Please don't leave username and password blank!";  
            }else{
                if(mysqli_num_rows($result) == 1){
                    $row = $result->fetch_array();
                    $_SESSION['id'] = $row['id']; 
                    $_SESSION['email'] = $row['email']; 
                    $_SESSION['usertype'] = $row['usertype'];  
                    $_SESSION['first_name'] = $row['first_name'];
                    if($_SESSION['usertype']=="Student"){
                        $_SESSION['usertype']='Student';
                        header("location: ../view/homepage.php");
                        }else if($_SESSION['usertype']=="President?success=1"){
                            $_SESSION['usertype']='1';
                            $_SESSION['message'] = "Welcome back! Check out our latest record summary.";
                            header("location: ../view/dashboard_officer.php?success=1");
                        }else if($_SESSION['usertype']=="VP"){
                            $_SESSION['usertype']='1';
                            $_SESSION['message'] = "Welcome back! Check out our latest record summary.";
                            header("location: ../view/dashboard_officer.php?success=1");
                        }else if($_SESSION['usertype']=="Treasurer"){
                            $_SESSION['usertype']='1';
                            $_SESSION['message'] = "Welcome back! Check out our latest record summary.";
                            header("location: ../view/dashboard_officer.php?success=1");
                        }else if($_SESSION['usertype']=="Officer"){
                            $_SESSION['usertype']='1';
                            $_SESSION['message'] = "Welcome back! Check out our latest record summary.";
                            header("location: ../view/dashboard_officer.php?success=1");  
                        }else if($_SESSION['usertype']=="admin"){
                            $_SESSION['usertype']='admin';
                            $_SESSION['message'] = "Welcome back admin!"; 
                            header("location: ../view/dashboard.php?success=1"); 
                        }
                else{  
                    header("location:../view/login.php");  
                    $_SESSION['message'] = "Invalid Email or Password, Please try again.";    
                }
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
    ob_end_flush();
?>