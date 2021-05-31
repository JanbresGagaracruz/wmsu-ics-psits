<?php  
    ob_start();
    include('database.php');


    if(isset($_POST["id"]))  
    {  
        $output = '';  
        $query = "SELECT * FROM request WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $output .= '  
        <div class="table-responsive">  
            <table class="table table-bordered table-hover">';  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                    <tr>  
                        <td width="30%"><label>Student id</label></td>  
                        <td width="70%">'.$row["student_id"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Full name</label></td>  
                        <td width="70%">'.$row["last_name"].', '.$row["first_name"].' '.$row["middle_name"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Email</label></td>  
                        <td width="70%">'.$row["email"].'</td>  
                    </tr>    
                    <tr>  
                        <td width="30%"><label>Course</label></td>  
                        <td width="70%">'.$row["course"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Usertype</label></td>  
                        <td width="70%">'.$row["usertype"].'</td>  
                    </tr> 
                    <tr>  
                        <td width="30%"><label>Account status</label></td>  
                        <td width="70%">'.$row["status"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Approval status</label></td>  
                        <td width="70%">'.$row["approval_status"].'</td>  
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