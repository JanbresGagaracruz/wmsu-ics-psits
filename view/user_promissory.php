<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../include/userlogin.php');
    include('../include/create_promissory.php');
    if($_SESSION['usertype'] != 'Student'){
        header('location: login.php?success=1');
        $_SESSION['message'] = "Access denied make sure you log in first.";
    }
    $id = $_SESSION['id'];
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!--Custom CSS-->
  <link rel="shortcut icon" href="../assets/ics_icon.ico">
  <link rel="stylesheet" href="../css/profile.css">
  <title>Promissory note | Institute of Computer Studies</title>
</head>

<body>
    <?php require('homepage_template.php');?>

    <!--top section-->
    <div class="container">
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
        <div class="row justify-content-center">
            <div class="col-10 pt-3 pb-3">
                <div class="card top-card">
                    <div class="card-body ">
                        <div class="d-flex">
                            <div class="card-title">
                                <h2>Create promissory</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="region-main">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7 col-md-12">
                                    <div class="card user-profile">
                                        <div class="card-body">
                                        <form method="POST" action="user_promissory.php" id="promissory">
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border">Student Information</legend>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                <?php
                                                    $result = $connect->query("SELECT  course,CONCAT(last_name, ', ', first_name,' ',middle_name) as full_name FROM request WHERE id = $id; ") or die($connect->error());
                                                    while($row = $result->fetch_assoc()):
                                                ?>
                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>">  
                                                    <input type="text" class="form-control" id="name" name="name" readonly="readonly" value="<?php echo $row['full_name']; ?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="course">Course</label>
                                                    <input type="text" class="form-control" id="course" name="course" readonly="readonly" value="<?php echo $row['course']; ?>">
    
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
                                                            $result = $connect->query("SELECT * FROM year_lvl") or die($connect->error());
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
                                            <?php endwhile; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>                                    

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
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/datable.js"></script>
    <script src="../js/alert-slide.js" ></script>
    
    <script>
        $(document).ready(function () {
            $("#year").change(function() {
                $.ajax({
                    type: "post",
                    url: "../templates/user_promissory_template.php",
                    data: {
                        "course": $("#course").val(),
                        "semester": $("#semester").val(),
                        "year": $("#year").val(),
                    },
                    success: function(data) {
                        $("#total_fees").html(data);
                    }
                });
            });		
        });
        $( "#promissory" ).validate( {
            rules: {
                u_payment: {
                    required: true,
                    digits: true,
                    max: function() {
                        return parseInt($('#tp').val());
                    },
                    min:1,
                },
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
                $('#submit').prop('disabled',true);
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".u_val" ).addClass( "has-success" ).removeClass( "has-error" );
                $('#submit').prop('disabled',false);
            }
        } );
    </script>
</body>
</html>