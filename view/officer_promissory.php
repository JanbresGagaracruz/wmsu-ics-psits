<?php
    ob_start();
    include("../include/create_promissory.php");
    include("../include/userlogin.php");
    //include("../templates/template.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/basic.css" rel="stylesheet" />
    <link href="../css/error.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/ics_icon.ico">

    <title>Student promissory | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header_officer.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Associate student promissory note</h2>
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
                    </div>
                    <div class="panel-body">
                        <div class="table-sorting  table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Usertype</th>
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = ("SELECT * FROM request WHERE usertype NOT LIKE 'admin' AND approval_status='active' AND assessment_status='not assessed'");
                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr><?php if($row['approval_status'] == 'active'){ ?>
                                        <?php } ?>
                                    
                                        <td><?php echo $row['last_name']; echo ',';?> <?php echo $row['first_name'];?>  <?php echo $row['middle_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['usertype']; ?></td>
                                        <td><?php echo $row['course']; ?></td>
                                        <td>
                                            <a type="button" name="view"  id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs get_fee" data-toggle="tooltip" data-placement="top" title="Associate fees">
                                                <span class="fas fa-balance-scale fa-2x"></span>
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
    <!-- Modal for create account -->
    <div class="modal fade" id="fee_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create promissory note</h5>
                    <button type="button" class="close get_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="officer_promissory.php" id="reg">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">School Session</legend>
                            <div class="form-group">
                                <select class="form-control" id="s_year" name="s_year" readonly="readonly" style="font-weight: bold;">
                                    <?php
                                        $result = $connect->query("SELECT * FROM year WHERE status = 'open';") or die($connect->error());
                                        while($row = $result->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["date"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Student Information</legend>
                            <input type="hidden" class="form-control" id="id" name="id">  
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" readonly="readonly" style="font-weight: bold;">
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" id="course" name="course" readonly="readonly" style="font-weight: bold;">
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control" id="semester" name="semester" required>
                                    <?php
                                        $result = $connect->query("SELECT * FROM semester") or die($connect->error());
                                        while($row = $result->fetch_assoc()):
                                    ?>
                                        <option value="" selected="selected" hidden="hidden">Select Semester</option>
                                        <option value="<?php echo $row['sem']; ?>"><?php echo $row["sem"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <select class="form-control" id="year" name="year" required>
                                    <?php
                                        $result = $connect->query("SELECT * FROM year_lvl ORDER BY year ASC") or die($connect->error());
                                        while($row = $result->fetch_assoc()):
                                    ?>
                                        <option value="" selected="selected" hidden="hidden">Select year level</option>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["year"]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </fieldset>
                        <div class="form-group mt-1 mb-1" id="fee_names"></div> <!-- Total fees -->
                        <div class="form-group" id="total_fees" ></div> <!-- Total fees -->
                        <div class="modal-footer">
                            <button class="btn btn-success" name="create" id="create" type="submit">Submit</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <!--Custom js-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/datable.js"></script>
    <script src="../js/validation.js"></script>    
    <script src="../js/alert-slide.js"></script> 
    <script src="../js/jquery.metisMenu.js"></script>
    <script src="../js/custom1.js"></script>
    <script>
        $(document).on('click', '.get_fee', function(){  
        var id = $(this).attr("id");   
        $.ajax({  
            url:"../include/create_promissory.php",  
            method:"POST",  
            data:{
                id:id
            },  
            dataType:"json",  
            success:function(data){  
                $('#name').val(data.full_name);
                $('#course').val(data.course);
                $('#id').val(data.id);
                $('#fee_modal').modal('show');
            }   
        }); 
        $('#fee_modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset'); 
            document.location.reload();
            });
        }); 
    </script> 
    <script>        
        $(document).ready(function () {
            $("#year").change(function() {
                $.ajax({
                    type: "post",
                    url: "../templates/promissory_template.php",
                    data: {
                        "course": $("#course").val(),
                        "semester": $("#semester").val(),
                        "year": $("#year").val(),
                        "s_year": $("#s_year").val(),
                    },
                    success: function(data) {
                        $("#total_fees").html(data);
                    }
                });
            });		
        });
        $( "#reg" ).validate( {
            rules: {
                u_payment: {
                    required: true,
                    digits: true,
                    max: function() {
                        return parseInt($('#tp').val());
                    },
                    min:1,
                }	
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                error.addClass( "help-block" );
                element.parents( ".u_val" ).addClass( "has-feedback" );
    
                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
                if ( !element.next( "span" )[ 0 ] ) {
                    $( "<span class=\'form-control-feedback\'></span>" ).insertAfter( element );
                }
            },
            success: function ( label, element ) {
                if ( !$( element ).next( "span" )[ 0 ] ) {
                    $( "<span class=\' form-control-feedback\'></span>" ).insertAfter( $( element ) );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".u_val" ).addClass( "has-error" ).removeClass( "has-success" );
                $('#create').prop('disabled',true);
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".u_val" ).addClass( "has-success" ).removeClass( "has-error" );
                $('#create').prop('disabled',false);
            }
        } );
    </script>
</body>
</html>
