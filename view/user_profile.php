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
    <div class="col-12 pt-3 pb-3">
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7 col-md-6">
                            <div class="card user-profile">
                                <div class="card-body">
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
                                            <strong><h3><?php echo $row['email']; ?></h1></strong>
                                            <small>Name: <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?> <?php echo $row['middle_name']; ?></small>
                                            <small>Course: <?php echo $row['course']; ?></small>
                                        <?php } ?>
                                        <button class="btn btn-primary" data-toggle="modal"data-target="#yearlvl"><i class="fas fa-edit"></i> Update profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#history" role="tab"
                                                aria-controls="history" aria-selected="true"><strong>Payment History</strong></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="mypublic-tab">
                                        <div class="tab-pane fade active show" id="history" role="tabpanel"
                                            aria-labelledby="paymenthistory-tab">
                                            <div id="course-9" class="card mt-1">
                                                <div class="card-body row">
                                                    <table id="table" class="table table-hover table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">School Year</th>
                                                                <th scope="col">StudentID</th>
                                                                <th scope="col">First name</th>
                                                                <th scope="col">Middle name</th>
                                                                <th scope="col">Last name</th>
                                                                <th scope="col">Course</th>
                                                                <th scope="col">Section</th>
                                                                <th scope="col">Year level</th>
                                                                <th scope="col">Semester</th>
                                                                <th scope="col">School fees</th>
                                                                <th scope="col">Total payment</th>
                                                                <th scope="col">Payment type</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">Current balance</th>
                                                                <th scope="col">Payment Status</th>
                                                                <th scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>2020-2021</td>
                                                                <td>BG201803394</td>
                                                                <td>Janbres</td>
                                                                <td>Molino</td>
                                                                <td>Gagaracruz</td>
                                                                <td>Computer Science</td>
                                                                <td>B</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>ICS FEST, University Digest</td>
                                                                <td>280</td>
                                                                <td>Full</td>
                                                                <td>280</td>
                                                                <td>0</td>
                                                                <td>PAID</td>
                                                                <td>1/23/2021</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Promissory note-->
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#history" role="tab"
                                                aria-controls="history" aria-selected="true"><strong>Promissory History</strong></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="mypublic-tab">
                                        <div class="tab-pane fade active show" id="history" role="tabpanel"
                                            aria-labelledby="paymenthistory-tab">
                                            <div id="course-9" class="card mt-1">
                                                <div class="card-body row">
                                                    <table id="table" class="table table-hover table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">School Year</th>
                                                                <th scope="col">StudentID</th>
                                                                <th scope="col">First name</th>
                                                                <th scope="col">Middle name</th>
                                                                <th scope="col">Last name</th>
                                                                <th scope="col">Course</th>
                                                                <th scope="col">Year level</th>
                                                                <th scope="col">Semester</th>
                                                                <th scope="col">School fees</th>
                                                                <th scope="col">Total payment</th>
                                                                <th scope="col">Reason</th>
                                                                <th scope="col">Current date</th>
                                                                <th scope="col">Date to pay</th>
                                                                <th scope="col">Payment Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>2020-2021</td>
                                                                <td>BG201803394</td>
                                                                <td>Janbres</td>
                                                                <td>Molino</td>
                                                                <td>Gagaracruz</td>
                                                                <td>Computer Science</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>ICS FEST, University Digest</td>
                                                                <td>280</td>
                                                                <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                                                                <td>1/23/2021</td>
                                                                <td>2/23/2021</td>
                                                                <td>ONGOING</td>
                                                            </tr>
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
            </div>
        </section>
        <!--END-->

        <div class="modal fade" id="yearlvl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="form-group">
                                <img src="/assets/stud.png" class="img-fluid" alt="Responsive image">
                                <div class="file-loading">
                                    <input id="input-b9" name="input-b9[]" multiple type="file"'>
                                </div>
                                <div id="kartik-file-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="studentid">Email address</label>
                                <input type="email" class="form-control" id="studentid" aria-describedby="emailHelp"
                                    placeholder="Enter email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
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
    <!--Custom js-->
    <script src="/js/notification.js"></script>
</body>

</html>