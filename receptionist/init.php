<?php 
date_default_timezone_set('Africa/Lagos');
$servername = $_SERVER['SERVER_NAME'];
$username = 'root';
$password = '';
$dbname = 'hotel_management';

//Creating Connection
$conn = new mysqli($servername , $username , $password , $dbname);
if ($conn -> connect_error) {
	die( "Connection to Database Failed");
	# code...
}


?>