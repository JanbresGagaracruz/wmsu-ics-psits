<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('database.php');

    if(isset($_POST['submit'])){
        $sy = $_POST['school_year'];
        $yr = $_POST['year'];
        $course = $_POST['course'];
        $sem = $_POST['semester'];
        $fs = $_POST['fs'];
        $tp = $_POST['tp'];
        $result = $connect->query("INSERT INTO manage_fees (school_year, year_lvl, course, semester, local_fees, tp) VALUES ('$sy','$yr','$course','$sem','$fs','$tp')") or die($connect->error());
        if($result){
            header('location: ../view/manage_fees.php?success=1');
            $_SESSION['message'] = "Management of fees has been successfully.";
        }else{
            header('location: ../view/manage_fees.php?success=1');
            $_SESSION['message'] = "Something went wrong.";
        }

    }

    //delete semester
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM manage_fees WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM manage_fees WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../view/manage_fees.php?success=1');
                $_SESSION['message'] = "Deleted successfully.";
            }else{
                header('location: ../view/manage_fees.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }
    ob_end_flush();
?>