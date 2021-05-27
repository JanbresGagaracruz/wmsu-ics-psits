<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../include/userlogin.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
    $student_id = $_SESSION['id'];
    $tat="close";
    $query = (" SELECT 
                notification.date,
                notification.id AS notif_session,
                student_assessment.reason,
                request.id AS st
                FROM notification
                LEFT OUTER JOIN student_assessment
                    ON student_assessment.id = notification.assessment_id
                    LEFT OUTER JOIN request
                        ON request.id = student_assessment.student_id
                            WHERE notification.status='$tat' AND request.id = '$student_id' ");
    $result = mysqli_query($connect, $query);
    while($row = $result->fetch_assoc()){ 
        $_SESSION['notification']= $row['notif_session'] ;
    }
    if(isset($_GET['viewed']) && !empty($_SESSION['notification'])){
        $read = "open";
        $id=$_SESSION['notification'];
        $update = $connect->query("UPDATE notification SET status='$read' WHERE id = '$id'");
    }
    ob_end_flush();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!--Custom CSS-->
  <link rel="shortcut icon" href="../assets/ics_icon.ico">
  <link rel="stylesheet" href="../css/profile.css">
  <title>Notification | Institute of Computer Studies</title>
</head>

<body>
    <?php require('homepage_template.php');?>

    <!--top section-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Notification</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card profile" style="background-color: #f3f3f3;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7 col-md-12">
                                    <?php
                                        $la = $_SESSION['notification'];
                                        $notif = $_GET['viewed'];
                                        $output = ''; 
                                        $student_id = $_SESSION['id'];
                                        $c = 1;
                                        $tat="close";
                                        $query = (" SELECT 
                                                    notification.message,
                                                    notification.id,
                                                    notification.date,
                                                    student_assessment.sem,
                                                    manage_fees.fee_names,
                                                    manage_fees.total_fees,
                                                    year_lvl.year,
                                                    payment_transaction.balance,
                                                    payment_transaction.payment_status,
                                                    CONCAT(request.last_name, ', ', request.first_name,' ', request.middle_name) as full_name
                                                    FROM notification
                                                    LEFT OUTER JOIN student_assessment
                                                        ON student_assessment.id = notification.assessment_id
                                                        LEFT OUTER JOIN request
                                                            ON request.id = student_assessment.student_id
                                                            LEFT OUTER JOIN year_lvl
                                                                ON year_lvl.id = student_assessment.year_id
                                                                LEFT OUTER JOIN payment_transaction
                                                                    ON payment_transaction.assess_id = student_assessment.id
                                                                    LEFT OUTER JOIN manage_fees
                                                                        ON manage_fees.id = student_assessment.manage_id
                                                                        WHERE notification.id ='$la' AND request.id = '$student_id' ");
                                        $output .= '  
                                        <div class="table-responsive">  
                                            <table class="table table-bordered table-hover">'; 
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                            if($row['id'] == $la){
                                        $output .= '  
                                            <tr>  
                                                <td width="30%"><label>Date and time</label></td>  
                                                <td width="70%">'.$row["date"].'</td>  
                                            </tr>  
                                            <tr>  
                                                <td width="30%"><label>Student name</label></td>  
                                                <td width="70%">'.$row["full_name"].'</td>  
                                            </tr>  
                                            <tr>  
                                                <td width="30%"><label>Message</label></td>  
                                                <td width="70%">'.$row["message"].'</td>  
                                            </tr>    
                                            <tr>  
                                                <td width="30%"><label>Year level</label></td>  
                                                <td width="70%">'.$row["year"].'</td>  
                                            </tr>
                                            <tr>  
                                                <td width="30%"><label>Semester</label></td>  
                                                <td width="70%">'.$row["sem"].'</td>  
                                            </tr> 
                                            <tr>  
                                                <td width="30%"><label>Fee names</label></td>  
                                                <td width="70%">'.$row["fee_names"].'</td>  
                                            </tr> 
                                            <tr>  
                                                <td width="30%"><label>Actual fee</label></td>  
                                                <td width="70%">'.$row["total_fees"].'</td>  
                                            </tr>
                                            <tr>  
                                                <td width="30%"><label>Student balance</label></td>  
                                                <td width="70%">'.$row["balance"].'</td>  
                                            </tr>
                                            <tr>  
                                                <td width="30%"><label>Payment status</label></td>  
                                                <td width="70%">'.$row["payment_status"].'</td>  
                                            </tr>
                                            '; 
                                            }
                                    ?>
                                                
                                    <?php } 
                                            $output .= "
                                            </table>
                                        </div>";  
                                        echo $output;
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>                                       
        <!--END-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
    <!--Custom js-->
    <script src="/js/notification.js"></script>
</body>

</html>