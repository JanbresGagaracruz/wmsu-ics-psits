<?php
    include("database.php");

    //create a new semester
    if(isset($_POST['create'])){ 
        $semester = $_POST['semester'];
        $sql = "INSERT INTO semester (sem) VALUES ('$semester')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/semester.php');
            $_SESSION['message'] = "You have successfully added a new semester.";
        }
    }

    //delete semester
    if(isset($_GET['delete'])){
        $semester = $_GET['delete'];
        $result = $connect->query("SELECT * FROM semester WHERE sem = '$semester';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM semester WHERE sem= '$semester';") or die($connect->error);
            if($check){
                header('location: ../view/semester.php');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../view/semester.php');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }


?>