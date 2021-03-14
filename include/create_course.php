<?php
    include("database.php");

    //create a new course
    if(isset($_POST['create'])){ 
        $course = $_POST['course'];
        $check=$connect->query("INSERT INTO course (course) VALUES ('$course')") or die($connect->error());
        $_SESSION['message'] = "You have successfully added a new course.";
        if($check){
            header('location: ../view/course.php');
            $_SESSION['message'] = "You have successfully added a new course.";
        }else{
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    //delete course
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM course WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM course WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../view/course.php');
                $_SESSION['message'] = "Course has been deleted.";
            }else{
                header('location: ../view/course.php');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }
?>