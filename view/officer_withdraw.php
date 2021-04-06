<?php
    ob_start();
    require('../include/create_withdraw.php');
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != "1"){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!--Custom CSS-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/multi.css">

    <title>Withdraw Management | Institute of Computer Studies</title>

</head>

<body>
    <?php require('officer_template.php'); ?>
    <!--Create alert message-->
    <div class="container">
        <?php if(isset($_SESSION['message'])&& $_GET['success'] == 1): ?>   
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
            <div class="col-12 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Track Withdraw history</h2>
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
                                                <div id="regMenu" class="animate__animated animate__fadeInDown">
                                                    <div class="form-group">
                                                        <h4>Withdraw Management</h4>
                                                    </div>
                                                    <button type="button" class="btn btn-primary  mb-2"
                                                        data-toggle="modal" data-target="#withdraw_modal">
                                                        Add history
                                                    </button>
                                                    <div class="table_wrapper">
                                                        <table id="table" class="table table-hover table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Transaction no.</th>
                                                                    <th scope="col">Amount</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Withdrawn by</th>
                                                                    <th scope="col">Receipt</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $query = ("SELECT * FROM withdraw");
                                                                    $result = mysqli_query($connect, $query);
                                                                    while($row = $result->fetch_assoc()){ 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['transaction']; ?></td>
                                                                    <td><?php echo $row['amount']; ?></td>
                                                                    <td><?php echo $row['date']; ?></td>
                                                                    <td><?php echo $row['name']; ?></td>
                                                                    <td><?php echo $row['img']; ?></td>
                                                                    <td>
                                                                        <a href="../include/create_withdraw.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="delete" name="delete">
                                                                            <span class="fas fa-trash-alt"></span>
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

    <div class="modal fade" id="withdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Withdraw history</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="withdraw.php" id="withdraw_form" >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="transaction">Transaction no.</label>
                            <input type="text" class="form-control" id="transaction" name="transaction" placeholder="Enter transaction no." autocomplete="off">
                            <div id="transaction_validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount"autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" min="2021-03-23"placeholder="Enter Date"autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name">Withdrawn by</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="file">Receipt</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <div id="image_validation"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="create" name="create">Submit</button>
                    </div>
                </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="../js/datable.js"></script>
    <script src="../js/alert-slide.js"></script>
    <script src="../js/validation.js"></script>
</body>
</html>