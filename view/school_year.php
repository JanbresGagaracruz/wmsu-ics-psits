<?php
    ob_start();
    require("../include/create_year.php");
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

    <title>School session | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >School session</h2>
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
                        School year records
                        <a data-toggle="modal" data-target="#schoolyear" class="btn btn-primary">Create School year</span></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">School Year</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = ("SELECT * FROM year ORDER BY date ASC");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                            <a href="../include/create_year.php?stat_on=<?php echo $row['id'] ?>" class="btn btn-primary btn-xs" id="stat_on" name="stat_on">
                                                <span class="fas fa-toggle-on"></span>
                                            </a>
                                            <a href="../include/create_year.php?stat_off=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="stat_off" name="stat_off">
                                                <span class="fas fa-toggle-off"></span>
                                            </a>
                                            <a href="../include/create_year.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="delete" name="delete">
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
    <!-- Modal for school year -->
    <div class="modal fade" id="schoolyear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add School year</h5>
                    <button type="button" class="close school_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="school_year.php" method="POST" id="school_form">
                    <div class="modal-body">
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" name="current" id="current" >
                            <div class="input-group-addon">to</div>
                            <input type="text" class="form-control" name="end" id="end" >
                            <div id="school_validation"></div>
                        </div>
                        <input type="hidden" value="close" name="status">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="save">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div id="footer-sec">
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
        $(document).ready(function () {
        $("#school_form").validate({
            rules: {
            current: {
                maxlength: 4,
                minlength: 4,
                number: true,
                required: true,
            },
            end: {
                maxlength: 4,
                minlength: 4,
                number: true,
                required: true,
            },
            },
            highlight: function (element) {
            $(element).closest(".form-group input").addClass("text-danger");
            },
            unhighlight: function (element) {
            $(element).closest(".form-group input").removeClass("text-danger");
            },
            errorElement: "small",
            errorClass: "help-block text-danger",
            errorPlacement: function (error, element) {
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
            },
        });
        $('#school_form').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset'); 
        });
        });
    </script>
</body>
</html>
