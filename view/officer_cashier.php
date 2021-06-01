<?php
    ob_start();
    include("../include/cashier.php");
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
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

    <title>Cashier | Institute of computer studies</title>
</head>
<body>
    <?php
        include("header_officer.php");
    ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-head-line" >Proceed to payment</h2>
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
                                        <th>Selected fees</th>
                                        <th>Payment</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query=("SELECT
                                        request.id,
                                        request.course, 
                                        request.approval_status, 
                                        CONCAT(last_name, ', ', first_name,' ',middle_name) as full_name,
                                        manage_fees.total_fees,
                                        manage_fees.fee_names,
                                        year_lvl.year,
                                        sem,
                                        u_fees,
                                        u_payment,
                                        balance,
                                        student_assessment.id,
                                        promissory_approval,
                                        transaction_status
                                        FROM student_assessment
                                        JOIN request
                                            ON request.id = student_assessment.student_id
                                        JOIN manage_fees
                                            ON manage_fees.id = student_assessment.manage_id
                                        JOIN year_lvl
                                            ON year_lvl.id = student_assessment.year_id;");

                                        $result = mysqli_query($connect, $query);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <?php if($row['approval_status'] == 'active' && $row['promissory_approval'] == 'approved' && $row['balance'] != 0){ ?>
                                    <tr>
                                        <td><?php echo $row['full_name'];?></td>
                                        <td><?php echo $row['u_fees']; ?></td>
                                        <td><?php echo $row['u_payment']; ?></td>
                                        <td><?php echo $row['balance']; ?></td>
                                        <td>
                                            <a type="button" name="view"  id="<?php echo $row["id"]; ?>" class="btn btn-primary btn-xs get_fee" data-toggle="tooltip" data-placement="top" title="Get payment">
                                                <span class="fa fa-cash-register fa-2x"></span>
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php } ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Process payment</h5>
                    <button type="button" class="close get_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="officer_cashier.php" id="reg">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Student information</legend>
                            <input type="hidden" class="form-control" id="id" name="id">  
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" id="course" name="course" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="sem">Semester</label>
                                <input type="text" class="form-control" id="sem" name="sem" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" class="form-control" id="year" name="year" readonly="readonly">
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Total payment</legend>
                            <div class="form-group">
                                <label for="fee_names">Actual fees</label>
                                <input type="text" class="form-control" id="fee_names" name="fee_names" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="total_fees">Total Amount to be paid</label>
                                <input type="text" class="form-control text-right" id="total_fees" name="total_fees" readonly="readonly">
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">List of fees</legend>
                            <div class="table-sorting  table-responsive" style="margin-top: 1rem;">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="p-4">
                                        <th scope="col">Select</th>
                                        <th scope="col">School fees</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $result = $connect->query("SELECT * FROM fees;") or die($connect->error());
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <tr>
                                        <td>              
                                            <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input check_amount" name="local_fees">
                                            <label class="custom-control-label" for="check_amount"></label>
                                        </div>
                                        </td>
                                        <td name="selected_fees"><?php echo $row['fee_name']; ?></td>
                                        <td name="amount" class="text-right"><?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['type']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Payment Information</legend>
                            <div class="form-group">
                                <label for="select_fees">Selected fees</label>
                                <input type="text" class="form-control" id="select_fees" name="select_fees" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="balance">Student balance</label>
                                <input type="text" class="form-control text-right" id="balance" name="balance" readonly="readonly">
                            </div>
                            <div class="form-group u_val">
                                <label for="total_payment">Payment fee</label>
                                <input type="text" class="form-control text-right" id="total_payment" name="total_payment" readonly="readonly">
                            </div>
                        </fieldset>

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
            url:"../include/cashier.php",  
            method:"POST",  
            data:{
                id:id
            },  
            dataType:"json",  
            success:function(data){  
                $('#name').val(data.full_name);
                $('#course').val(data.course);
                $('#year').val(data.year);
                $('#sem').val(data.sem);
                $('#fee_names').val(data.fee_names);
                $('#total_fees').val(data.total_fees);
                $('#select_fees').val(data.u_fees);
                $('#total_payment').val(data.u_payment);
                $('#balance').val(data.balance);
                $('#id').val(data.id);
                $('#fee_modal').modal('show');
            }   
        }); 
        $('#fee_modal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset'); 
                document.location.reload();
            });
        });
        //
        $( "#reg" ).validate( {
            rules: {
                total_payment: {
                    required: true,
                    digits: true,
                    max: function() {
                        return parseInt($('#balance').val());
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
    <script>
        $(function() {
            $(".check_amount").click(function(event) {
                var total = 0;
                var name="";
                $("tbody input[type=checkbox]:checked").each(function() {
                    total += parseInt($(this).closest('tr').find('td[name=amount]').text().trim());
                    name += ($(this).closest('tr').find('td[name=selected_fees]').text() + "  ");
                });
                $('#total_payment').val(total);
                $('#select_fees').val(name);
                $('#total_payment').focus();
            });
        });
    </script>