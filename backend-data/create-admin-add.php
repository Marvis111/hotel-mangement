<?php
require_once("../init.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  	return $data;
	}
	if(!empty(test_input($_POST['username'])) && !empty(test_input($_POST['password'])) && !empty(test_input($_POST['category'])) && !empty(test_input($_POST['fullname'])) && !empty(test_input($_POST['status']))){
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$fullname = test_input($_POST["fullname"]);
	$category = test_input($_POST["category"]);
	$status = $_POST["status"];
	$type = $_POST['type'];
	$query = "INSERT INTO `admin`(`username`,`password`,`fullname`,`category`,`status`) VALUES('$username','$password','$fullname','$category','$status')";
	$QUERY = mysqli_query($conn,$query);   
 
 	if($QUERY==1){	
		header('Location:../create-admin.php?type='.$category);
	}else{
		header('Location:../create-admin.php?error=1');
	}
	}
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['delete'])){
		$adminid = $_GET["delete"];
		$type = $_GET['type'];
		$query1 = "DELETE FROM `admin` WHERE id =$adminid ";
		$QUERY1 = mysqli_query($conn,$query1);   
 
 		if($QUERY1==1){	
			header('Location:../create-admin.php?type='.$type);
		}
		else{
			echo "shit its not working";
		}
	}
}


?>