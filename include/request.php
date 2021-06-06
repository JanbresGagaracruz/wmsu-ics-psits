<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    //create a request account verification
    include("database.php");
    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require('../vendor/autoload.php');
    include('credential.php');
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

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
        $email = $_POST['email_me'];
        $course = $_POST['course'];
        $gender = $_POST['gender'];
        $usertype = "Student";
        $password = $_POST['password'];
        $status = "active";
        $approval_status = "active";
        $assessment_status="not assessed";
        $checker = 0;

        $student_data =("SELECT * FROM student_data ");
        $result = mysqli_query($connect, $student_data);
        while($row = $result->fetch_assoc()){
            $a = $row['student_id'];
            $b = $row['first_name'];
            $c = $row['middle_name'];
            $d = $row['last_name'];
            $e = $row['email'];
            $f = $row['course'];
            if($a == $student_id && $b == $first_name && $c  ==  $middle_name && $d == $last_name && $e == $email  && $f == $course){
                $checker = 1;
            }
        }  
        if($checker == 1){
            $sql = "INSERT INTO request (student_id, first_name, last_name,middle_name,email,course,gender,usertype,password,status,approval_status,assessment_status) 
            VALUES ('$student_id','$first_name','$last_name','$middle_name','$email','$course','$gender','$usertype','$password','$status','$approval_status','$assessment_status')";
            $check = mysqli_query($connect, $sql);
            if($check){
                try{
                    $mail->isSMTP();       
                    $mail->SMTPAuth = true; 
                    $mail->SMTPSecure = 'tls'; 
                    $mail->Host       = Host;                     
                    $mail->SMTPAuth   = true;                            
                    $mail->Username   = Username;                 
                    $mail->Password   = Password;                         
                    $mail->Port = 587; 
    
                    $mail->setFrom(Username, 'WMSU ICS PSITS');
                    $mail->addAddress($email);   
                    $email_template = '../templates/mail_template.php'; 
                    $message = file_get_contents($email_template);
                    $message = str_replace('%username%', $email, $message);
                    $message = str_replace('%password%', $password, $message);
    
                    $mail->isHTML(true);         
    
                    $mail->MsgHTML($message);
                    $mail->Subject = 'Your account has been accepted!';
    
                    $mail->send();
                }catch(Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                header('location: ../view/registration.php?success=1');
                $_SESSION['message'] = "You have successfully created your account, Thank you. <a href='../view/login.php'>Login instead?</a>";
            }
        }else{
            header('location: ../view/registration.php?success=2');
            $_SESSION['message'] = "Your information doesn't match, please review your information! <a href='../view/login.php'>Login instead?</a>";
        } 
    }
    ob_end_flush();
?>


