<?php
    ob_start();
    include('../include/submit_file.php');
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Announcement | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header_officer.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Announcement</h2>
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
                        Announcement records
                        <a data-toggle="modal" data-target="#announce" class="btn btn-primary">Create announcement</span></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">File</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = ("SELECT * FROM file_upload");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['file_name']; ?></td>
                                        <td>
                                            <a href="../include/submit_file.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" id="delete" name="delete">
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

    <!-- Modal for announcement -->
    <div class="modal fade" id="announce" tabindex="-1" role="dialog" aria-labelledby="announcemodal" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="announcemodal">Create Announcement</h5>
            <button type="button" class="close announce_close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="announcement.php" method="post" enctype="multipart/form-data" id="announce_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">File name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter title">
                        <div id="title_validation"></div>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                        <small class="text-success">Only PDF file are accepted.</small>
                        <div id="filename_validation"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitBtn" name="submit">Submit</button>
                </div>
            </form>
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
    <script src="../js/validation.js"></script>
    
</body>
</html>
