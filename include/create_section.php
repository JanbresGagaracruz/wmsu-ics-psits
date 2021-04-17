<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");

    //create a new semester
    if(isset($_POST['create'])){ 
        $section = $_POST['section'];
        $sql = "INSERT INTO section (sec) VALUES ('$section')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../new/section.php?success=1');
            $_SESSION['message'] = "You have successfully added a new section.";
        }else{
            header('location: ../new/section.php?success=2');
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    //delete semester
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM section WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM section WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../new/section.php?success=1');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../new/section.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }

    if(isset($_POST['section']))
    {
        $section_id = $_POST['section'];
        $query = "SELECT * FROM section WHERE sec = '$section_id';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This section is already existing.
                    </span> ';
            echo "<script>$('#create').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    ob_end_flush();
?>