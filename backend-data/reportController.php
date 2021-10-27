<?php
require 'fpdf.php';
class PDF extends FPDF
{
	//could have set the header but no need..
};
if (isset($_POST['printreport'])) {
	$category =  $_POST['category'];
	$searchExp = $_POST['searchExp'];

$pdf = new PDF('p','mm',[189,150]);
$pdf->AddPage();
$pdf->Image('../backend-data/hotellogo.png',45,5,30,25,'PNG');
//my font
$pdf->Ln(20);
$pdf->SetFont('Times','B',20);

$pdf->Cell(130,5,'CHOSEN HOTEL ANNEX REPORTS',0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(5);
$pdf->Cell(105,5,'No 11b Ihumudumu Road,Ekpoma,Edo State',0,1,'C');
$pdf->Ln(1);
$pdf->SetFont('HELVETICA','',8);
$pdf->Cell(60,5,'Mail: chosenhotelannax@gmail.com ',0,0,'R');
$pdf->Cell(20,5,'Phone No:+234 805 631',0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('HELVETICA','b',10);
$pdf->Cell(130,5,'Report as at '.$searchExp,0,0,'C');
//table color...
$pdf->Ln(5);
$pdf->SetFillColor(224,235,255);
$pdf->Cell(6,5,'S/N',1,0,'L',1);
$pdf->Cell(25,5,'Category',1,0,'L',1);
$pdf->Cell(25,5,'Invoice Id',1,0,'L',1);
$pdf->Cell(37,5,'Customer Name',1,0,'L',1);
$pdf->Cell(15,5,'Price',1,0,'L',1);
$pdf->Cell(22,5,'Expenditure',1,0,'L',1);
$pdf->SetFillColor(255,255,255);
$TOTAL = 0;
$sql = '';
$totalExp = 0;

if ($category == 'All' ) {
	$sql = "SELECT * FROM `sales` ";
}else{
	$sql = "SELECT * FROM `sales` WHERE category = '$category'";
}

	$query = mysqli_query($conn,$sql);
	if ($query) {
		while ($row = mysqli_fetch_assoc($query)) {
		if (substr_count($row['date_posted'],$searchExp) > 0) {
		$pdf->Ln(5);
		$pdf->Cell(6,5,$row['id'],1,0,'L',1);
		$pdf->Cell(25,5, $row['category'] ,1,0,'L',1);
		$pdf->Cell(25,5,$row['invoice_id'],1,0,'L',1);
		$pdf->Cell(37,5,$row['customer_surname']." ".$row['customer_lastname'] ,1,0,'L',1);
		$pdf->Cell(15,5,$row['price'],1,0,'L',1);
		$pdf->Cell(22,5,$row['expenditure'],1,0,'C',1);
		$TOTAL += $row['price'] ;
		$totalExp += $row['expenditure'];
     }
	}
}
$pdf->Ln(10);
$pdf->SetFont('HELVETICA','b',12);
$pdf->Cell(55,5,'Total: '.$TOTAL,0,0,'L');
$pdf->Cell(55,5,'Expenditure: '.$totalExp,0,0,'L');
$pdf->Ln(10);
$pdf->SetFont('HELVETICA','b',12);
$pdf->Cell(55,5,'Net Amount: '.($TOTAL - $totalExp),0,0,'L');

$pdf->Output('report.pdf','I');
};