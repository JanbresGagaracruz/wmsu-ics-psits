<?php
    ob_start();
    if(!isset($_SESSION)){
        session_start();
    }
    include('database.php');

    //setting school year of active
    if(isset($_GET['stat_on'])){
        $id = $_GET['stat_on'];
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($consnect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE request SET status='active' WHERE id='$id'")or die($connect->error);
            if($check){
                header('location: ../view/walkin_user.php?success=1');
                $_SESSION['message'] = "Account has been successfully activated.";
            }else{
                header('location: ../view/walkin_user.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    //setting school year of inactive
    if(isset($_GET['stat_off'])){
        $id = $_GET['stat_off'];
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE request SET status='inactive' WHERE id='$id'")or die($connect->error);
            if($check){
                header('location: ../view/walkin_user.php?success=1');
                $_SESSION['message'] = "Account has been successfully deactivated.";
            }else{
                header('location: ../view/walkin_user.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    ob_end_flush();
?>