<?php
    ob_start();
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != 1){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Reports | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header_officer.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Payment reports</h2>
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
                <div class="row">				
                    <div class="col-md-6">
                        <div class="main-box mb-orange">
                            <a href="officer_generate.php">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h5 id="record_data">
                                    Generate reports
                                </h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            $result = $connect->query("SELECT SUM(payment) as pay FROM payment_transaction;");
                            while($row = $result->fetch_assoc()):
                            $count = $row['pay'];
                        ?>
                        <div class="main-box mb-orange">
                            <a href="officer_view_report.php">
                                <i class="fa fa-money fa-5x"></i>
                                <h5 id="record_data">
                                    Payment records
                                </h5>
                            </a>
                            <h1 id="record_data"> <?=number_format($count)?></h1>
                            <?php endwhile; ?>
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
    <script>
    $(document).ready(function () {
        $("#generate").validate({
            rules: {
                course: {
                    required: true,
                },
                year: {
                    required: true,
                },
                sem: {
                    required: true,
                },
            },
            messages: {
                course: {
                    required: "Please select a course",
                },
                year: {
                    required: "Please select a year level",
                },
                sem: {
                    required: "Please select a semester",
                },
            },
        });
    });
    </script>
</body>
</html>
