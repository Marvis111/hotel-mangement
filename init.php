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



function fetchreport($conn,$office,$category){
	$TotalAmount = 0;
	$result= "
  <table class='table table-bordered bg-white'
  >    
    <thead>
      <tr>
        <th data-field='state' data-checkbox='true' >S/N</th>
        <th data-field='prenom' data-filter-control='input' data-sortable='true'>Category</th>
        <th>Invoice Id</th>
        <th>Customer Name</th>
        <th>Dated Posted</th>
        <th>Price</th>
      </tr>
    </thead>
  ";
  $reportType = '';$sql='';
	switch ($category) {
		case 'Daily':
			$reportType = date('Y-m-d');
			break;
		case 'Monthly':
			$reportType = date('Y-m');
			break;
		case 'Yearly':
			$reportType = date('Y');
			break;
		default:
			$reportType = date('Y-m-d');
			break;
	}
	if ($office == "all") {
		$sql = "SELECT * FROM sales";
	}else{
		$sql = "SELECT * FROM sales WHERE category = '$office' ";
	}
	$query = mysqli_query($conn,$sql);
	if ($query) {
		while ($row = mysqli_fetch_assoc($query)) {
			if (substr_count($row['date_posted'], $reportType) > 0) {
				//echo $row['date_posted'].'<br>';
				$result .= "<tr>
                    <td>". $row['id'] ."</td>
                    <td>". $row['category'] ."</td>
                    
                    <td>". $row['invoice_id'] ."</td>

                    <td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
                    <td>". $row['date_posted'] ." </td>
                    <td>". $row['price'] ." </td>
                </tr>";
                $TotalAmount += $row['price'];
			}
		}
	}
	$result .= "
				<tr>
					<td>Total Amount</td>
					<td>".$TotalAmount."</td>
                </tr>
			</table>";
	echo $result;
}

function dispatchReportCategory($conn,$category,$row){
	$bars = $all = $def = "";
	switch ($cateory) {
		case '':
			$all .="
			<div class='tab-pane container active' id='Yall'>
			<tr>
			<td>". $row['id'] ."</td>
			<td>". $row['category'] ."</td>
			
			<td>". $row['invoice_id'] ."</td>

			<td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
			<td>". $row['customer_email'] ." </td>
			<td>". $row['customer_surname'] ." ". $row['price'] ." </td>
		</tr>;
		  	</div>	
			";
			break;
		case "Bars":
			$bars .="
			<div class='tab-pane container active' id='Ybarsales'>
			<tr>
			<td>". $row['id'] ."</td>
			<td>". $row['category'] ."</td>
			
			<td>". $row['invoice_id'] ."</td>

			<td>". $row['customer_surname'] ." ". $row['customer_lastname'] ." </td>
			<td>". $row['customer_email'] ." </td>
			<td>". $row['customer_surname'] ." ". $row['price'] ." </td>
		</tr>;
		  	</div>	s
			";
			break;
		default:
			$def .="";
			break;
	}
	return array(
		"all"=>$all,
		"bars" => $bars,
		"def" => $def
	);
};