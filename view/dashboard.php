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
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="header">
            <a href="dashboard.php"><img src="../assets/ics.png" alt="icslog"></a>
            <span class="navbar-text ics">Institute of Computer Studies</span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav dropdown ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Fees
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="#"><i class="fa fa-file-text"></i> Promissory</a>
                        <a class="nav-link" href="#"><i class="fa fa-money-check"></i> Payment</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="account_approval.php"><i class="fa fa-users"></i> Approval</a>
                        <a class="nav-link" href="#"><i class="fa fa-tasks"></i> Manage Fees</a>
                        <a class="nav-link" href="#"><i class="fa fa-bank"></i> Manage Withdraw</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      School
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navdropdown">
                        <a class="nav-link" href="#"><i class="fa fa-user-alt"></i> Add User</a>
                        <a class="nav-link" href="school_year.php"><i class="fa fa-calendar-alt"></i> Add School year</a>
                        <a class="nav-link" href="year_lvl.php"><i class="fa fa-calendar-alt"></i> Add Year level</a>
                        <a class="nav-link" href="semester.php"><i class="fa fa-plus-square"></i> Add Semester</a>
                        <a class="nav-link" href="course.php"><i class="fa fa-chalkboard"></i> Add Course</a>
                        <a class="nav-link" href="section.php"><i class="fa fa-pen-square"></i> Add Section</a>
                        <a class="nav-link" href="#"><i class="fa fa-bullhorn"></i> Add Announcement</a>  
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Account
                    </a>
                    <div class="dropdown-menu sign-out" aria-labelledby="navdropdown">
                        <a class="nav-link" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

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
                        <a href="../admin/admin_promissory.html">
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
                        <a href="admin_pay.html">
                            <i class="fa fa-money-check fa-5x"></i>
                            <h5>
                                Fees
                            </h5>
                        </a>
                    </div>
                </div>
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
            </div>
            <div class="row">
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
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="admin_create.html">
                            <i class="fa fa-user-alt fa-5x"></i>
                            <h5>
                                Add User
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-box mb-orange">
                        <a href="admin_manage.html">
                            <i class="fa fa-tasks fa-5x"></i>
                            <h5>
                                Manage schedule fees
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
                        <a href="admin_withdraw.html">
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
                        <a href="admin_announcement.html">
                            <i class="fa fa-bullhorn fa-5x"></i>
                            <h5>
                                Announcement
                            </h5>
                        </a>
                    </div>
                </div>
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