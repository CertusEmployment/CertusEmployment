<?php
include "../connect.php"; 
session_start();

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql);

require_once('../pdf/fpdf.php');
require_once('../pdf/fpdi.php');

class PDF extends FPDF
{	
	// Page header
	function Header()
	{
	    $this->Image('../images/certus_logo.png',10,11,40);
    	$this->SetFont('Arial','B',15);
    	$this->Cell(80);
    	$this->Cell(30,10,'Integriteit verklaring',0,0,'C');
    	$this->Ln(20);
	}

	// Page footer
	function Footer()
	{
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//for($i=1;$i<=40;$i++)
  //$pdf->Cell(0,10,'Printing line number '.$i,0,1);

$pdf->SetFont('Arial', 'B', 11);
$pdf->setXY(10, 30);
$pdf->Cell(0,1, '1.',0,1);
$pdf->SetFont('Times','',12);
$pdf->setXY(15, 28);
$pdf->Multicell(0, 5, wordwrap('Vestibulum id ligula porta felis euismod semper. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor.', 90));

$pdf->SetFont('Times','B',12);
$pdf->SetXY(30, 44);
$pdf->Cell(0,1, 'Ja',0,1);

$pdf->SetFont('Times','',12);
$pdf->SetTextColor(243,146,11);
$pdf->SetXY(15, 52);
$pdf->Cell(0,1, 'Toelichting:',0,1);

$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(15, 56);
$pdf->Multicell(0, 5, wordwrap('Vestibulum id ligula porta felis euismod semper. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor.', 90));









$pdf->SetFont('Arial', 'B', 11);
$pdf->setXY(10, 94);
$pdf->Cell(0,1, '2.',0,1);
$pdf->SetFont('Times','',12);
$pdf->setXY(15, 92);
$pdf->Multicell(0, 5, wordwrap('Vestibulum id ligula porta felis euismod semper. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor.', 90));

$pdf->SetFont('Times','B',12);
$pdf->SetXY(30, 108);
$pdf->Cell(0,1, 'Ja',0,1);

$pdf->SetFont('Times','',12);
$pdf->SetTextColor(243,146,11);
$pdf->SetXY(15, 116);
$pdf->Cell(0,1, 'Toelichting:',0,1);

$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(15, 120);
$pdf->Multicell(0, 5, wordwrap('Vestibulum id ligula porta felis euismod semper. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor.', 90));


$pdf->Output();

?>