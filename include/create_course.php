<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");
    //create a new course
    if(isset($_POST['create'])){ 
        $course = $_POST['course'];
        $check=$connect->query("INSERT INTO course (course) VALUES ('$course')") or die($connect->error());
        if($check){
            header('location: ../new/course.php?success=1');
            $_SESSION['message'] = "You have successfully added a new course.";
        }else{
            header('location: ../new/course.php?success=2');
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    if(isset($_POST["id"]))  {  
        $query = "SELECT * FROM course WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }
    
    if(isset($_POST['Update'])){
        $id=$_POST['edit_id'];
        $course=$_POST['edit_course'];
        $check=$connect->query("UPDATE course SET course='$course' WHERE id='$id' ") or die($connect->error());
        if($check){
            header('location: ../new/course.php?success=1');
            $_SESSION['message'] = "You have successfully updated course.";
        }else{
            header('location: ../new/course.php?success=2');
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
                header('location: ../view/course.php?success=1');
                $_SESSION['message'] = "Course has been deleted.";
            }else{
                header('location: ../new/course.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }

    //Live validation to check whether course is existing or not
    if(isset($_POST['course_check']))
    {
        $course_check = $_POST['course_check'];
        $query = "SELECT * FROM course WHERE course = '$course_check';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This course is already existing.
                    </span> ';
            echo "<script>$('#create').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    if(isset($_POST['edit_course']))
    {
        $edit_course = $_POST['edit_course'];
        $query = "SELECT * FROM course WHERE course = '$edit_course';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This course is already existing.
                    </span> ';
            echo "<script>$('#Update').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#Update').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    ob_end_flush();
?>