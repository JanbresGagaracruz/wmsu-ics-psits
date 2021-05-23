<?php
    ob_start();
    include('../include/userlogin.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
    $id = $_SESSION['id'];
    ob_end_flush();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!--Custom CSS-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Transaction records | Institute of Computer Studies</title>
</head>

<body>
    <?php require('homepage_template.php');?>

    <!--top section-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Payment history</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card profile" style="background-color: #f3f3f3;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card user-profile">
                                        <div class="card-body" style="box-shadow: hsl(0deg 0% 80%) 0 0 16px;">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="table-sorting  table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Full Name</th>
                                                                <th>Course</th>
                                                                <th>year</th>
                                                                <th>Sem</th>
                                                                <th>Actual fees</th>
                                                                <th>Balance</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $query=("SELECT 
                                                                CONCAT(request.last_name, ', ', request.first_name,' ', request.middle_name) as full_name,
                                                                request.course,
                                                                year_lvl.year,
                                                                sem,
                                                                payment_transaction.payment_status,
                                                                student_assessment.balance,
                                                                manage_fees.total_fees
                                                                FROM payment_transaction
                                                                LEFT OUTER  JOIN student_assessment
                                                                    ON student_assessment.id = payment_transaction.assess_id
                                                                        LEFT OUTER JOIN manage_fees
                                                                            ON manage_fees.id = student_assessment.manage_id
                                                                            LEFT OUTER JOIN year_lvl
                                                                                ON year_lvl.id = student_assessment.year_id
                                                                                LEFT OUTER JOIN request
                                                                                    ON request.id = student_assessment.student_id
                                                                                    WHERE request.id = '$id';
                                                                    ;");
                                                                    
                                                                $result = mysqli_query($connect, $query);
                                                                while($row = $result->fetch_assoc()){ 
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['full_name']; ?></td>
                                                                <td><?php echo $row['course']; ?></td>
                                                                <td><?php echo $row['year']; ?></td>
                                                                <td><?php echo $row['sem']; ?></td>
                                                                <td><?php echo $row['total_fees']; ?></td>
                                                                <td><?php echo $row['balance']; ?></td>
                                                                <td><?php echo $row['payment_status']; ?></td>
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
                        </div>
                    </div>
                </section>
            </div>
        </div>                                       
        <!--END-->

        <div class="modal fade" id="yearlvl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="contact">Contact number</label>
                                <input type="text" class="form-control" id="contact" name="contact" aria-describedby="contact"
                                    placeholder="Enter contact number">
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <input type="text" class="form-control" id="bio" name="bio" aria-describedby="bio"
                                    placeholder="Enter bio">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Save</button>
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
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/datable.js"></script>
</body>

</html>