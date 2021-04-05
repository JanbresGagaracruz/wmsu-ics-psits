<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
        include("../include/userlogin.php");
    if($_SESSION['usertype'] != "admin"){
        $_SESSION['message'] = "You cannot access only admin is allowed!";
        header("location: login.php?success=1");
    }
    ob_end_flush();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Custom css-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/dashboard.css">

    <title>ADMIN | Institute of Computer Studies</title>

</head>

<body>

    <?php require('admin_template.php'); ?>
    
    <div class="container">
        <div id="page-inner">
            <div class="row">
                <div class="page-line">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="account_approval.php">
                            <i class="fa fa-users fa-5x"></i>
                            <h5>
                                Approval
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="active_users.php">
                            <i class="fa fa-user-circle fa-5x"></i>
                            <h5>
                                Active users
                            </h5>
                        </a>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="walkin_user.php">
                            <i class="fa fa-user-alt fa-5x"></i>
                            <h5>
                                Add User
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="fees.php">
                            <i class="fa fa-money-check fa-5x"></i>
                            <h5>
                                Fees
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="manage_fees.php">
                            <i class="fa fa-tasks fa-5x"></i>
                            <h5>
                                Manage schedule fees
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="#">
                            <i class="fa fa-file-text fa-5x"></i>
                            <h5>
                                Promissory
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="withdraw.php">
                            <i class="fa fa-bank fa-5x"></i>
                            <h5>
                                Withdraw Management
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="announcement.php">
                            <i class="fa fa-bullhorn fa-5x"></i>
                            <h5>
                                Announcement
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="school_year.php">
                            <i class="fa fa-calendar-alt fa-5x"></i>
                            <h5>
                                School Year
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="year_lvl.php">
                            <i class="fa fa-calendar-plus fa-5x"></i>
                            <h5>
                                Year level
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="course.php">
                            <i class="fa fa-chalkboard fa-5x"></i>
                            <h5>
                                Course
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="semester.php">
                            <i class="fa fa-plus-square fa-5x"></i>
                            <h5>
                                Semester
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="section.php">
                            <i class="fa fa-pen-square fa-5x"></i>
                            <h5>
                                Class Section
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



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
</body>

</html>