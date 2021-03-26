<?php
    include('database.php');

    if(isset($_POST['create_local'])){
        $fee_name=$_POST['fee_name'];
        $amount=$_POST['amount'];
        $type=$_POST['type'];
        $designation="local fees";
        $check=$connect->query("INSERT INTO fees (fee_name,amount,type,designation) VALUES ('$fee_name','$amount','$type','$designation')") or die($connect->error());
        if($check){
            header('location: ../view/fees.php?success=1');
            $_SESSION['message'] = "You have successfully added ".$fee_name. " designation ".$designation.".";
        }else{
            header('location: ../view/fees.php?success=1');
            $_SESSION['message'] = "Something went wrong.";
        }
    }
    
    if(isset($_POST['create_uni'])){
        $fee_name=$_POST['fee_name'];
        $amount=$_POST['amount'];
        $type=$_POST['type'];
        $designation="university fees";
        $check=$connect->query("INSERT INTO fees (fee_name,amount,type,designation) VALUES ('$fee_name','$amount','$type','$designation')") or die($connect->error());
        if($check){
            header('location: ../view/fees.php?success=1');
            $_SESSION['message'] = "You have successfully added ".$fee_name. " designation ".$designation.".";
        }else{
            header('location: ../view/fees.php?success=1');
            $_SESSION['message'] = "Something went wrong.";
        }
    }

    //Live validation to check whether fee name is existing or not
    if(isset($_POST['fee_name']))
    {
        $fee_name = $_POST['fee_name'];
        $query = "SELECT * FROM fees WHERE fee_name = '$fee_name';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This fee is already existing.
                    </span> ';
            echo "<script>$('#create').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }

    //delete school year
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $connect->query("SELECT * FROM fees WHERE id = '$id';") or die($connect->error());
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id']; 
            $fee_name = $row['fee_name'];  
            $check=$connect->query("DELETE FROM fees WHERE id= '$id';") or die($connect->error);
            if($check){
                header('location: ../view/fees.php?success=1');
                $_SESSION['message'] = "Successfully deleted ".$fee_name. ".";
            }else{
                header('location: ../view/fees.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }

?>