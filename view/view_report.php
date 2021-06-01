<?php
    ob_start();
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != "admin"){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access only admin is allowed!";
    }
    ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Report | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Display Report</h2>
                    </div>
                </div>
                <center class="center">
                    <?php if(isset($_SESSION['message']) && $_GET['success'] == 1): ?>    
                        <div class="alert alert-success alert-dismissible mt-2" id="success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php 
                                echo $_SESSION['message'];  
                                unset($_SESSION['message']);
                        ?>
                    <?php elseif(isset($_SESSION['message']) && $_GET['success'] == 2): ?>    
                        <div class="alert alert-danger alert-dismissible mt-2" id="success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php 
                            echo $_SESSION['message'];  
                            unset($_SESSION['message']);
                        ?>
                    <?php endif ?>
                </center>
                <a href="report.php" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

                <div class="panel panel-default" style="margin-top: 2rem;">
                    <div class="panel-heading">
                        Student information
                       <!--  <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report" />  
                        </form>   -->
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                        <th>Sem</th>
                                        <th>Balance</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query=("SELECT 
                                        CONCAT(request.last_name, ', ', request.first_name,' ', request.middle_name) as full_name,
                                        request.course,
                                        request.approval_status,
                                        student_assessment.promissory_approval,
                                        year_lvl.year,
                                        sem,
                                        payment_transaction.payment_status,
                                        payment_transaction.balance,
                                        payment_transaction.payment,
                                        manage_fees.total_fees,
                                        manage_fees.fee_names
                                        FROM payment_transaction
                                        LEFT OUTER  JOIN student_assessment
                                            ON student_assessment.id = payment_transaction.assess_id
                                                LEFT OUTER JOIN manage_fees
                                                    ON manage_fees.id = student_assessment.manage_id
                                                    LEFT OUTER JOIN year_lvl
                                                        ON year_lvl.id = student_assessment.year_id
                                                        LEFT OUTER JOIN request
                                                            ON request.id = student_assessment.student_id
                                        ;");

                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <?php if($row['promissory_approval'] == 'approved' && $row['balance'] >= 0){ ?>
                                    <tr>
                                        <td><?php echo $row['full_name'];?></td>
                                        <td><?php echo $row['course']; ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td><?php echo $row['sem']; ?></td>
                                        <td><?php echo $row['balance']; ?></td>
                                        <td><?php echo $row['payment']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div id="footer">
       <strong>WMSU ICS PSITS COLLECTION 2020</strong>
    </div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <!--Custom js-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/datable.js"></script>    
    <script src="../js/alert-slide.js"></script>  
    <script src="../js/jquery.metisMenu.js"></script>
    <script src="../js/custom1.js"></script>
    <script src="../js/view_user.js"></script>
    <script src="../js/validation.js"></script>
</body>
</html>
