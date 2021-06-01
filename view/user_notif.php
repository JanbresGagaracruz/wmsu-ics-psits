<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../include/userlogin.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
    $student_id = $_SESSION['id'];

    if(isset($_GET['check']) && !empty($_SESSION['notification'])){
        $tat="close";
        $read = 1;
        $id=$_GET['check'];
        $noti = array();
        $noti =  $_SESSION['notification'];
        $projects = array();
        $query = (" SELECT 
                    notification.date,
                    notification.viewed,
                    notification.id AS notif_session,
                    student_assessment.reason,
                    request.id AS st
                    FROM notification
                    LEFT OUTER JOIN student_assessment
                        ON student_assessment.id = notification.assessment_id
                        LEFT OUTER JOIN request
                            ON request.id = student_assessment.student_id
                                WHERE notification.status='$tat' AND request.id = '$student_id' ");
        $result = mysqli_query($connect, $query);
        while($row = $result->fetch_assoc()){ 
            if($row['viewed'] == 0){
                $projects[] = $row['notif_session'];
            }
            foreach ($projects as $noti)
            {
                $connect->query("UPDATE notification SET viewed='$read' WHERE id LIKE '$noti';")or die($connect->error);
            }
        }
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
  <title>Notification | Institute of Computer Studies</title>
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
                                <h2>Notification</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card profile" style="background-color: #f3f3f3;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7 col-md-12">
                                <?php     
                                $student_id = $_SESSION['id'];
                                    $c = 1;
                                    $tat="close";
                                    $query = (" SELECT 
                                                notification.date,
                                                notification.id AS notif_session,
                                                student_assessment.reason,
                                                request.id AS st
                                                FROM notification
                                                LEFT OUTER JOIN student_assessment
                                                    ON student_assessment.id = notification.assessment_id
                                                    LEFT OUTER JOIN request
                                                        ON request.id = student_assessment.student_id
                                                            WHERE notification.status='$tat' AND request.id = '$student_id' ");
                                    $result = mysqli_query($connect, $query);
                                    $count = mysqli_num_rows($result);
                                ?>
                                <strong class="mb-1">Notification (<?=$count?>)</strong>
                                    <?php
                                        $student_id = $_SESSION['id'];
                                        $type = "Walkin Payment";
                                        $c = 1;
                                        $tat="close";
                                        $query = (" SELECT 
                                                    notification.id AS notif,
                                                    notification.date,
                                                    notification.type ty,
                                                    notification.message AS content,
                                                    notification.id AS notif_session,
                                                    student_assessment.reason,
                                                    request.id AS st
                                                    FROM notification
                                                    LEFT OUTER JOIN student_assessment
                                                        ON student_assessment.id = notification.assessment_id
                                                        LEFT OUTER JOIN request
                                                            ON request.id = student_assessment.student_id
                                                                WHERE notification.status='$tat' AND request.id = '$student_id'");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                        <div class="card mb-1">
                                        <div class="card-body" style="box-shadow: hsl(0deg 0% 80%) 0 0 16px;">
                                            <div class="user-info">
                                                <h5  style="font-weight: bold;"><?php echo $row['ty']; ?></h1><br>
                                                <small  style="font-weight: bold;">Content: <?php echo $row['content']; ?></small><br>
                                                <small  style="font-weight: bold;">Date <?php echo $row['date']; ?></small><br>
                                                <?php if($row['ty'] == "$type"){ ?>
                                                <a href="view_notification.php?viewed=<?php echo $row['notif']?>">View notification</a>
                                                <?php } else{ ?>   
                                                <a href="view_promissory.php?viewed=<?php echo $row['notif']?>">View notification</a>
                                                <?php }?>      
                                            </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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