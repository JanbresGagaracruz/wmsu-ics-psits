<?php
    ob_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    // Include the database configuration file
    include('database.php');
    //check the availability of file name
    if(isset($_POST['name']))
    {
        $name = $_POST['name'];
        $query = "SELECT * FROM file_upload WHERE name = '$name';";

        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
            echo '<i class="fa fa-times-circle text-danger ml-1"></i>                    
                    <span p-1 class="text-danger"> 
                        This file name already existing.
                    </span> ';
            echo "<script>$('#create').prop('disabled',true);</script>"; //set disabled register button
        }else{
            echo "<script>$('#create').prop('disabled',false);</script>"; //set enabled register button
        }
    }
    //upload a pdf file
    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
        $targetDir = "../pdf_file/";
        $Upload_type = array('pdf');
        $fileName = basename($_FILES["file"]["name"]);
        $name= $_POST['name'];
        $path = $targetDir . $fileName;
        $fileType = pathinfo($path,PATHINFO_EXTENSION);

        if(in_array($fileType, $Upload_type )){
            //moving the pdf file to the upload folder
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
                $insert = $connect->query("INSERT into file_upload (name,file_name) VALUES ('".$name."','".$fileName."')");
                if($insert){
                    header('location: ../view/announcement.php?success=1');
                    $_SESSION['message'] = "The file ".$fileName. " has been uploaded successfully.";
                }else{
                    header('location: ../view/announcement.php?success=2');
                    $_SESSION['message'] = "File upload failed, please try again."; 
                } 
            }else{
                header('location: ../view/announcement.php?success=2');
                $_SESSION['message'] = "Sorry, there was an error uploading your file.";  
            }
        }else{
            header('location: ../view/announcement.php?success=2');
            $_SESSION['message'] = 'Sorry, only PDF file is allowed to upload.';
        }
    }

    //delete file
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $result = $connect->query("SELECT * FROM file_upload WHERE id = '$id';") or die($connect->error);
        if(count($result) == 1){
            $row = $result->fetch_array();
            $id = $row['id'];  
            $file_name = $row['file_name']; 
            $targetDir = "../pdf_file/";
            //concatenate file name and upload directory to delete the file inside the folder
            $targetFilePath = $targetDir . $file_name;
            $check=$connect->query("DELETE FROM file_upload WHERE id = '$id';") or die($connect->error);
            if($check){
                //check if the file path does exist and delete from upload folder
                if(!unlink($targetFilePath)){
                    header('location: ../view/announcement.php?success=1');
                    $_SESSION['message'] = "Successfully deleted.";
                }else{
                    header('location: ../view/announcement.php?success=1');
                    $_SESSION['message'] = "Successfully deleted.";
                }
            }else{
                header('location: ../view/announcement.php?success=2');
                $_SESSION['message'] = "Something went wrong.";
            }
        }  
    }

    if (isset($_GET['file_id'])) {
        $id = $_GET['file_id'];

        // fetch file to download from database
        $sql = "SELECT * FROM file_upload WHERE id=$id";
        $result = mysqli_query($connect, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = '../pdf_file/' . $file['file_name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('../pdf_file/' . $file['file_name']));
            readfile('../pdf_file/' . $file['file_name']);
            flush();
            exit; 
        }
    }
    ob_end_flush();
?>