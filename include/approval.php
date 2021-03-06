<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    //Load database
    include('database.php');

    //Import PHPMailer classes into the global namespace
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
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($connect->error);
        if(mysqli_num_rows($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];
            $email = $row['email'];
            $connect->query("UPDATE request SET status = 'active', approval_status = 'active' WHERE id= '$id';") or die($connect->error);
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
+
                $mail->isHTML(true);         

                $mail->Subject = 'Your account has been accepted';
                $mail->Body    = 'You can now login. Thank you for registering.';

                $mail->send();
            }catch(Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('location: ../view/account_approval.php?success=1');
            $_SESSION['message'] = "Account has been approve and successfully send an email.";
            
        }
    }
    //decline account approval
    if(isset($_GET['decline'])){
        $id = $_GET['decline'];
        $result = $connect->query("SELECT * FROM request WHERE id = '$id';") or die($connect->error);
        if(mysqli_num_rows($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];   
            $connect->query("DELETE FROM request WHERE id= '$id';") or die($connect->error);
            try{
                $mail->isSMTP();                                           
                $mail->Host       = Host;                     
                $mail->SMTPAuth   = true;                            
                $mail->Username   = Username;                 
                $mail->Password   = Password;                         
                $mail->Port       = 25; 

                $mail->setFrom(Username, 'WMSU ICS PSITS');
                $mail->addAddress($email);    
+
                $mail->isHTML(true);         

                $mail->Subject = 'Your account has been declined';
                $mail->Body    = 'Im sorry to inform you that your account has been declined due to invalid details';

                $mail->send();
            }catch(Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            header('location: ../view/account_approval.php?success=1');
            $_SESSION['message'] = "Account has been declined.";
        }
    }
    ob_end_flush();
?>