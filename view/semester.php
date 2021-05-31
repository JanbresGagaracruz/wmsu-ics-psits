<?php
    ob_start();
    require("../include/create_sem.php");
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

    <title>Semester | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Semester</h2>
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
                        Semester records
                        <a data-toggle="modal" data-target="#semester_modal" class="btn btn-primary">Create semester</span></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = ("SELECT * FROM semester");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['sem']; ?></td>
                                        <td>
                                            <a name="edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-md edit_data"> 
                                                <span class="fas fa-edit"></span>
                                            </a>
                                            <a href="../include/create_sem.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-md course_delete" id="delete" name="delete">
                                                <span class="fas fa-times"></span>
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
    <!-- Modal for semester -->
    <div class="modal fade" id="semester_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create semester</h5>
                    <button type="button" class="close semester_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="semester.php" method="POST" id="semester_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control " name="semester" id="semester" placeholder="Enter semester" required>
                            <div id="semester_validation"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="create" id="create">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update semester</h5>
                    <button type="button" class="close semester_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="semester.php" method="POST" id="edit_semester_form">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                        <div class="form-group">
                            <label for="edit_semester">Semester</label>
                            <input type="text" class="form-control " name="edit_semester" id="edit_semester" placeholder="Enter semester" required>
                            <div id="edit_semester_validation"></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="Update" name="Update" value="Update"/>
                        </div>
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
    <script>
        $(document).on('click', '.edit_data', function(){  
        var id = $(this).attr("id");  
        $.ajax({  
            url:"../include/create_sem.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){  
                $('#edit_semester').val(data.sem);
                $('#edit_id').val(data.id);
                $('#edit_modal').modal('show');
            }   
        }); 
        $('#edit_modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset'); 
            });
        }); 
    </script> 
</body>
</html>
