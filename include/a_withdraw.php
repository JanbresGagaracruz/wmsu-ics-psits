<?php
    ob_start();
    include("../include/userlogin.php");
    include('database.php');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['usertype'] != "admin"){
        header("location: login.php?success=1");
        $_SESSION['message'] = "You cannot access this page unless you are a officer!";
    } 

    if(isset($_POST["create"])){
        if(!empty($_FILES["file"]["name"])) { 
            $transaction = $_POST['transaction'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $name = $_POST['name'];
            
            $fileName = basename($_FILES["file"]["name"]);
            $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
            $Upload_type = array('jpg','png','jpeg','gif');

            if(in_array($fileType, $Upload_type )){
                $image = $_FILES['file']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image));
                $insert = $connect->query("INSERT INTO withdraw (transaction,amount,date,name,img) VALUES ('".$transaction."','".$amount."','".$date."','".$name."','".$imgContent."')");
                if($insert){
                    header('location: ../view/withdraw.php?success=1');
                    $_SESSION['message'] = "You successfully added a new record.";
                }else{
                    header('location: ../view/withdraw.php?success=2');
                    $_SESSION['message'] = "File upload failed, please try again."; 
                } 
            }else{
                header('location: ../view/withdraw.php?success=2');
                $_SESSION['message'] = 'Sorry, only jpg and png image is allowed to upload.';
            }
        }else{
            header('location: ../view/withdraw.php?success=2');
            $_SESSION['message'] = 'Please, select an image file to upload';
        }
    }

    //delete file
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $result = $connect->query("SELECT * FROM withdraw WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];  
            $file_name = $row['file_name']; 
            $targetDir = "../img_file/";
            //concatenate file name and upload directory to delete the file inside the folder
            $targetFilePath = $targetDir . $file_name;
            $check=$connect->query("DELETE FROM withdraw WHERE id = '$id';") or die($connect->error);
            if($check){
                //check if the file path does exist and delete from upload folder
                if(!unlink($targetFilePath)){
                    header('location: ../view/withdraw.php?success=1');
                    $_SESSION['message'] = "Successfully deleted.";
                }else{
                    header('location: ../view/withdraw.php?success=1');
                    $_SESSION['message'] = "Successfully deleted.";
                }
            }else{
                header('location: ../view/withdraw.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }
    //view withdraw details
    if(isset($_POST["id"]))  
    {  
        $output = '';  
        $query = "SELECT * FROM withdraw WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $output .= '  
        <div class="table-responsive">  
            <table class="table table-bordered">';  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                    <img src="data:image/jpeg;charset=utf8;base64,'.base64_encode($row['img'] ).'" height="300" width="500"/>
                    <tr>  
                        <td width="30%"><label>Transaction #</label></td>  
                        <td width="70%">'.$row["transaction"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Amount</label></td>  
                        <td width="70%">'.$row["amount"].'</td>  
                    </tr>    
                    <tr>  
                        <td width="30%"><label>Date</label></td>  
                        <td width="70%">'.$row["date"].'</td>  
                    </tr>
                    <tr>  
                        <td width="30%"><label>Withdraw by</label></td>  
                        <td width="70%">'.$row["name"].'</td>  
                    </tr> 
                    ';  
        }  
        $output .= "
            </table>
        </div>";  
        echo $output;  
    }

    ob_end_flush();
?>