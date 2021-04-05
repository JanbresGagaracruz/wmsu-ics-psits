<?php
    ob_start();
    require('../include/fees_management.php');
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
    <link rel="stylesheet" href="../css/multi.css">

    <title>ADMIN | Institute of Computer Studies</title>

</head>
<body>
    <?php require('admin_template.php'); ?>
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
                                <h2>Managing University Fees</h2>
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
                                                        <h4>Manage Fees</h4>
                                                    </div>
                                                    <button type="button" class="btn btn-primary  mb-2"
                                                        data-toggle="modal" data-target="#localfees">
                                                        Local fees
                                                    </button>
                                                    <button type="button" class="btn btn-primary  mb-2"
                                                        data-toggle="modal" data-target="#university">
                                                        University fees
                                                    </button>
                                                    <div class="table_wrapper">
                                                        <table id="table" class="table table-hover table-responsive">
                                                            <thead>
                                                                <tr class="p-4">
                                                                    <th scope="col">School Year</th>
                                                                    <th scope="col">Course</th>
                                                                    <th scope="col">Year level</th>
                                                                    <th scope="col">Semester</th>
                                                                    <th scope="col">School fees</th>
                                                                    <th scope="col">Amount</th>
                                                                    <th scope="col">type</th>
                                                                    <th scope="col">time created</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $result = $connect->query("SELECT * FROM fees RIGHT JOIN manage_fees ON fees.id = manage_fees.local_fees;") or die($connect->error());
                                                                    while($row = $result->fetch_assoc()){ 
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['school_year']; ?></td>
                                                                    <td><?php echo $row['course']; ?></td>
                                                                    <td><?php echo $row['year_lvl']; ?></td>
                                                                    <td><?php echo $row['semester']; ?></td>
                                                                    <td><?php echo $row['fee_name']; ?></td>
                                                                    <td><?php echo $row['amount']; ?></td>
                                                                    <td><?php echo $row['type']; ?></td>
                                                                    <td><?php echo $row['time_created']; ?></td>
                                                                    <td>
                                                                        <a href="../include/fees_management.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="delete" name="delete">
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
    <!-- local fees -->
    <div class="modal fade" id="localfees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage fees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="manage_fees.php" id="manage_form">
                        <div class="form-group">
                            <label for="school_year">School Year</label>
                            <select class="custom-select" id="school_year" name="school_year">
                                <?php
                                    $status="open";
                                    $result = $connect->query("SELECT * FROM year WHERE status ='$status';") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['date']; ?>"><?php echo $row["date"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="custom-select" id="year" name="year">
                                <?php
                                    $result = $connect->query("SELECT * FROM year_lvl") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['year']; ?>"><?php echo $row["year"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="custom-select" id="course" name="course">
                                <?php
                                    $result = $connect->query("SELECT * FROM course") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="custom-select" id="semester" name="semester">
                                <?php
                                    $result = $connect->query("SELECT * FROM semester") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['sem']; ?>"><?php echo $row["sem"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="local_fee">Local fees</label>
                            <select class="custom-select" id="local_fee" name="local_fees" required>
                                <?php
                                    $designation="local fees";
                                    $result = $connect->query("SELECT * FROM fees WHERE designation='$designation';") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['id'],"-",$row['fee_name']," - ",$row['type']?>"><?php echo $row["fee_name"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <div class="modal fade" id="university" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage fees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="manage_fees.php" id="manage_form">
                        <div class="form-group">
                            <label for="school_year">School Year</label>
                            <select class="custom-select" id="school_year" name="school_year">
                                <?php
                                    $status="open";
                                    $result = $connect->query("SELECT * FROM year WHERE status ='$status';") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['date']; ?>"><?php echo $row["date"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="custom-select" id="year" name="year">
                                <?php
                                    $result = $connect->query("SELECT * FROM year_lvl") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['year']; ?>"><?php echo $row["year"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="custom-select" id="course" name="course">
                                <?php
                                    $result = $connect->query("SELECT * FROM course") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="custom-select" id="semester" name="semester">
                                <?php
                                    $result = $connect->query("SELECT * FROM semester") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['sem']; ?>"><?php echo $row["sem"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="local_fee">University fees</label>
                            <select class="custom-select" id="local_fee" name="local_fees">
                                <?php
                                    $designation="university fees";
                                    $result = $connect->query("SELECT * FROM fees WHERE designation='$designation';") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['id'],"-",$row['fee_name']," - ",$row['type']?>"><?php echo $row["fee_name"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Create</button>
                        </div>
                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="../js/datable.js"></script>
    <script src="../js/validation.js"></script>
    <script src="../js/alert-slide.js"></script>    
</body>
</html>