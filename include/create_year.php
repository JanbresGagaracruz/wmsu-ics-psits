<?php
    include("database.php");

    if(isset($_POST['save'])){ //create a new school year
        $current = $_POST['current'];
        $to = $_POST['end'];
        $status = $_POST['status'];
        $year = ($current."-".$to);
        $sql = "INSERT INTO year (date,status) VALUES ('$year','$status')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/school_year.php');
            $_SESSION['message'] = "You have successfully added a new school year.";
        }
    }
?>