<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");

    //create a new semester
    if(isset($_POST['create'])){ 
        $semester = $_POST['semester'];
        $sql = "INSERT INTO semester (sem) VALUES ('$semester')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/semester.php?success=1');
            $_SESSION['message'] = "You have successfully added a new semester.";
        }else{
            header('location: ../view/semester.php?success=1');
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    //delete semester
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM semester WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM semester WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../view/semester.php?success=1');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../view/semester.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }

    if(isset($_POST['semester_id']))
    {
        $semester_id = $_POST['semester_id'];
        $query = "SELECT * FROM semester WHERE sem = '$semester_id';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This semester is already existing.
                    </span> ';
            echo "<script>$('#create').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    ob_end_flush();
?>