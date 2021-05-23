<?php
    ob_start();
    require("../include/walkin_account.php");
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

    <title>Create User | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Walk-in registration</h2>
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
                        Students information
                        <a data-toggle="modal" data-target="#user" class="btn btn-primary">Create Account</span></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Usertype</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = ("SELECT * FROM request WHERE usertype NOT LIKE 'admin' AND approval_status='active' ");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr><?php if($row['approval_status'] == 'active'){ ?>
                                        <?php } ?>
                                    
                                        <td><?php echo $row['student_id']; ?></td>
                                        <td><?php echo $row['last_name']; echo ',';?> <?php echo $row['first_name'];?>  <?php echo $row['middle_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['usertype']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                            <a type="button" name="view"  id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data">
                                                <span class="fas fa-eye fa-2x"></span>
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
    <!-- Modal for Viewing student information -->
    <div id="user_detail" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Active user details</h4>  
                </div>  
                <div class="modal-body" id="student_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
        </div>  
    </div> 
    <!-- Modal for create account -->
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                    <button type="button" class="close get_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="walkin_user.php" id="reg">
                        <div class="form-group">
                            <label for="student_id">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id"
                            autocomplete="off" placeholder="Enter Student ID" required>
                            <div id="student_validation"></div>
                        </div>
                        <div class="form-group">
                            <label for="fn">First name</label>
                            <input type="text" class="form-control" id="fn" name="first_name" aria-describedby="firstHelp"
                            autocomplete="off" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group">
                            <label for="mn">Middle name</label>
                            <input type="text" class="form-control" id="mn" name="middle_name" aria-describedby="middleHelp"
                            autocomplete="off" placeholder="Enter middle name" required>
                        </div>
                        <div class="form-group">
                            <label for="ln">Last name</label>
                            <input type="text" class="form-control" id="ln"  name="last_name"aria-describedby="nameHelp"
                            autocomplete="off" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"
                            autocomplete="off" required>
                            <div id="availability"></div>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="form-control" id="course" name="course" required>
                                <?php
                                    $result = $connect->query("SELECT * FROM course") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender"  name="gender"required>
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password"  name="password" placeholder="Enter password" required>
                            <label id="password-error" class="error" for="password"></label>
                        </div>
                        <div class="form-group">
                            <label for="usertype">Create account as</label>
                            <select class="form-control" id="usertype" name="usertype">
                                <option value="Student" selected>Student</option>
                                <option value="President">President</option>
                                <option value="VP">Vice President</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="Officer">Officer</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" name="register" id="register"type="submit">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <!-- footer -->                                
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
    <script src="../js/validation.js"></script>    
    <script src="../js/alert-slide.js"></script> 
    <script src="../js/jquery.metisMenu.js"></script>
    <script src="../js/custom1.js"></script>
    <script src="../js/view_user.js"></script>
    
</body>
</html>
