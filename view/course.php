<?php
    require("../include/create_course.php");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!--Custom CSS-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/multi.css">

    <title>Create Course | Institute of Computer Studies</title>

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
                        <a class="nav-link" href="#"><i class="fa fa-calendar-alt"></i> Add School year</a>
                        <a class="nav-link" href="#"><i class="fa fa-calendar-alt"></i> Add Year level</a>
                        <a class="nav-link" href="#"><i class="fa fa-plus-square"></i> Add Semester</a>
                        <a class="nav-link" href="course.php"><i class="fa fa-chalkboard"></i> Add Course</a>
                        <a class="nav-link" href="#"><i class="fa fa-pen-square"></i> Add Section</a>
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
    <!--Create alert message-->
    <div class="container">
        <?php if(isset($_SESSION['message'])): ?>   
            <div class="alert alert-success alert-dismissible mt-2" id="success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php 
                echo $_SESSION['message'];  
                unset($_SESSION['message']);
            ?>
        <?php endif ?>
    </div>
    <!--end of alert message-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Course</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10 col-md-12">
                                    <div class="card user-profile">
                                        <div class="card-body">
                                            <form>
                                                <div id="regMenu">
                                                    <div class="form-group">
                                                        <h4>Create Course</h4>
                                                    </div>
                                                    <button type="button" class="btn btn-primary  mb-2"
                                                        data-toggle="modal" data-target="#course_modal">
                                                        Add course
                                                    </button>
                                                    <div class="table_wrapper">
                                                        <table id="table" class="table table-hover table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Course</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $query = ("SELECT * FROM course");
                                                                    $result = mysqli_query($connect, $query);
                                                                    while($row = $result->fetch_assoc()){ 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['id']; ?></td>
                                                                    <td><?php echo $row['course']; ?></td>
                                                                    <td>
                                                                        <a href="../include/create_course.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-md course_delete" id="delete" name="delete">
                                                                            <span class="fas fa-times"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--END-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="course_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="course.php" method="POST" >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course" placeholder="Enter course">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="create" id="create">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="../js/datable.js"></script>
    <script src="../js/alert-slide.js"></script>
</body>
</html>