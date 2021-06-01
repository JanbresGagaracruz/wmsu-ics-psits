<?php
    ob_start();
    require('../include/request.php');
    ob_end_flush();
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

    <!--Center-->
    <div class="container">
        <div class="row">
            <form method="POST" action="../include/request.php" id="reg">
                <div id="regMenu" class="animate__animated animate__fadeInDown ">
                    <div class="form-group ">
                        <h4>Registration</h4>
                        <small id="note">Your account will be verified by the admin</small>
                    </div>
                    <label for="student_id" class="ml-5" style="font-weight: bold;">Student ID</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="student_id" name="student_id"
                        autocomplete="off" placeholder="Enter Student ID" required>
                        <div id="student_validation"></div>
                    </div>
                    <label for="fn" class="ml-5" style="font-weight: bold;">First name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="fn" name="first_name" aria-describedby="firstHelp"
                        autocomplete="off" placeholder="Enter first name" required>
                    </div>
                    <label for="mn" class="ml-5" style="font-weight: bold;">Middle name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mn" name="middle_name" aria-describedby="middleHelp"
                        autocomplete="off" placeholder="Enter middle name" required>
                    </div>
                    <label for="ln" class="ml-5" style="font-weight: bold;">Last name</label>

                    <div class="form-group">
                        <input type="text" class="form-control" id="ln"  name="last_name"aria-describedby="nameHelp"
                        autocomplete="off" placeholder="Enter last name" required>
                    </div>
                    <label for="email" class="ml-5" style="font-weight: bold;">Email address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"
                        autocomplete="off" required>
                        <div id="availability"></div>
                    </div>
                    <label for="course" class="ml-5" style="font-weight: bold;">Course</label>
                    <div class="form-group">
                        <select class="custom-select" id="course" name="course" required>
                            <?php
                                $result = $connect->query("SELECT * FROM course") or die($connect->error());
                                while($row = $result->fetch_assoc()):
                            ?>
                                <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <label for="gender" class="ml-5" style="font-weight: bold;">Gender</label>
                    <div class="form-group">
                        <select class="custom-select" id="gender"  name="gender"required>
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <label for="pass" class="ml-5" style="font-weight: bold;">Password</label>
                    <div class="form-group">
                        <div class="input-group" id="pass">
                            <input type="password" class="form-control"  name="password" id="password"
                                placeholder="Enter password" required>
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <label id="password-error" class="error" for="password"></label>
                    </div>
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
