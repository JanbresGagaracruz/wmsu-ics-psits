<?php
    include("database.php");

    if(isset($_POST['create'])){ //create a new course
        $course = $_POST['course'];
        $sql = "INSERT INTO course (course) VALUES ('$course')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/course.php');
            $_SESSION['message'] = "You have successfully added a new course.";
        }
    }

    //delete course
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM course WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $connect->query("DELETE FROM course WHERE id= '$id';") or die($connect->error);
            header('location: ../view/course.php');
            $_SESSION['message'] = "Course has been deleted.";
        }  
    }
?>