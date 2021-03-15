<?php
    include("database.php");

    //create a new semester
    if(isset($_POST['create'])){ 
        $year_lvl = $_POST['year_lvl'];
        $sql = "INSERT INTO year_lvl (year) VALUES ('$year_lvl')";
        $query_run=mysqli_query($connect, $sql);

        if($query_run){
            header('location: ../view/year_lvl.php');
            $_SESSION['message'] = "You have successfully added a new year level.";
        }
    }

    //delete semester
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM year_lvl WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $check=$connect->query("DELETE FROM year_lvl WHERE id = '$id';") or die($connect->error);
            if($check){
                header('location: ../view/year_lvl.php');
                $_SESSION['message'] = "Successfully deleted.";
            }else{
                header('location: ../view/year_lvl.php');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }


?>