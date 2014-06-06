i<?php
include "../connect.php"; 
session_start();

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql);
$tempid = $_SESSION['id'];

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
$pdf->SetFont('Times','',12);

$space = 0;

// echo de content van de intergriteitsverklaring
// in de PDF pagina. Posities worden gezet met SETXY
// $space is om de spatie tussen de verschillende lijnen te bepalen
// en worden dus ook alijd verdubbeld met hetzelfde getal (+84)

for($p = 1; $p<$_SESSION['i']; $p++) {

	$row=mysql_fetch_assoc($result);
	$pdf->AddPage();

	if(empty($_SESSION['toelichting'.$p.''])) {
		$toelichting = "-";
	} else {
		$toelichting = $_SESSION['toelichting'.$p.''];
	}

	$pdf->SetFont('Times', 'B', 11);
	$pdf->setXY(10, 30+$space);
	$pdf->Cell(0,1, "".$p.".",0,1);
	$pdf->SetFont('Times','',12);
	$pdf->setXY(15, 28+$space);
	$pdf->Multicell(0, 5, wordwrap("".$row['vraag']."", 90));

	$pdf->SetFont('Times','B',12);
	$pdf->SetXY(15, 54+$space);
	$pdf->Cell(0,1, "".$_SESSION['antwoord'.$p.'']."",0,1);

	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(243,146,11);
	$pdf->SetXY(15, 64+$space);
	$pdf->Cell(0,1, 'Toelichting:',0,1);

	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(15, 68+$space);
	$pdf->Multicell(0, 5, wordwrap("".$_SESSION['toelichting'.$p.'']."", 90));
	$space = $space+120;
	$p++;

	$pdf->SetFont('Times', 'B', 11);
	$pdf->setXY(10, 30+$space);
	$pdf->Cell(0,1, "".$p.". ",0,1);
	$pdf->SetFont('Times','',12);
	$pdf->setXY(15, 28+$space);
	$pdf->Multicell(0, 5, wordwrap("".$row['vraag']."", 90));

	$pdf->SetFont('Times','B',12);
	$pdf->SetXY(15, 54+$space);
	$pdf->Cell(0,1, "".$_SESSION['antwoord'.$p.'']."",0,1);

	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(243,146,11);
	$pdf->SetXY(15, 64+$space);
	$pdf->Cell(0,1, 'Toelichting:',0,1);

	$pdf->SetFont('Times','',12);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(15, 68+$space);
	$pdf->Multicell(0, 5, wordwrap("".$_SESSION['toelichting'.$p.'']."", 90));

	$space=0;

}

// Output PDF
mkdir("../file-upload/".$_SESSION['id']."/verklaring/", 0777);
$pdf->Output("../file-upload/".$_SESSION['id']."/verklaring/integriteit.pdf", "F");

// Insert PDF link
$sql = "UPDATE klant SET integriteit='../file-upload/".$tempid."/verklaring/integriteit.pdf', temppassword=0 WHERE id=".$_SESSION['id']." ";
mysql_query($sql);

header("Location: klant-panel.php");
?>