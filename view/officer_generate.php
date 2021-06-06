<?php
    ob_start();

    include('../include/officer_invoice.php');
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != 1){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Generate | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header_officer.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Generate Report</h2>
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
                <a href="officer_report.php" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <div class="row" style="display: flex; justify-content:center;">
                    <form method="POST" action="officer_generate.php">
                        <input type="submit" name="all_record" class="btn btn-danger" value="Generate All Record" />
                    </form> 
                </div>
                <div class="row" style="margin-top: 2rem;">
                <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="main-box mb-orange" style="padding-left: 7rem;">
                            <form method="POST" id="generate" action="officer_generate.php">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Generate Report</legend>
                                    <div class="form-group">
                                        <select class="form-control" id="course" name="course" style="font-weight: bold;" required>
                                            <?php
                                                $result = $connect->query("SELECT * FROM course;") or die($connect->error());
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                                <option value="" selected="selected" hidden="hidden">Select Course</option>
                                                <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="year" name="year" style="font-weight: bold;" required>
                                            <?php
                                                $result = $connect->query("SELECT * FROM year_lvl ORDER BY year ASC;") or die($connect->error());
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                                <option value="" selected="selected" hidden="hidden">Select Year level</option>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row["year"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="sem" name="sem" style="font-weight: bold;" required>
                                            <?php
                                                $result = $connect->query("SELECT * FROM semester") or die($connect->error());
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                                <option value="" selected="selected" hidden="hidden">Select Semester</option>
                                                <option value="<?php echo $row['sem']; ?>"><?php echo $row["sem"]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Report" />  
                                </fieldset>
                            </form>
                        </div>
                    </div>
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
    <script src="../js/view_user.js"></script>
    <script src="../js/validation.js"></script>
    <script>
    $(document).ready(function () {
        $("#generate").validate({
            rules: {
                course: {
                    required: true,
                },
                year: {
                    required: true,
                },
                sem: {
                    required: true,
                },
            },
            messages: {
                course: {
                    required: "Please select a course",
                },
                year: {
                    required: "Please select a year level",
                },
                sem: {
                    required: "Please select a semester",
                },
            },
        });
    });
    </script>
</body>
</html>
