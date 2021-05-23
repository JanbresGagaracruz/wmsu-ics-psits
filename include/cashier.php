<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");

    if(isset($_POST["id"]))  {  
        $uid=$_POST["id"];
        $query=("SELECT
        request.id,
        request.course, 
        request.approval_status, 
        CONCAT(last_name, ', ', first_name,' ',middle_name) AS full_name,
        manage_fees.total_fees,
        manage_fees.fee_names,
        manage_fees.id,
        year_lvl.id,
        year_lvl.year,
        sem,
        student_assessment.u_fees,
        student_assessment.u_payment,
        student_assessment.balance,
        student_assessment.id
        FROM student_assessment
        JOIN request
            ON request.id = student_assessment.student_id
        JOIN manage_fees
            ON manage_fees.id = student_assessment.manage_id
        JOIN year_lvl
            ON year_lvl.id = student_assessment.year_id
            WHERE student_assessment.id = '$uid';    
        ");

        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }
    if(isset($_POST["ids"]))  {  
        $uid=$_POST["ids"];
        $query=("SELECT
        request.id,
        request.course, 
        request.approval_status, 
        CONCAT(last_name, ', ', first_name,' ',middle_name) AS full_name,
        manage_fees.total_fees,
        manage_fees.fee_names,
        manage_fees.id,
        year_lvl.id,
        year_lvl.year,
        sem,
        student_assessment.u_fees,
        student_assessment.u_payment,
        student_assessment.balance,
        student_assessment.id
        FROM student_assessment
        JOIN request
            ON request.id = student_assessment.student_id
        JOIN manage_fees
            ON manage_fees.id = student_assessment.manage_id
        JOIN year_lvl
            ON year_lvl.id = student_assessment.year_id
            WHERE student_assessment.id = '$uid';    
        ");

        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }
    if(isset($_POST["create"])){
        $id = $_POST['id'];
        $balance = $_POST['balance'] - $_POST['total_payment'];
        $u_fees = $_POST['select_fees'];
        $transaction_status = 1;
        $bal = max((int)$balance, 0);
        $status="close";
        $paid = "paid";
        $on = "ongoing";
        $message= "Payment transaction has been sucessfully.";
        if($balanace == 0){
            $check=$connect->query("INSERT INTO payment_transaction (assess_id,balance,payment_status) VALUES ('$id', '$bal', '$paid')");
        }else{
            $check=$connect->query("INSERT INTO payment_transaction (assess_id,balance,payment_status) VALUES ('$id', '$bal', '$on')");
        }
        
        if($check){
            $update = "UPDATE student_assessment SET balance = '$bal',u_payment = 0, u_fees = CONCAT(u_fees, '$u_fees'), transaction_status = ' $transaction_status'  WHERE id = '$id';";
            mysqli_query($connect, $update);
            $connect->query("INSERT INTO notification (assessment_id,message,status) VALUES ('$id','$message','$status')");
            header('location: ../view/officer_cashier.php?success=1');
            $_SESSION['message'] = "Payment successfully added!";
        }else{
            header('location: ../view/officer_cashier.php?success=1');
            $_SESSION['message'] = "Something went wrong!";
        }
    }
    ob_end_flush();
?>