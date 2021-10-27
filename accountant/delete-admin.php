<?php
include '../init.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['delete'])){
		$adminid = $_GET["delete"];
		$query1 = "DELETE FROM `rooms` WHERE id =$adminid ";
		$QUERY1 = mysqli_query($conn,$query1);   
 
 		if($QUERY1==1){	
			header('Location:upload-item.php');
		}
		else{
			echo "shit its not working";
		}
	}
	elseif(isset($_GET['deleter'])){
		$adminid = $_GET["deleter"];
		$query1 = "DELETE FROM `expenditure` WHERE id =$adminid ";
		$QUERY1 = mysqli_query($conn,$query1);   
 
 		if($QUERY1==1){	
			header('Location:expenses.php');
		}
		else{
			echo "shit its not working";
		}
	}
}
elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['room_name'])){
        $name = $_POST['room_name']; 
		$image = $_POST['room_image'];
		$room_floor = $_POST['room_floor']; 
		$room_type = $_POST['room_type'];
		$bed_type = $_POST['bed_type'];
		$room_capacity = $_POST['room_capacity'];
		$room_facility = $_POST['room_facility'];
		$status = $_POST['status'];
		$price = $_POST['price'];
		$booking_date = $_POST['booking_date'];
        $sql = "INSERT INTO `rooms`(`id`, `room_name`, `room_image`, `room_floor`, `room_type`, `bed_type`, `room_facility`, `status`,
		 `price`, `room_capacity`,`booking_date`) VALUES 
        ('','$name','$image','$room_floor','$room_type','$bed_type','$room_facility','$status','$price','$room_capacity','$booking_date')";
		$QUERY1 = mysqli_query($conn,$sql);   
 
 		if($QUERY1==1){	
			header('Location:upload-item.php');
		}
		else{
			echo "shit its not working";
		}
    }
	elseif(isset($_POST['expense_name'])){
		$price = $_POST['price'];
		$expense = $_POST['expense_name']; 
		$department = $_POST['department'];
        $sql = "INSERT INTO `expenditure`(`id`, `price`, `expense_name`, `department`) VALUES 
		('','$price','$expense','$department')";
		$QUERY1 = mysqli_query($conn,$sql);   
 
 		if($QUERY1==1){	
			header('Location:expenses.php');
		}
		else{
			echo "shit its not working";
		}
	}
}
?>