<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");

    //create a new school year
    if(isset($_POST['save'])){ 
        $current = $_POST['current'];
        $to = $_POST['end'];
        $status = $_POST['status'];
        $open ="open";
        $year = ($current."-".$to);
        $t=1;
        $result = $connect->query("SELECT * FROM year") or die($connect->error);
        while($row = $result->fetch_assoc()){
            if($row['date'] == "$year"){
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "This school year session is existing!";
                $t=0;
            }
        }
        if($t == 1){
            $sql = "INSERT INTO year (date,status) VALUES ('$year','$open')";
            $query_run=mysqli_query($connect, $sql);
            if($query_run){
                $result = $connect->query("SELECT * FROM year") or die($connect->error);
                while($row = $result->fetch_assoc()){
                    if($row['status'] == "$open"){
                        $connect->query("UPDATE year SET status='close' WHERE date NOT LIKE '$year'")or die($connect->error);
                        header('location: ../view/school_year.php?success=1');
                        $_SESSION['message'] = "All the opened school year has been closed except the newly added!";
                    }
                }
            }else{
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    //setting school year of active
    if(isset($_GET['stat_on'])){
        $id = $_GET['stat_on'];
        $open ="open";
        $result = $connect->query("SELECT * FROM year WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE year SET status='open' WHERE id='$id'")or die($connect->error);
            if($check){
                $res = $connect->query("SELECT * FROM year WHERE id = '$id';") or die($connect->error);
                while($row = $res->fetch_assoc()){
                    if($row['status'] == "$open"){
                        $connect->query("UPDATE year SET status='close' WHERE id NOT LIKE '$id'")or die($connect->error);
                    }
                }
                header('location: ../view/school_year.php?success=1');
                $_SESSION['message'] = "School year has successfully opened.";
            }else{
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    //setting school year of inactive
    if(isset($_GET['stat_off'])){
        $id = $_GET['stat_off'];
        $result = $connect->query("SELECT * FROM year WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE year SET status='close' WHERE id='$id'")or die($connect->error);
            if($check){
                header('location: ../view/school_year.php?success=1');
                $_SESSION['message'] = "School year has successfully closed.";
            }else{
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }

    //delete school year
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM year WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM year WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../view/school_year.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }
    ob_end_flush();
?>