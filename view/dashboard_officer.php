<?php
    include '../include/userlogin.php';
    
    if($_SESSION['usertype'] != 1){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
    } 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!--Custom css-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/dashboard.css">

    <title>Officer | Institute of Computer Studies</title>

</head>

<body>
    <?php
        require('officer_template.php');
    ?>

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
                        <a href="off_payment.html">
                            <i class="fas fa-cash-register fa-5x"></i>
                            <h5>
                                Cashier
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="walkin_user.php">
                            <i class="fa fa-user-alt fa-5x" src=""></i>              
                            <h5>
                                Add Student
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="off_promi.html">
                            <i class="fa fa-envelope fa-5x"></i>
                            <h5>
                                Promissory
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="../view/withdraw.php">
                            <i class="fa fa-bank fa-5x"></i>
                            <h5>
                                Withdraw Management
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
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
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="student_assessment.php">
                            <i class="fa fa-balance-scale fa-5x"></i>
                            <h5>
                                Assessment
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