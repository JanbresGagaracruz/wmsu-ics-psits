<?php
    ob_start();
    require("../include/fees_management.php");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Manage fees | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Manage fees</h2>
                    </div>
                </div>
                <center class="center">
                    <?php if(isset($_SESSION['message']) && $_GET['success'] == 1): ?>    
                        <div class="alert alert-success alert-dismissible mt-2" id="success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php 
                                echo $_SESSION['message'];  
                                unset($_SESSION['message']);
                        ?>
                    <?php elseif(isset($_SESSION['message']) && $_GET['success'] == 2): ?>    
                        <div class="alert alert-danger alert-dismissible mt-2" id="success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php 
                            echo $_SESSION['message'];  
                            unset($_SESSION['message']);
                        ?>
                    <?php endif ?>
                </center>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage fees records
                        <a data-toggle="modal" data-target="#localfees" class="btn btn-primary">Associate fees</span></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr class="p-4">
                                        <th scope="col">School Year</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Year level</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">School fees</th>
                                        <th scope="col">Total fees</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $result = $connect->query("SELECT * FROM year_lvl RIGHT JOIN manage_fees ON year_lvl.id = manage_fees.year_lvl;") or die($connect->error());
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['school_year']; ?></td>
                                        <td><?php echo $row['course']; ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td><?php echo $row['semester']; ?></td>
                                        <td><?php echo $row['fee_names']; ?></td>
                                        <td><?php echo $row['total_fees']; ?></td>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for local fees -->
    <div class="modal fade" id="localfees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Associate fees</h5>
                    <button type="button" class="close fees_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="manage_fees.php" id="manage_form">
                        <div class="form-group">
                            <label for="school_year">School Year</label>
                            <select class="custom-select form-control" id="school_year" name="school_year">
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
                            <select class="custom-select form-control" id="year" name="year">
                                <?php
                                    $result = $connect->query("SELECT * FROM year_lvl") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row["year"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="custom-select form-control" id="course" name="course">
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
                            <select class="custom-select form-control" id="semester" name="semester">
                                <?php
                                    $result = $connect->query("SELECT * FROM semester") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['sem']; ?>"><?php echo $row["sem"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="table-sorting  table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table1">
                            <thead>
                                <tr class="p-4">
                                    <th scope="col">Select</th>
                                    <th scope="col">School fees</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = $connect->query("SELECT * FROM fees;") or die($connect->error());
                                    while($row = $result->fetch_assoc()){ 
                                ?>
                                <tr>
                                    <td>              
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input check_amount" name="local_fees">
                                        <label class="custom-control-label" for="check_amount"></label>
                                    </div>
                                    </td>
                                    <td name="selected_fees"><?php echo $row['fee_name']; ?></td>
                                    <td name="amount"><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="form-group">
                            <label for="fs">Fees selected</label>
                            <input type="text" class="form-control" id="fs" name="fs" required readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="tp">Total payment</label>
                            <input type="number" class="form-control" id="tp" name="tp" required readonly="readonly">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div id="footer">
       <strong>WMSU ICS PSITS COLLECTION 2020</strong>
    </div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <!--Custom js-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/datable.js"></script>    
    <script src="../js/alert-slide.js"></script>  
    <script src="../js/jquery.metisMenu.js"></script>
    <script src="../js/custom1.js"></script>
    <script src="../js/validation.js"></script>
    <script>
        $(function() {
            $(".check_amount").click(function(event) {
                var total = 0;
                var name="";
                $("tbody input[type=checkbox]:checked").each(function() {
                    total += parseInt($(this).closest('tr').find('td[name=amount]').text().trim());
                    name += ($(this).closest('tr').find('td[name=selected_fees]').text() + "  ");
                });
                $('#tp').val(total);
                $('#fs').val(name);
            });
        });
    </script> 
</body>
</html>