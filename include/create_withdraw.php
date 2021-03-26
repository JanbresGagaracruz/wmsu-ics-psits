<?php
    include('database.php');

    if(isset($_POST["create"]) && !empty($_FILES["file"]["name"])){
        $transaction = $_POST['transaction'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $name = $_POST['name'];

        $targetDir = "../img_file/";
        $Upload_type = array('jpg','png');
        $fileName = basename($_FILES["file"]["name"]);
        $path = $targetDir . $fileName;
        $fileType = pathinfo($path,PATHINFO_EXTENSION);

        if(in_array($fileType, $Upload_type )){
            //moving the pdf file to the upload folder
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
                $insert = $connect->query("INSERT INTO withdraw (transaction,amount,date,name,img) VALUES ('".$transaction."','".$amount."','".$date."','".$name."','".$fileName."')");
                if($insert){
                    header('location: ../view/withdraw.php?success=1');
                    $_SESSION['message'] = "You successfully added a new record.";
                }else{
                    header('location: ../view/withdraw.php?success=1');
                    $_SESSION['message'] = "File upload failed, please try again."; 
                } 
            }else{
                header('location: ../view/withdraw.php?success=1');
                $_SESSION['message'] = "Sorry, there was an error uploading your file.";  
            }
        }else{
            header('location: ../view/withdraw.php?success=1');
            $_SESSION['message'] = 'Sorry, only jpg and png image is allowed to upload.';
        }
    }

    //delete file
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $result = $connect->query("SELECT * FROM withdraw WHERE id = '$id';") or die($connect->error());
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
                header('location: ../view/withdraw.php?success=1');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }
?>