<?php
include 'init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  	    return $data;
	}
	if(!empty(test_input($_POST['client_surname'])) && !empty(test_input($_POST['room_id'])) && !empty(test_input($_POST['duration']))){
	$surname = test_input($_POST["client_surname"]);
    $lastname = test_input($_POST["client_lastname"]);
    $address= test_input($_POST["client_address"]);
    $email = test_input($_POST["client_email"]);
	$roomid = test_input($_POST["room_id"]);
	$duration = test_input($_POST["duration"]);
	$people = test_input($_POST["people"]);

	$sql = "INSERT INTO `reservations`(`id`, `client_surname`, `client_lastname`, `client_address`, `client_email`, `room_id`, `duration`, `people`) VALUES 
    ('','$surname','$lastname','$address','$email','$roomid','$duration','$people')";
	$QUERY1 = mysqli_query($conn,$sql);   
    if($QUERY1==1){	
       header('Location:upload-item.php');
   }
   else{
       echo "shit its not working";
   }
}
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['delete'])){
		$adminid = $_GET["delete"];
		$query1 = "DELETE FROM `reservations` WHERE id =$adminid ";
		$QUERY1 = mysqli_query($conn,$query1);   
 
 		if($QUERY1==1){	
			header('Location:upload-item.php');
		}
		else{
			echo "shit its not working";
		}
	}
}
?>