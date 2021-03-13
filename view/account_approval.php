<?php
    include('../include/database.php');
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
    <!--Custom CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/AdminAccount.css">

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
                        <a class="nav-link" href="#"><i class="fa fa-chalkboard"></i> Add Course</a>
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
    <!--center-->
    <div class="container mt-5">
        <div id="page-inner">
            <div class="row">
                <div class="col">
                    <div class="jumbotron">
                        <p>Account Approval</p>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            User Accounts
                        </div>
                        <div class="card-body">
                            <div class="table_wrapper">
                            <table class="table table-hover table-responsive" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Middle Name</th>
                                            <th>Email</th>
                                            <th>Course</th>
                                            <th>Year</th>
                                            <th>Gender</th>
                                            <th>User type</th>
                                            <th>Password</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = ("SELECT * FROM request WHERE status='uncheck';");
                                            $result = mysqli_query($connect, $query);
                                            while($row = $result->fetch_assoc()){ 
                                        ?>
                                        <tr><?php if($row['status'] == 'uncheck'){ ?>
                                            <?php } ?>
                                        
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['student_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['middle_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['course']; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
                                            <td><?php echo $row['usertype']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td>
                                                <a href="../include/approval.php?accept=<?php echo $row['id']; echo $row['email'];?>"class="btn btn-success btn-xs" type="submit"id="accept" name="accept">
                                                    <span class="fas fa-check"> </span>
                                                </a>
                                                <a href="../include/approval.php?decline=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="decline" name="decline">
                                                    <span class="fas fa-times"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!--Custom js-->
    <script src="../js/datable.js"></script>                                    
</script>
</body>
</html>