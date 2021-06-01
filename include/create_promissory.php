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
        $s_year = $_POST['s_year'];
        $manage_id = $_POST['manage_id'];
        $year_id = $_POST['year'];
        $semester_id = $_POST['semester'];
        $u_fees = $_POST['u_fees'];
        $u_payment = $_POST['u_payment'];
        $balance = $_POST['tp'];
        $reason = $_POST['reason'];
        $date = $_POST['date_to_pay'];
        $approval = "pending";

        $sql = "INSERT INTO student_assessment (student_id, school_year, manage_id, year_id,sem,u_fees,u_payment, balance, reason, date_to_pay, promissory_approval) 
        VALUES ('$student_id','$s_year','$manage_id','$year_id','$semester_id','$u_fees','$u_payment','$balance', '$reason', '$date', '$approval')";
        $assess = mysqli_query($connect, $sql);
        if($assess){
            $update = "UPDATE request SET assessment_status = 'assessed' WHERE id = '$student_id';";
            mysqli_query($connect, $update);
            header('location: ../view/officer_promissory.php?success=1');
            $_SESSION['message'] = "Sucessfully send a promissory note! Please wait for the approval an emaill will be send to you.";
        }else{
            header('location: ../view/officer_promissory.php?success=2');
            $_SESSION['message'] = "Something went wrong!";
        }
    }
    if(isset($_POST['submit'])){ 
        $student_id = $_SESSION['id'];
        $manage_id = $_POST['manage_id'];
        $year_id = $_POST['year'];
        $s_year = $_POST['s_year'];
        $semester_id = $_POST['semester'];
        $u_fees = $_POST['u_fees'];
        $u_payment = $_POST['u_payment'];
        $balance = $_POST['tp'];
        $reason = $_POST['reason'];
        $date = $_POST['date_to_pay'];
        $approval = "pending";
        $t=1;

        $query = ("SELECT * FROM student_assessment;");
        $result = mysqli_query($connect, $query);
        while($row = $result->fetch_assoc()){
            if($row['student_id'] == "$student_id" && $row['promissory_approval'] == "$approval"){
                header('location: ../view/user_promissory.php?success=2');
                $_SESSION['message'] = "You have recently send a promissory ticket, please wait for the further approval.";
                $t=0;
            }
        }
        if($t == 1){
            $sql = "INSERT INTO student_assessment (student_id,school_year, manage_id, year_id,sem,u_fees,u_payment, balance, reason, date_to_pay, promissory_approval) 
            VALUES ('$student_id','$s_year','$manage_id','$year_id','$semester_id','$u_fees','$u_payment','$balance', '$reason', '$date', '$approval')";
            $assess = mysqli_query($connect, $sql);
            if($assess){
                $update = "UPDATE request SET assessment_status = 'assessed' WHERE id = '$student_id';";
                mysqli_query($connect, $update);
                header('location: ../view/user_promissory.php?success=1');
                $_SESSION['message'] = "Sucessfully send a promissory note! Please wait for the approval an emaill will be send to you.";
            }else{
                header('location: ../view/user_promissory.php?success=2');
                $_SESSION['message'] = "Something went wrong!";
            }
        }
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require('../vendor/autoload.php');
    include('credential.php');
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $email="";
    $id="";
    
    //accept account approval
    if(isset($_GET['accept'])){
        $id = $_GET['accept'];
        $email = $_GET['accept'];
        $result = $connect->query("SELECT
        request.id AS uid,
        request.course, 
        request.email, 
        request.approval_status, 
        CONCAT(last_name, ', ', first_name,' ',middle_name) AS full_name,
        manage_fees.total_fees,
        manage_fees.fee_names,
        manage_fees.id,
        year_lvl.id,
        year_lvl.year,
        sem,
        student_assessment.u_fees,
        student_assessment.date_to_pay,
        student_assessment.reason,
        student_assessment.promissory_approval,
        student_assessment.u_payment,
        student_assessment.balance,
        student_assessment.id
        FROM student_assessment
        JOIN request
            ON request.id = student_assessment.student_id
        LEFT JOIN manage_fees
            ON manage_fees.id = student_assessment.manage_id
        LEFT JOIN year_lvl
            ON year_lvl.id = student_assessment.year_id
            WHERE student_assessment.id = '$id';   ");
        if(mysqli_num_rows($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $email = $row['email'];
            $status="close";
            $type = "Promissory";
            $viewed = 0;
            $message= "Your promissory request has been accepted.";
            $connect->query("UPDATE student_assessment SET promissory_approval = 'approved' WHERE id= '$id';");
            $connect->query("INSERT INTO notification (assessment_id,message,status,viewed,type) VALUES ('$id','$message','$status','$viewed','$type')");
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

                $mail->isHTML(true);         

                $mail->Subject = 'STUDENT PROMISSORY';
                $mail->Body    = 'Your promissory request has been accepted!';

                $mail->send();
            }catch(Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('location: ../view/promissory_approval.php?success=1');
            $_SESSION['message'] = "Student promissory has been accepted!";
            
        }
    }

    //decline account approval
    if(isset($_GET['decline'])){
        $id = $_GET['decline'];
        $result = $connect->query("SELECT
        request.id AS uid,
        request.course, 
        request.email, 
        request.approval_status, 
        CONCAT(last_name, ', ', first_name,' ',middle_name) AS full_name,
        manage_fees.total_fees,
        manage_fees.fee_names,
        manage_fees.id,
        year_lvl.id,
        year_lvl.year,
        sem,
        student_assessment.u_fees,
        student_assessment.date_to_pay,
        student_assessment.reason,
        student_assessment.promissory_approval,
        student_assessment.u_payment,
        student_assessment.balance,
        student_assessment.student_id AS stud,
        student_assessment.id
        FROM student_assessment
        JOIN request
            ON request.id = student_assessment.student_id
        LEFT JOIN manage_fees
            ON manage_fees.id = student_assessment.manage_id
        LEFT JOIN year_lvl
            ON year_lvl.id = student_assessment.year_id
            WHERE student_assessment.id = '$id';   ");
        if(mysqli_num_rows($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $email = $row['email'];
            $check = $connect->query(" UPDATE request r LEFT JOIN
                                        student_assessment sa
                                        ON sa.student_id = r.id
                                        SET r.assessment_status = 'not assessed'
                                        WHERE r.assessment_status = 'assessed' AND sa.id = '$id'
                                        ;")or die  ($connect->error);
            if($check){
                $connect->query("DELETE FROM student_assessment WHERE id= '$id';");
            }
            try{
                $mail->isSMTP();                                           
                $mail->Host       = Host;                     
                $mail->SMTPAuth   = true;                            
                $mail->Username   = Username;                 
                $mail->Password   = Password;                         
                $mail->Port       = 25; 

                $mail->setFrom(Username, 'WMSU ICS PSITS');
                $mail->addAddress($email);    
                $mail->isHTML(true);         

                $mail->Subject = 'STUDENT PROMISSORY REQUEST';
                $mail->Body    = 'Your promissory request has been declined due to your date to pay issued.';

                $mail->send();
            }catch(Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('location: ../view/promissory_approval.php?success=1');
            $_SESSION['message'] = "Student promissory been declined";
        }
    }
    ob_end_flush();

?>