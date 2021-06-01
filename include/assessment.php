<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("database.php");
    
    if(isset($_POST["id"]))  {  
        $query = "SELECT id, CONCAT(last_name, ', ', first_name,' ',middle_name) as full_name, course FROM request WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }

    if(isset($_POST['create'])){ 
        $student_id = $_POST['id'];
        $manage_id = $_POST['manage_id'];
        $year_id = $_POST['year'];
        $semester_id = $_POST['semester'];
        $u_fees = $_POST['u_fees'];
        $u_payment = $_POST['u_payment'];
        $balance = $_POST['tp'];
        $session = $_POST['s_year'];
        $stat= "approved";
        $q = 0;

        $res = $connect->query(" SELECT 
                                    request.id AS sid,
                                    year.id AS yid,
                                    year.date AS school,
                                    manage_fees.id as mid,
                                    year_lvl.id AS ylid,
                                    student_assessment.sem AS usem
                                    FROM student_assessment
                                        LEFT OUTER JOIN request
                                            ON request.id = student_assessment.student_id
                                        LEFT OUTER JOIN year
                                            ON year.id = student_assessment.school_year
                                        LEFT OUTER JOIN manage_fees
                                            ON manage_fees.id = student_assessment.manage_id
                                        LEFT OUTER JOIN year_lvl
                                            ON year_lvl.id = student_assessment.year_id
                                        WHERE request.id = '$student_id' AND year.id = '$session' AND manage_fees.id = '$manage_id' AND year_lvl.id = '$year_id' AND sem = '$semester_id'
        ");
        if(count($res) == 1){
            $row = $res->fetch_array();
            $sy = $row['school'];
            if($row['sid'] == $student_id && $row['yid'] == $session && $row['mid'] == $manage_id && $row['ylid'] == $year_id && $row['usem'] == $semester_id){
                header('location: ../view/officer_studAssessment.php?success=2');
                $_SESSION['message'] = "This student has already paid for this school year '$sy'!";
            }else{
                $q=1;
            }
        }
        if($q == 1){
            $sql = "INSERT INTO student_assessment (student_id, school_year, manage_id, year_id,sem,u_fees,u_payment, balance,promissory_approval) 
            VALUES ('$student_id','$session','$manage_id','$year_id','$semester_id','$u_fees','$u_payment','$balance','$stat')";
            $assess = mysqli_query($connect, $sql);
            if($assess){
                $update = "UPDATE request SET assessment_status = 'assessed' WHERE id = '$student_id';";
                mysqli_query($connect, $update);
                header('location: ../view/officer_studAssessment.php?success=1');
                $_SESSION['message'] = "Sucessfully assess! the student may now proceed to the cashier!";
            }else{
                header('location: ../view/officer_studAssessment.php?success=1');
                $_SESSION['message'] = "Something went wrong!";
            }
        }

    }
    ob_end_flush();

?>