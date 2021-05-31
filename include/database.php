<?php 

$localhost = "localhost";
$username = "u179407683_collection";
$password = "Katalepsy123";
$dbname = "u179407683_psits";
/* 
$username = "root";
$password = "";
$dbname = "psits_system";
 */
// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
	die("connection failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}

?>