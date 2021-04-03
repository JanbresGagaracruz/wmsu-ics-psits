<?php
    require('../include/walkin_account.php')
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
                                <h2>Create account</h2>
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
                                                        <h4>Create  account for walk-in student</h4>
                                                    </div>
                                                    <button type="button" class="btn btn-primary  mb-2"
                                                        data-toggle="modal" data-target="#user">
                                                        Add User
                                                    </button>
                                                    <div class="table_wrapper">
                                                        <table id="table" class="table table-hover table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Student ID</th>
                                                                    <th scope="col">First name</th>
                                                                    <th scope="col">Middle name</th>
                                                                    <th scope="col">Last name</th>
                                                                    <th scope="col">Course</th>
                                                                    <th scope="col">Year</th>
                                                                    <th scope="col">Gender</th>
                                                                    <th scope="col">User Type</th>
                                                                    <th scope="col">Assessment status</th>
                                                                    <th scope="col">Payment status</th>
                                                                    <th scope="col">Date added</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $query = ("SELECT * FROM request WHERE status='check';");
                                                                    $result = mysqli_query($connect, $query);
                                                                    while($row = $result->fetch_assoc()){ 
                                                                ?>
                                                                <tr><?php if($row['status'] == 'check'){ ?>
                                                                    <?php } ?>
                                                                    <td><?php echo $row['student_id']; ?></td>
                                                                    <td><?php echo $row['first_name']; ?></td>
                                                                    <td><?php echo $row['last_name']; ?></td>
                                                                    <td><?php echo $row['middle_name']; ?></td>
                                                                    <td><?php echo $row['course']; ?></td>
                                                                    <td><?php echo $row['year']; ?></td>
                                                                    <td><?php echo $row['gender']; ?></td>
                                                                    <td><?php echo $row['usertype']; ?></td>
                                                                    <td><?php echo $row['assessment_status']; ?></td>
                                                                    <td><?php echo $row['payment_status']; ?></td>
                                                                    <td><?php echo $row['date']; ?></td>
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
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="walkin_user.php">
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
                            <select class="custom-select" id="course" name="course" required>
                                <?php
                                    $result = $connect->query("SELECT * FROM course") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['course']; ?>"><?php echo $row["course"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="custom-select" id="year" name="year" required>
                                <?php
                                    $result = $connect->query("SELECT * FROM year_lvl") or die($connect->error());
                                    while($row = $result->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $row['year']; ?>"><?php echo $row["year"]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="custom-select" id="gender"  name="gender"required>
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
                            <select class="custom-select" id="usertype" name="usertype">
                                <option value="Student" selected>Student</option>
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