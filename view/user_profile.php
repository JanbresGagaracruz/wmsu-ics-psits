<?php
    ob_start();
    include('../include/userlogin.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
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
  <!--Custom CSS-->
  <link rel="shortcut icon" href="../assets/ics_icon.ico">
  <link rel="stylesheet" href="../css/profile.css">
  <title>Student Profile | Institute of Computer Studies</title>
</head>

<body>
    <?php require('homepage_template.php');?>

    <!--top section-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Student Profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card profile" style="background-color: #f3f3f3;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7 col-md-12">
                                    <div class="card user-profile">
                                        <div class="card-body" style="box-shadow: hsl(0deg 0% 80%) 0 0 16px;">
                                            <div class="card-user-profile">
                                                <img src="../assets/user_profile.png" class="user-img">
                                            </div>
                                            <div class="user-info">
                                                <?php
                                                    $student_id = $_SESSION['id'];
                                                    $query = ("SELECT * FROM request WHERE id = '$student_id' ");
                                                    $result = mysqli_query($connect, $query);
                                                    while($row = $result->fetch_assoc()){ 
                                                ?>
                                                    <strong><h3 class="my_email"><?php echo $row['email']; ?></h1></strong>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-7 col-md-6">
                                    <div class="card user-profile">
                                        <div class="card-body" style="box-shadow: hsl(0deg 0% 80%) 0 0 16px;">
                                         <h5><i class="fa fa-info-circle" aria-hidden="true"></i> Student Information</h5>
                                            <?php
                                                $student_id = $_SESSION['id'];
                                                $query = ("SELECT * FROM request WHERE id = '$student_id' ");
                                                $result = mysqli_query($connect, $query);
                                                while($row = $result->fetch_assoc()){ 
                                            ?>
                                                <small ><i class="fas fa-id-card"></i> <?php echo $row['student_id']; ?></small><br>
                                                <small ><i class="fas fa-user"></i> <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?> <?php echo $row['middle_name']; ?></small><br>
                                                <small ><i class="fas fa-school"></i> <?php echo $row['course']; ?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-md-6">
                                    <div class="card user-profile" style="box-shadow: hsl(0deg 0% 80%) 0 0 16px;" id="transact">
                                        <div class="card-body">
                                        <h5>Transaction Information</h5>
                                            <a href="payment_history.php">View payment history</a>
                                            <br>
                                            <a href="promissory_history.php">View promissory history</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>    
    </div>                                    
        <!--END-->

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
    <!--Custom js-->
    <script src="/js/notification.js"></script>
</body>

</html>