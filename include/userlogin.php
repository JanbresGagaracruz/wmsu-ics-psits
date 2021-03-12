<?php
    include("database.php");



    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $status="check";
        //$sql = mysql_query("SELECT * FROM login WHERE email='$email' AND password='$password' AND status='$status'");
        $result = $connect->query("SELECT * FROM request WHERE email='$email' AND password='$password' AND status='$status';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['usertype'] = $row['usertype'];
            if($row['usertype']=="Student"){
                header("location:../index.php");
                }else if($row['usertype']=="President"){
                    header("location:dashboard.php");
                }else if($row['usertype']=="VP"){
                    header("location:dashboard.php");
                }else if($row['usertype']=="Treasurer"){
                    header("location:dashboard.php");
                }else if($row['usertype']=="Officer"){
                    header("location:dashboard.php");
            }else{  
                header("location:../view/login.php");  
                $_SESSION['message'] = "Invalid Email or Password, Please try again.";    
            }
        }

    }

?>