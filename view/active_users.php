<?php
    ob_start();
    include('../include/database.php');
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
    <?php require('admin_template.php'); ?>
    <!--Create alert message-->
    <div class="container">
        <?php if(isset($_SESSION['message']) && $_GET['success'] == 1): ?>    
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
                        <p>Active accounts</p>
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
                                            <th>Student id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Course</th>
                                            <th>User type</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = ("SELECT * FROM request WHERE usertype NOT LIKE 'admin' ");
                                            $result = mysqli_query($connect, $query);
                                            while($row = $result->fetch_assoc()){ 
                                        ?>
                                        <tr>
                                        
                                            <td><?php echo $row['student_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['course']; ?></td>
                                            <td><?php echo $row['usertype']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                                <a href="../include/active_account.php?stat_on=<?php echo $row['id'] ?>" class="btn btn-primary btn-xs" id="stat_on" name="stat_on">
                                                    <span class="fas fa-toggle-on"></span>
                                                </a>
                                                <a href="../include/active_account.php?stat_off=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="stat_off" name="stat_off">
                                                    <span class="fas fa-toggle-off"></span>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!--Custom js-->
    <script src="../js/datable.js"></script>    
    <script src="../js/alert-slide.js"></script>                                
</script>
</body>
</html>