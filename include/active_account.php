<?php
    ob_start();
    if(!isset($_SESSION)){
        session_start();
    }
    include('database.php');

    //setting school year of active
    if(isset($_GET['stat_on'])){
        $id = $_GET['stat_on'];
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE request SET status='check' WHERE id='$id'")or die($connect->error);
            if($check){
                header('location: ../view/active_users.php?success=1');
                $_SESSION['message'] = "Account has been sucessfully activated.";
            }else{
                header('location: ../view/active_users.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    //setting school year of inactive
    if(isset($_GET['stat_off'])){
        $id = $_GET['stat_off'];
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $check = $connect->query("UPDATE request SET status='uncheck' WHERE id='$id'")or die($connect->error);
            if($check){
                header('location: ../view/active_users.php?success=1');
                $_SESSION['message'] = "Account has been sucessfully deactivated.";
            }else{
                header('location: ../view/active_users.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }
    }
    ob_end_flush();
?>