<?php
	session_start();
	include "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Controle pagina</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<?php
$posting = false;

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$posting = true;
	$password = $_SESSION['password'];
	$to = $_SESSION['email'];

	//mail header
	$header = "MIME-version: 1.0\n"; 
    $header .= "content-type: text/html;charset=utf-8\n";
    $header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

    //mail message
    if($_SESSION['sex'] == 'm') {
    	$aanhef = "heer";
    } else {
    	$aanhef = "mevrouw";
    }

    $message = 
    "
    Geachte ".$aanhef." ".$_SESSION['an'].",<br><br>
    Welkom bij Certus-Employment, Dit is een automatisch gegenereerd bericht, 
    Hieronder vind u uw tijdelijke inlog gegevens.<br><br>
    Gebruikersnaam: ".$_SESSION['username']."<br>
    Wachtwoord: ".$_SESSION['password']."<br><br>
    <a href='http://www.cairansteverink.com/certusemployment'>Klik hier om in te loggen</a>
    ";

    if($posting) {
		$sql = "INSERT INTO klant(voornaam, achternaam, geslacht, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, geboortedatum, geboorteplaats, telnr, email, gebruikersnaam, wachtwoord, temppassword, opleverdatum, bedrijfid)
				VALUES(
					'".$_SESSION['vn']."',
					'".$_SESSION['an']."', 
					'".$_SESSION['sex']."', 
					'".$_SESSION['straat']."', 
					".$_SESSION['huisnr'].", 
					'".$_SESSION['toevoeging']."', 
					'".$_SESSION['postcode']."', 
					'".$_SESSION['plaats']."', 
					'".$_SESSION['land']."', 
					'".$_SESSION['gebdatum']."', 
					'".$_SESSION['gebplaats']."', 
					".$_SESSION['telnr'].", 
					'".$_SESSION['email']."', 
					'".$_SESSION['username']."', 
					'".$_SESSION['password']."', 
					".$_SESSION['temppassword'].",
					'".$_SESSION['opleverdatum']."',
			 		".$_SESSION['id'].")";
		
		$result = mysql_query($sql);
		if(mail($to, $subject, $message, $header)) {
					unset($_SESSION['vn']);
					unset($_SESSION['an']); 
					unset($_SESSION['sex']); 
					unset($_SESSION['straat']); 
					unset($_SESSION['huisnr']); 
					unset($_SESSION['toevoeging']); 
					unset($_SESSION['postcode']); 
					unset($_SESSION['plaats']); 
					unset($_SESSION['land']); 
					unset($_SESSION['gebdatum']); 
					unset($_SESSION['gebplaats']); 
					unset($_SESSION['telnr']);
					unset($_SESSION['email']); 
					unset($_SESSION['username']); 
					unset($_SESSION['password']); 
					unset($_SESSION['temppassword']);
					unset($_SESSION['opleverdatum']);
    		header("Location: bedrijf-panel.php");
    	} else {
    		$posting = false;
    		die(mysql_error());
    	}
    	
	} else {
		!$posting;
	}

}

if(!$posting) {

?>

<div id="container">

	<?php include "toolbar-bedrijf.php"; ?>
	<form id="settings-form" method="post" action="#">
	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="#">Kandidaat informatie</a> > <a href="#">Pakket keuze</a> > <a href="#" class="activepage">Controlepagina</a></p>
		<div class="content-block">
			<table class="double-table">
				<tr><th collspan="2">Controlepagina</th></tr>
				<tr>
					<td>Naam</td>
					<td><?php echo $_SESSION['vn']." ".$_SESSION['an']; ?></td>
					<td>Telefoon nummer</td>
					<td><?php echo $_SESSION['telnr']; ?></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo $_SESSION['straat']; ?></td>
					<td>E-mail adres</td>
					<td><?php echo $_SESSION['email']; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo chunk_split(strtoupper($_SESSION['postcode']), 4, " "); ?></td>
					<td>Gebruikersnaam</td>
					<td><?php echo $_SESSION['username']; ?></td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td><?php echo $_SESSION['plaats']; ?></td>
				</tr>
				<tr>
					<td>Geboortedatum</td>
					<td><?php echo date('d-m-Y', strtotime($_SESSION['gebdatum'])); ?></td>
				</tr>
				<tr>
					<td>Geboorteplaats</td>
					<td><?php echo $_SESSION['gebplaats']; ?></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td class="bold"><i class="fa fa-download"></i><a class="color-reset download-link" href="#">CV.docx</a></td>
				</tr>
				<tr><td><small><a href="bedrijf-addkandidaat.php">Gegevens wijzigen</a></small></td></tr>
			</table>
		</div>

		<div class="content-block">
			<table class="double-table">
				<tr>
					<th>Screening informatie</th>
				</tr>
				<tr>
					<td>Opleverdatum</td>
					<td><?php echo date('d-m-Y', strtotime($_SESSION['opleverdatum'])); ?></td>
				</tr>
				<tr>
					<td>Pakketkeuze</td>
				</tr>
				<tr>
					<td><small><a href="bedrijf-pakketselectie.php">Gegevens wijzigen</a></small></td>
				</tr>
			</table>
		</div>

		<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>

		<?php include "../footer.php"; ?>

	</div>
</div>
<?php
}
?>
</body>
</html>