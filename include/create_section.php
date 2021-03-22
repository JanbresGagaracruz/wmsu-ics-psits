<?php
    include("database.php");

    //create a new semester
    if(isset($_POST['create'])){ 
        $section = $_POST['section'];
        $sql = "INSERT INTO section (sec) VALUES ('$section')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/section.php?success=1');
            $_SESSION['message'] = "You have successfully added a new section.";
        }else{
            header('location: ../view/section.php?success=1');
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    //delete semester
    if(isset($_GET['delete'])){
        $section = $_GET['delete'];
        $result = $connect->query("SELECT * FROM section WHERE sec = '$section';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM section WHERE sec= '$section';") or die($connect->error);
            if($check){
                header('location: ../view/section.php?success=1');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../view/section.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }


?>