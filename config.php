<?php
$servername = "localhost";
$username="id21345226_dragonpay";
$password="Dragon_577523";
$dbase="id21345226_db_dragonpay";

$conn=new mysqli($servername,$username,$password,$dbase);

try {
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
	}
}
catch(Exception $e) {
	echo ' Message: ' .$e->getMessage() ;
	exit;
}

?>