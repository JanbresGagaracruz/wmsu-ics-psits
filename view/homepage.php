<?php
    include('../include/userlogin.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CDN'S -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--Custom CSS-->
    <link rel="shortcut icon" href="../assets/ics_icon.ico">
    <link rel="stylesheet" href="../css/index.css">
    <title>Homepage | Institute of Computer Studies</title>
</head>

<body>
    <!--Navbar-->
    <div class="jumbotron">
        <div class="row">
            <a href="../menu/_menu.html"><img id="headerlogo" src="../assets/wmsu.png" alt="PSTISLOGO"></a>
            <span class="navbar-text" id="headertitle">Philippine Society of Information</span>
            <span class="navbar-text" id="headertitle1">Technology Students</span>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="header">
            <a href="../menu/_menu.html"><img src="../assets/ics.png" alt="ICSLOGO"></a>
            <span class="navbar-text ics">Institute of Computer Studies</span>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav dropdown ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="homepage.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-money-bill"></i> Payment
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="/menu/payment/onlinepayment.html"><i class="fa fa-credit-card"></i> Payment</a>
                        <a class="nav-link" href="/menu/payment/promissory.html"><i class="fa fa-id-card"></i> Promissory</a>
                    </div>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="bell"><i class="fa fa-bell"></i> Notification</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-alt"></i> Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if($_SESSION['first_name']): ?>
                            <a class="dropdown-item" href="/menu/student/student.html">
                            <i class="fa fa-id-badge"></i> 
                            <?php echo $_SESSION['first_name']; ?></a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="/menu/student/student.html"><i class="fa fa-id-badge"></i> User Profile</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="login.php?logout=1"><i class="fa fa-sign-out-alt"></i> Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Notification-->
    <div class="notifications" id="box">
        <h2>Notifications <span>( 1 )</span>
        </h2>
        <div class="notifications-item">
            <div class="text">
                <h4>Promissory Due date</h4>  
                <p><a href="../menu/payment/payment_due.html">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></p>
            </div>
        </div>
    </div>
    <!--Carousel-->
    <div class="container">
        <div class="row">
            <div id="page-content-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../assets/carousel/psits.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../assets/carousel/faculty.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="../assets/carousel/psits.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!--Announcement-->
        <div class="contatiner">
            <div class="center-section">
                <div class="row">
                    <div class="col-md-6 animate__animated animate__fadeInLeft">
                        <div id="announcement">
                            <h2 class="section-title">Announcements</h2>
                            <ul class="list-group">
                                <li class="list-group-item" id="announcement-post">
                                    <a href="files/Financial Report.pdf">Financial Report</a>
                                </li>
                                <li class="list-group-item" id="announcement-post">
                                    <a href="files/Financial Report.pdf">Financial Report</a>
                                </li>
                                <li class="list-group-item" id="announcement-post">
                                    <a href="files/Financial Report.pdf">Financial Report</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 animate__animated animate__fadeInRight">
                        <div id="announcement">
                            <div class="about">
                                <h2 class="section-title">About the Institute</h2>
                                <p class="card-text">Institute of Computer Studies is a stronghold Institute in Western
                                    Mindanao
                                    State University, offering quality education in the field of computer science and
                                    technology. Be proud and take part of this remarkable Institute.</p>
                                <a href="https://www.facebook.com/wmsuics2017" class="card-link">Visit our page now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    
    <!--Recent Activities-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="title ">
                <h3>Recent Activities</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInLeft">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/ange.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/ange.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInLeft">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/dsc.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/dsc.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInRight">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/expo.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/expo.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInRight">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/seminar.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/seminar.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInLeft">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/ace.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/ace.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInLeft">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/cosplay.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/cosplay.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInRight">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/crew.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/crew.jpg" alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb animate__animated animate__fadeInRight">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                    data-image="../assets/activities/opening.jpg" data-target="#image-gallery">
                    <img class="img-thumbnail" src="../assets/activities/opening.jpg" alt="Another alt text">
                </a>
            </div>
        </div>
        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i
                                class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i
                                class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--About-->
    <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="aboutus" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="aboutus">About Us</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body aboutus">
                <div class="row justify-content-center">
                    <img src="../assets/default.png" alt="pixelslogo" class="companylogo">
                </div>
                <div class="row justify-content-center p-4">
                    <h3>Vision</h3>
                    <p class="text-justify">A company that envision to change the future as an effective preference in providing
                        software of your potentials. To be known partner of choice, reliable, innovative and user-friendly
                        software service provider in IT industry where we share hands for productions and promote
                        strong customer relation.
                    </p>
                    <h3>Mission</h3>
                    <p class="text-justify">
                        We, pixels that value every small detail, committed to develop reliable and efficient one
                        stop solution software. Driven by future, providing the best and deliver the best of the best that
                        exceeds customers’ expectations. That would satisfy and enable their organizations to boost their
                        business and operations better.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


    <!--Footer-->
    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="https://www.facebook.com/WMSU-PSITS-110195532363061">
                    <i class="icon ion-social-facebook"></i>
                </a>
                <a href="https://ics-website-604e4.firebaseapp.com/">
                    <i class="icon ion-social-chrome"></i>
                </a>

            </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#about">About</a></li>
            </ul>
            <p class="copyright">PIXELS COMPANY © 2020</p>
        </footer>
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
    <!--Custom Script-->
    <script src="../js/_menuview.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/notification.js"></script>
</body>
</html>