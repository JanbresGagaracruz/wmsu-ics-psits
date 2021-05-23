<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('database.php');

    //Live validation to check whether email is existing or not
    if(isset($_POST['email_add']))
    {
        $email_add = $_POST['email_add'];
        $query = "SELECT * FROM request WHERE email = '$email_add';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This email is already taken.
                    </span> ';
            echo "<script>$('#register').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#register').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    //Live validation to check whether email is existing or not
    if(isset($_POST['student_id']))
    {
        $student_id = $_POST['student_id'];
        $query = "SELECT * FROM request WHERE student_id = '$student_id';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This student id is already taken.
                    </span> ';
            echo "<script>$('#register').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#register').prop('disabled',false);</script>"; //set enabled register button
        }
    }

    if(isset($_POST['register'])){ //upon clicking register button for pending request.

        $student_id = $_POST['student_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $gender = $_POST['gender'];
        $usertype = $_POST['usertype'];
        $password = $_POST['password'];
        $status = "active";
        $approval_status = "active";
        $assessment_status="not assessed";

        $sql = "INSERT INTO request (student_id, first_name, last_name,middle_name,email,course,gender,usertype,password,status,approval_status,assessment_status) 
        VALUES ('$student_id','$first_name','$last_name','$middle_name','$email','$course','$gender','$usertype','$password','$status','$approval_status','$assessment_status')";
        mysqli_query($connect, $sql);
        header('location: ../view/officer_walkin.php?success=1');
        $_SESSION['message'] = "Successfully created account for walk-in student.";
    }
    ob_end_flush();
?>