<?php
include '../init.php';

function fetchbaritems($conn,$section,$category){
	$result= "
	<table class='table table-bordered bg-white'>    
    <thead>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
	";
	switch ($section) {
		case 'bars':
			$sql = "SELECT * FROM bars where Category = '$category' ";
			break;
		case 'restaurant':
			$sql = "SELECT * FROM restaurant where Category = '$category' ";
			break;
		default:
			$sql = '';
			break;
	}
	
	$query = mysqli_query($conn,$sql);
	if ($query) {
		while ($row  = mysqli_fetch_assoc($query)) {
			$result .= "<tr>
                    <td>". $row['itemName'] ."</td>
                    <td>". $row['Category'] ."</td>
                    
                    <td>". $row['Quantity'] ."</td>

                    <td>". $row['Price'] ."</td>
                    <th><span class='label-success label'> ". $row['status'] ." </span></th>
                    <th><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                    action
                 </button>
                 <div class='dropdown-menu'>
                   <a class='dropdown-item' href='#' onclick=edit(".$row['id'] .")>Edit</a>
                   <a class='dropdown-item' href='delete-admin.php?delete=".$row['id']."'>Delete</a>
                 </div>
                    </th>
                </tr>";
			;
		};
		$result .="</table>";
	};
    
	echo $result;
};
