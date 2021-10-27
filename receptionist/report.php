<?php
require('fpdf.php');
require 'init.php';

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}
$GLOBALS['invoice'] = getName(8);

class PDF extends FPDF
{
	
}
if (isset($_POST['printforcustomer'])) {

$pdf = new PDF('p','mm',[189,130]);
$pdf->AddPage();
//my font
$pdf->SetFont('Times','B',20);
$pdf->Ln(30);
$pdf->Image('hotellogo.png',45,8,30,30,'PNG');
$pdf->Cell(105,5,'CHOSEN HOTEL ANNEX',0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(5);
$pdf->Cell(105,5,'No 11b Ihumudumu Road,Ekpoma,Edo State',0,1,'C');
$pdf->Ln(1);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(60,5,'Mail: chosenhotelannax@gmail.com ',0,0,'R');
$pdf->Cell(20,5,'Phone No:+234 805 631',0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('HELVETICA','b',8);
$pdf->Cell(50,5,'Receipt No: '.$invoice,0,0,'R');
$pdf->Cell(10,5,'Staff Name: James Bond',0,0,'L');
//table color...
$pdf->Ln(5);
$pdf->SetFillColor(224,235,255);
$pdf->Cell(10,5,'S/N',1,0,'C',1);
$pdf->Cell(40,5,'Description of Items',1,0,'C',1);
$pdf->Cell(15,5,'Quantity',1,0,'C',1);
$pdf->Cell(20,5,'Price',1,0,'C',1);
$pdf->Cell(25,5,'Total',1,0,'C',1);

$sN = 1;
$pdf->SetFillColor(255,255,255);
$sql = "SELECT * FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id;";
$query = mysqli_query($conn,$sql);
$TOTAL = 0;
if ($query) {
	while ($row = mysqli_fetch_assoc($query)) {
		$pdf->Ln(5);
		$pdf->Cell(10,5,$sN,1,0,'C',1);
		$pdf->Cell(40,5,$row['room_name'],1,0,'C',1);
		$pdf->Cell(15,5,$row['duration'].' Nights',1,0,'C',1);
		$pdf->Cell(20,5,$row['price'],1,0,'C',1);
		$pdf->Cell(25,5,$row['duration'] * $row['price'],1,0,'C',1);
		$sN+= 1;
		$TOTAL += $row['duration'] * $row['price'];
	}
};
$pdf->Ln(5);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(95,5,'Grand Total:',0,0,'R');
$pdf->Cell(20,5,$TOTAL,0,0,'L');
$pdf->Ln(5);
$appreciation = 'Thanks for your patronage come again next time.';
$pdf->Cell(20,5,$appreciation,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(20,5,'Signature: ______________ ',0,0,'L');

//OKEKE,YOU CAN CHANGE THE NAME OF THE PDF DYNAMICALLY
$pdf->Output('customername.pdf','I');


}

if (isset($_POST['printforcustomer'])) {
    $sql = "SELECT *
        FROM reservations
        INNER JOIN rooms
        ON reservations.room_id = rooms.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $surname = $row['client_surname'];
                $lastname = $row['client_lastname'];
                $email = $row['client_email'];
                $roomid = $row['room_id'];
                $description = $row['room_name'];
                $sql = "INSERT INTO `sales` (`id`, `category`, `item_description`, `invoice_id`, `customer_surname`, `customer_lastname`, `user_id`, `customer-email`, `room_id`, `price`) 
                VALUES ('', 'Receptionist', '$description','$invoice','$surname','$lastname','1','$email','$roomid','$TOTAL')";
                $QUERY1 = mysqli_query($conn,$sql); 
                $sql2 = "UPDATE `rooms` SET `status`='Booked' WHERE id=$roomid ";
                $QUERY1 = mysqli_query($conn,$sql2);
            }
        } 
        else {
            echo "";
        }
        $conn->close();
    
}

if (isset($_POST['printforaccountant'])) {
	$pdf = new PDF('p','mm',[190,130]);
	$pdf->AddPage();
	$pdf->Image('hotellogo.png',45,5,30,25,'PNG');
	$pdf->SetFont('Times','B',20);
$pdf->Ln(20);
$pdf->Cell(105,5,'CHOSEN HOTEL ANNEX',0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(5);
$pdf->Cell(105,5,'No 11b Ihumudumu Road,Ekpoma,Edo State',0,1,'C');
$pdf->Ln(1);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(60,5,'Mail: chosenhotelannax@gmail.com ',0,0,'R');
$pdf->Cell(20,5,'Phone No:+234 805 631',0,0,'L');
$pdf->Ln(8);
$pdf->Cell(10,5,'Invoice No:   '.$invoice,0,0);
$pdf->Ln(1);
$pdf->Cell(10,5,'______________________________________________________________________',0,0);
$pdf->Ln(3);
$pdf->Cell(110,5,'Invoice',0,0,'C');
$pdf->Ln(3);
$pdf->Cell(10,5,'______________________________________________________________________',0,0);
$pdf->Ln(3);
$pdf->Cell(55,5,'Date(system Date)',0,0,'L');
$pdf->Cell(55,5,'Time: (System time)',0,0,'R');
$pdf->Ln(3);
$pdf->Cell(10,5,'______________________________________________________________________',0,0);
$sql = "SELECT *
FROM reservations
INNER JOIN rooms
ON reservations.room_id = rooms.id;";
$query = mysqli_query($conn,$sql);
$TOTAL = 0;
if ($query) {
	while ($row = mysqli_fetch_assoc($query)) {
        $GLOBALS['firstname'] = $row['client_surname'];
        $GLOBALS['lastname'] = $row['client_lastname'];
        $GLOBALS['email'] = $row['client_email'];
        $GLOBALS['address'] = $row['client_address'];
    }
}
$pdf->Ln(5);
$pdf->Cell(55,5,'Surname:  '.$firstname,0,0,'L');
$pdf->Cell(55,5,'Other Names:  '.$lastname,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(55,5,'Address:  '.$address,0,0,'L');
$pdf->Cell(55,5,'Phone Number:  ',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(55,5,'Email (optional):  '.$email,0,0,'L');
//MINI TABLE

$pdf->Ln(5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(30,5,'Surname',1,0,'L',1);
$pdf->Cell(50,5,'Other Names:',1,0,'L',1);
$pdf->Cell(30,5,'Phone No:',1,0,'L',1);
$pdf->Ln(5);
$pdf->Cell(30,5,'Address:',1,0,'L',1);
$pdf->Cell(50,5,'Email (optional):',1,0,'L',1);
$pdf->Cell(30,5,'Email (optional):',1,0,'L',1);
$pdf->Ln(10);
//MAIN TABLE
$pdf->Ln(5);
$pdf->SetFillColor(224,235,255);
$pdf->Cell(10,5,'S/N',1,0,'C',1);
$pdf->Cell(40,5,'Description of Items',1,0,'C',1);
$pdf->Cell(15,5,'Quantity',1,0,'C',1);
$pdf->Cell(20,5,'Price',1,0,'C',1);
$pdf->Cell(25,5,'Total',1,0,'C',1);
$sN = 1;
$pdf->SetFillColor(255,255,255);
$sql = "SELECT *
FROM reservations
INNER JOIN rooms
ON reservations.room_id = rooms.id;";
$query = mysqli_query($conn,$sql);
$TOTAL = 0;
if ($query) {
	while ($row = mysqli_fetch_assoc($query)) {
		$pdf->Ln(5);
		$pdf->Cell(10,5,$sN,1,0,'C',1);
		$pdf->Cell(40,5,$row['room_name'],1,0,'C',1);
		$pdf->Cell(15,5,$row['duration'],1,0,'C',1);
		$pdf->Cell(20,5,$row['price'],1,0,'C',1);
		$pdf->Cell(25,5,$row['duration'] * $row['price'],1,0,'C',1);
		$sN+= 1;
		$TOTAL += $row['duration'] * $row['price'];
	}
};
$pdf->Ln(5);
$pdf->SetFont('HELVETICA','B',8);
$pdf->Cell(55,5,'Grand Total:',0,0,'L');
$pdf->Cell(55,5,$TOTAL,0,0,'R');
$pdf->Ln(15);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(20,5,'Staff Name (System):',0,0,'L');
$pdf->Ln(8);
$pdf->Cell(20,5,'Staff Signature:',0,0,'L');
$pdf->Ln(15);
$appreciation = 'Thanks for your patronage come again next time.';
$pdf->Cell(110,5,$appreciation,0,0,'C');



	$pdf->Output('accountant.pdf','I');

}
