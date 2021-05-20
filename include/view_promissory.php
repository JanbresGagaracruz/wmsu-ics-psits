<?php  
    ob_start();
    include('database.php');


    if(isset($_POST["id"]))  
    {  
        $output = '';  
        $query=("SELECT
        request.id,
        request.course, 
        request.email, 
        request.usertype, 
        request.approval_status, 
        CONCAT(last_name, ', ', first_name,' ',middle_name) AS full_name,
        manage_fees.total_fees,
        manage_fees.fee_names,
        manage_fees.id,
        year_lvl.id,
        year_lvl.year,
        sem,
        student_assessment.u_fees,
        student_assessment.date_to_pay,
        student_assessment.reason,
        student_assessment.promissory_approval,
        student_assessment.u_payment,
        student_assessment.balance,
        student_assessment.id
        FROM student_assessment
        JOIN request
            ON request.id = student_assessment.student_id
        LEFT JOIN manage_fees
            ON manage_fees.id = student_assessment.manage_id
        LEFT JOIN year_lvl
            ON year_lvl.id = student_assessment.year_id
            WHERE student_assessment.id = '".$_POST["id"]."';    
        ");
        $result = mysqli_query($connect, $query);  
        $output .= '  
        <div class="table-responsive">  
            <table class="table table-bordered table-hover">';  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                    <tr>  
                        <td width="30%"><label>Student id</label></td>  
                        <td width="70%">'.$row["full_name"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Year level</label></td>  
                        <td width="70%">'.$row["year"].'</td>  
                    </tr> 
                    <tr>  
                        <td width="30%"><label>Semester</label></td>  
                        <td width="70%">'.$row["sem"].'</td>  
                    </tr> 
                    <tr>  
                        <td width="30%"><label>Course</label></td>  
                        <td width="70%">'.$row["course"].'/td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Email</label></td>  
                        <td width="70%">'.$row["email"].'</td>  
                    </tr>    
                    <tr>  
                        <td width="30%"><label>Fees</label></td>  
                        <td width="70%">'.$row["u_fees"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Amount</label></td>  
                        <td width="70%">'.$row["u_payment"].'</td>  
                    </tr> 
                    <tr>  
                        <td width="30%"><label>Reason</label></td>  
                        <td width="70%">'.$row["reason"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Payment date</label></td>  
                        <td width="70%">'.$row["date_to_pay"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Approval status</label></td>  
                        <td width="70%">'.$row["promissory_approval"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Usertype</label></td>  
                        <td width="70%">'.$row["usertype"].'</td>  
                    </tr>
                    ';  
        }  
        $output .= "
            </table>
        </div>";  
        echo $output;  
    } 
    ob_flush(); 
 ?>