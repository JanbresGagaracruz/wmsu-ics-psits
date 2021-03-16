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
            echo  '<i class="fa fa-check-circle  text-success ml-1"></i>
                    <span p-1" class="text-success">
                        Course is Available.
                    </span>';
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }
?>