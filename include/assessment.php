<?php
    include("database.php");

    if(isset($_POST["id"]))  {  
        $query = "SELECT id, CONCAT(last_name, ', ', first_name,' ',middle_name) as full_name, course FROM request WHERE id = '".$_POST["id"]."'";  
        $result = mysqli_query($connect, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }
?>