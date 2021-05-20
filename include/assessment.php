<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");
    
    if(isset($_POST["id"]))  {  
        $query = "SELECT id, CONCAT(last_name, ', ', first_name,' ',middle_name) as full_name, course FROM request WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }

    if(isset($_POST['create'])){ 
        $student_id = $_POST['id'];
        $manage_id = $_POST['manage_id'];
        $year_id = $_POST['year'];
        $semester_id = $_POST['semester'];
        $u_fees = $_POST['u_fees'];
        $u_payment = $_POST['u_payment'];
        $balance = $_POST['tp'];

        $sql = "INSERT INTO student_assessment (student_id, manage_id, year_id,sem,u_fees,u_payment, balance) 
        VALUES ('$student_id','$manage_id','$year_id','$semester_id','$u_fees','$u_payment','$balance')";
        $assess = mysqli_query($connect, $sql);
        if($assess){
            $update = "UPDATE request SET assessment_status = 'assessed' WHERE id = '$student_id';";
            mysqli_query($connect, $update);
            header('location: ../view/officer_studAssessment.php?success=1');
            $_SESSION['message'] = "Sucessfully assess! the student may now proceed to the cashier!";
        }else{
            header('location: ../view/officer_studAssessment.php?success=1');
            $_SESSION['message'] = "Something went wrong!";
        }
    }
    ob_end_flush();

?>