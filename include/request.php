<?php
    //create a request account verification
    include("database.php");
    $studentid="";
    $firstname="";
    $lastname="";
    $middlename="";
    $email="";
    $course="";
    $year="";
    $gender="";
    $usertype="";
    $password="";
    $date="";
    $status="";

    //Live validation to check wether email is existing or not
    if(isset($_POST['email_add']))
    {
        $email_add = $_POST['email_add'];
        $query = "SELECT * FROM request WHERE email = '$email_add';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<span class="text-danger p-1"><i class="fa fa-times text-danger ml-1"> This email is already taken.</i></span>';
            echo "<script>$('#register').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo  '<span class="text-success p-1"><i class="fa fa-check text-success ml-1"> Available.</i></span>';
            echo "<script>$('#register').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    //Live validation to check wether email is existing or not
    if(isset($_POST['student_id']))
    {
        $student_id = $_POST['student_id'];
        $query = "SELECT * FROM request WHERE student_id = '$student_id';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<span class="text-danger p-1"><i class="fa fa-times text-danger ml-1"> This student id is already taken.</i></span>';
            echo "<script>$('#register').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo  '<span class="text-success p-1"><i class="fa fa-check text-success ml-1"> Available.</i></span>';
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
        $year = $_POST['year'];
        $gender = $_POST['gender'];
        $usertype = $_POST['usertype'];
        $password = $_POST['password'];
        $status = $_POST['status'];

        $sql = "INSERT INTO request (student_id, first_name, last_name,middle_name,email,course,year,gender,usertype,password,date,status) 
        VALUES ('$student_id','$first_name','$last_name','$middle_name','$email','$course','$year','$gender','$usertype','$password',CURRENT_TIMESTAMP,'$status')";
        mysqli_query($connect, $sql);
        header('location: ../view/registration.php');
        $_SESSION['message'] = "Your account request is now pending for approval. Please wait for confirmation. Thank you. <a href='process_login.php'>Login instead?</a>";
    }

?>


