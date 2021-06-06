<?php
    ob_start();
    include("../include/userlogin.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != "admin"){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access only admin is allowed!";
    }

    function fetch_data()  
    {  
        include("../include/database.php");

        $output = '';  
        $q=0;
        $i=0;
        $get = 0;
        $amount = array();
        $sql=("SELECT 
        CONCAT(request.last_name, ', ', request.first_name,' ', request.middle_name) as full_name,
        request.course,
        request.approval_status,
        student_assessment.promissory_approval,
        student_assessment.sem AS ass,
        year_lvl.year,
        year_lvl.id AS y_lvl,
        sem,
        payment_transaction.payment_status,
        payment_transaction.balance,
        payment_transaction.payment AS pay,
        manage_fees.total_fees,
        manage_fees.fee_names
        FROM payment_transaction
        LEFT OUTER  JOIN student_assessment
            ON student_assessment.id = payment_transaction.assess_id
                LEFT OUTER JOIN manage_fees
                    ON manage_fees.id = student_assessment.manage_id
                    LEFT OUTER JOIN year_lvl
                        ON year_lvl.id = student_assessment.year_id
                        LEFT OUTER JOIN request
                            ON request.id = student_assessment.student_id
        ;");  
        $result = mysqli_query($connect, $sql);  
        while($row = mysqli_fetch_array($result))  
        {   
            if($row['promissory_approval'] == 'approved' && $row['balance'] >= 0){  
                $sta = $row["payment_status"];
                $payment = $row["pay"];
                $bal = $row["balance"];
                if($sta == "paid"){
                    $output .= '<tr>  
                    <td>'.$row["full_name"].'</td>  
                    <td>'.$row["course"].'</td>
                    <td>'.$row["year"].'</td>
                    <td>'.$row["sem"].'</td>
                    <td style="text-align: right;">'.number_format($bal).'</td> 
                    <td style="text-align: right;">'.number_format($payment).'</td> 
                    <td style="background-color: #f8d7da; color: #721c24; text-align: right;">'.$row["payment_status"].'</td>  
                    </tr>  
                            ';  
                }else{
                    $output .= '<tr>  
                    <td>'.$row["full_name"].'</td>  
                    <td>'.$row["course"].'</td>
                    <td>'.$row["year"].'</td>
                    <td>'.$row["sem"].'</td>
                    <td style="text-align: right;">'.number_format($bal).'</td>  
                    <td style="text-align: right;">'.number_format($payment).'</td> 
                    <td style="background-color: #fff3cd; color: #856404; text-align: right;">'.$row["payment_status"].'</td>  
                    </tr>  
                            ';  
                }
                $i=1;
            }else{
                $q=1;
                $_SESSION['message'] = "NO RECORD!";
            header("location: ../view/generate.php?success=1");
            }
            if($i==1){
                $amount[] = $row["pay"];
                $get =  array_sum($amount);
            }
        }
        if($q == 0){
            $output .= '<h4 style="margin-top: 0; text-align: right;">Total payment: '.number_format($get).'</h4>';
            return $output;
        }
    } 
    // 
    function all_data()  
    {  
        include("../include/database.php");

        $output = '';  
        $q=0;
        $i=0;
        $get = 0;
        $amount = array();
        $sql=("SELECT 
        CONCAT(request.last_name, ', ', request.first_name,' ', request.middle_name) as full_name,
        request.course,
        request.approval_status,
        student_assessment.promissory_approval,
        student_assessment.sem AS ass,
        year_lvl.year,
        year_lvl.id AS y_lvl,
        sem,
        payment_transaction.payment_status,
        payment_transaction.balance,
        payment_transaction.payment AS pay,
        manage_fees.total_fees,
        manage_fees.fee_names
        FROM payment_transaction
        LEFT OUTER  JOIN student_assessment
            ON student_assessment.id = payment_transaction.assess_id
                LEFT OUTER JOIN manage_fees
                    ON manage_fees.id = student_assessment.manage_id
                    LEFT OUTER JOIN year_lvl
                        ON year_lvl.id = student_assessment.year_id
                        LEFT OUTER JOIN request
                            ON request.id = student_assessment.student_id
        ;");  
        $result = mysqli_query($connect, $sql);  
        while($row = mysqli_fetch_array($result))  
        {   
            if($row['promissory_approval'] == 'approved' && $row['balance'] >= 0){  
                $sta = $row["payment_status"];
                $payment = $row["pay"];
                $bal = $row["balance"];
                if($sta == "paid"){
                    $output .= '<tr>  
                    <td>'.$row["full_name"].'</td>  
                    <td>'.$row["course"].'</td>
                    <td>'.$row["year"].'</td>
                    <td>'.$row["sem"].'</td>
                    <td style="text-align: right;">'.number_format($bal).'</td> 
                    <td style="text-align: right;">'.number_format($payment).'</td> 
                    <td style="background-color: #f8d7da; color: #721c24; text-align: right;">'.$row["payment_status"].'</td>  
                    </tr>  
                            ';  
                }else{
                    $output .= '<tr>  
                    <td>'.$row["full_name"].'</td>  
                    <td>'.$row["course"].'</td>
                    <td>'.$row["year"].'</td>
                    <td>'.$row["sem"].'</td>
                    <td style="text-align: right;">'.number_format($bal).'</td>  
                    <td style="text-align: right;">'.number_format($payment).'</td> 
                    <td style="background-color: #fff3cd; color: #856404; text-align: right;">'.$row["payment_status"].'</td>  
                    </tr>  
                            ';  
                }
                $i=1;
            }else{
                $q=1;
                $_SESSION['message'] = "NO RECORD!";
            header("location: ../view/generate.php?success=1");
            }
            if($i==1){
                $amount[] = $row["pay"];
                $get =  array_sum($amount);
            }
        }
        if($q == 0){
            $output .= '<h4 style="margin-top: 0; text-align: right;">Total payment: '.number_format($get).'</h4>';
            return $output;
        }
    } 
    //
    if(isset($_POST["create_pdf"]))  
    {  
        require_once('../tcpdf/tcpdf.php');  
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);  
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->setPrintHeader(TRUE);  
        $obj_pdf->setPrintFooter(TRUE);  
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);  
        $obj_pdf->SetFont('helvetica', '', 12);  
        $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $obj_pdf->AddPage('L', array('format' => 'A', 'Rotate' => -360));  
        $content = '';  
        $content .= '
        <style>
            h4{
                color: #721c24;
            }
        </style>
        <h5>PSITS Collection Reports</h5>
        <br /><br />  
        <table border="0" cellspacing="0" cellpadding="5">  
            <tr>  
                <th width="20%" style="background-color: #43A047; color: #ffffff;">Full Name</th>  
                <th width="20%" style="background-color: #43A047; color: #ffffff;">Course</th>  
                <th width="12%" style="background-color: #43A047; color: #ffffff;">Year</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff;">Sem</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Balance</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Payment</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Status</th>  
            </tr>  
        ';  
        $content .= fetch_data();  
        $content .= '</table>';  
        $obj_pdf->writeHTML($content);

        $obj_pdf->Output('StudentReport.pdf', 'D');
    }
    //
    if(isset($_POST["all_record"]))  
    {  
        require_once('../tcpdf/tcpdf.php');  
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);  
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->setPrintHeader(TRUE);  
        $obj_pdf->setPrintFooter(TRUE);  
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);  
        $obj_pdf->SetFont('helvetica', '', 12);  
        $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $obj_pdf->AddPage('L', array('format' => 'A', 'Rotate' => -360));  
        $content = '';  
        $content .= '
        <style>
            h4{
                color: #721c24;
            }
        </style>
        <h5>PSITS Collection Reports</h5>
        <br /><br />  
        <table border="0" cellspacing="0" cellpadding="5">  
            <tr>  
                <th width="20%" style="background-color: #43A047; color: #ffffff;">Full Name</th>  
                <th width="20%" style="background-color: #43A047; color: #ffffff;">Course</th>  
                <th width="12%" style="background-color: #43A047; color: #ffffff;">Year</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff;">Sem</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Balance</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Payment</th>
                <th width="12%" style="background-color: #43A047; color: #ffffff; text-align: right;">Status</th>  
            </tr>  
        ';  
        $content .= all_data();  
        $content .= '</table>';  
        $obj_pdf->writeHTML($content);

        $obj_pdf->Output('StudentReport.pdf', 'D');
    }
    //
    ob_end_flush();
?>
