<?php
    include '../include/database.php';

    $yearId = $_POST['year'];
    $courseId = $_POST['course'];
    $semesterId = $_POST['semester'];

    $sql = "SELECT total_fees, fee_names FROM manage_fees WHERE year_lvl = '$yearId' AND course = '$courseId' AND semester = '$semesterId'";
    $q = $connect->query($sql);
    if($q->num_rows>0)
    {
    $res = $q->fetch_assoc();
    echo 
        ' <script>
        $( "#reg" ).validate( {
            rules: {
                u_payment: {
                    required: true,
                    digits: true,
                    max: '.$res['total_fees'].',
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
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".u_val" ).addClass( "has-success" ).removeClass( "has-error" );
            }
        } );
        </script>';
    }

    