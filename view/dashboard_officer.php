<?php
    ob_start();
    include("../include/userlogin.php");
    include('../include/database.php');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != 1){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
    } 
    ob_end_flush()
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
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Dashboard | Institute of computer studies</title>
</head>
    <?php
        include("header_officer.php");
    ?>
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-head-line" >Record Summary</h2>
                        </div>
                    </div>
                    <center class="center">
                    <?php if(isset($_SESSION['message']) && $_GET['success'] == 1): ?>    
                        <div class="alert alert-info alert-dismissible mt-2" id="success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php 
                                echo $_SESSION['message'];  
                                unset($_SESSION['message']);
                        ?>
                    <?php endif ?>
                    </center>
                    <div class="row">				
                    <div class="col-md-4">
                            <div class="main-box mb-orange">
                                <a href="#">
                                    <i class="fa  fa-cash-register fa-5x"></i>
                                    <h5>
                                        Cashier
                                    </h5>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="main-box mb-orange">
                                <a href="#">
                                    <i class="fa  fa-envelope fa-5x"></i>
                                    <h5>
                                        Promissory
                                    </h5>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="main-box mb-orange">
                                <a href="officer_walkin.php">
                                    <?php 
                                        $sql = 'SELECT * FROM request WHERE usertype NOT LIKE "admin" AND approval_status="active"';
                                        $result = mysqli_query($connect,$sql);
                                        $count = mysqli_num_rows($result);
                                    ?>
                                    <i class="fa fa-user-alt fa-5x"></i>
                                    <h5>
                                        Add User
                                    </h5>
                                </a>
                                <h1 id="record_data"> <?=$count?></h1>
                            </div>
                        </div>               
                    </div>
                    <div class="row">				
                    <div class="col-md-4">
                        <div class="main-box mb-orange">
                                <a href="officer_studAssessment.php">
                                    <i class="fa  fa-balance-scale fa-5x"></i>
                                    <h5>
                                        Student Assessment
                                    </h5>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <?php 
                            $query = ("SELECT * FROM withdraw");
                            $result = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($result);
                        ?>
                        <div class="main-box mb-orange">
                                <a href="officer_withdraw.php">
                                    <i class="fa fa-bank fa-5x"></i>
                                    <h5>
                                        Withdraw Management
                                    </h5>
                                </a>
                                <h1 id="record_data"> <?=$count?></h1>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php 
                                $query = ("SELECT * FROM file_upload");
                                $result = mysqli_query($connect, $query);
                                $count = mysqli_num_rows($result);
                            ?>
                            <div class="main-box mb-orange">
                                <a href="officer_announcement.php">
                                    <i class="fa fa-bullhorn fa-5x"></i>
                                    <h5>
                                        Announcement
                                    </h5>
                                </a>
                                <h1 id="record_data"> <?=$count?></h1>
                            </div>
                        </div>              
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
       <strong>WMSU ICS PSITS COLLECTION 2020 | PIXELS COMPANY</strong>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/jquery.metisMenu.js"></script>
    <script src="../js/custom1.js"></script>
    
</body>
</html>
