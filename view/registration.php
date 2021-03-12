<?php
    //
    require('../include/request.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Custom CSS-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/registration.css">
    <title>Registration | Institute of Computer Studies</title>
</head>

<body>
    <nav class="navbar sticky-top">
        <div class="header">
            <a href="login.php"><img src="../assets/ics.png" alt="ICSLOGO"></a>
            <span class="navbar-text">Institute of Computer Studies</span>
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

    <!--Center-->
    <div class="container">
        <div class="row">
            <form method="POST" action="../include/request.php" id="reg">
                <div id="regMenu" class="animate__animated animate__fadeInDown ">
                    <div class="form-group ">
                        <h4>Registration</h4>
                        <small id="note">Your account will be verified by the admin</small>
                    </div>
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
                        <label for="inlineFormCustomSelect">Course</label>
                        <select class="custom-select" id="inlineFormCustomSelect"  name="course" required>
                            <option value="CS" selected>Computer Science</option>
                            <option value="IT">Information Technology</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inlineFormCustomSelect">Year</label>
                        <select class="custom-select" id="inlineFormCustomSelect"  name="year"required>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="custom-select" id="inlineFormCustomSelect"  name="gender"required>
                            <option value="Student" selected>Male</option>
                            <option value="President">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inlineFormCustomSelect">Create account as</label>
                        <select class="custom-select" id="inlineFormCustomSelect" name="usertype" required>
                            <option value="Student" selected>Student</option>
                            <option value="President">President</option>
                            <option value="VP">Vice President</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Officer">Officer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <div class="input-group" id="pass">
                            <input type="password" class="form-control"  name="password" id="password"
                                placeholder="Enter password" required>
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <label id="password-error" class="error" for="password"></label>
                    </div>
                    <input type="hidden" name="status" value="uncheck" >
                    <div class="form-group">
                        <button class="btn btn-success" name="register" id="register"type="submit">Sign up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end-->
    
    <!--Scripts-->
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
    <!--Custom scripts-->
    <script src="../js/password.js"></script>      
    <script src="../js/validation.js"></script>
    <script src="../js/alert-slide.js" ></script>
</body>
</html>
