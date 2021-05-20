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
        $t=1;
        //$check = $connect->query("");
        $query = ("SELECT * FROM manage_fees;");
        $result = mysqli_query($connect, $query);
        while($row = $result->fetch_assoc()){
            if($row['school_year'] == "$sy" && $row['year_lvl'] == "$yr" && $row['course'] == "$course" && $row['semester'] == "$sem"){
                header('location: ../view/manage_fees.php?success=1');
                $_SESSION['message'] = "You already manage this $course";
                $t=0;
            }
        }
        if($t==1){
            $connect->query("INSERT INTO manage_fees (school_year, year_lvl, course, semester, fee_names, total_fees) VALUES ('$sy','$yr','$course','$sem','$fs','$tp')") or die($connect->error);
            header('location: ../view/manage_fees.php?success=1');
            $_SESSION['message'] = "Management of fees has been successfully.";
        }

    }

    //delete semester
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM manage_fees WHERE id = '$id';");
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM manage_fees WHERE id= '$id';");
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