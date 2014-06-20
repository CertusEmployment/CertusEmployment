<?php
	session_start();
	include "../connect.php";
	$datumArray = array('1' => 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );
?>
<!DOCTYPE html>
<html>
<head>
	<title>Controle pagina | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
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
	$subject = "Welkom bij Certus Employment";

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

    include "../email/klant-welkom.php";

    if($posting) {
		$sql = "INSERT INTO klant(voornaam, achternaam, geslacht, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, geboortedatum, geboorteplaats, telnr, email, gebruikersnaam, wachtwoord, temppassword, opleverdatum, bedrijfid, aanmaakdatum, pakket)
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
					'".$_SESSION['id']."',
			 		'".$_SESSION['aanmaakdatum']."',
			 		".$_SESSION['pakket'].")";
		$result = mysql_query($sql) or die(mysql_error());
		$klantid = mysql_insert_id();
		$_SESSION['klantid'] = mysql_insert_id();
		
		if($_SESSION['pakket'] == 3) {
			$maatwerksql = "INSERT INTO maatwerk(idcheck, werkervaring, opleiding, onderzoek, financieel, vog, klantid) VALUES(".$_SESSION['identiteit'].", ".$_SESSION['werkervaring'].", ".$_SESSION['opleiding'].", ".$_SESSION['onderzoek'].", ".$_SESSION['financieel'].", ".$_SESSION['vog'].", ".$klantid.") ";
			mysql_query($maatwerksql) or die(mysql_error());
		}
		if(mail($to, $subject, $messageklantwelkom, $header)) {
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
			unset($_SESSION['aanmaakdatum']);
			unset($_SESSION['pakket']);
			unset($_SESSION['identiteit']);
			unset($_SESSION['opleiding']);
			unset($_SESSION['werkervaring']);
			unset($_SESSION['financieel']);
			unset($_SESSION['vog']);
    		header("Location: bedrijf-upload-cv.php");
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
					<td><?php echo (strlen($_SESSION['postcode'])==6)? chunk_split(strtoupper($_SESSION['postcode']), 4, " ") : $_SESSION['postcode'] ; ?></td>
					<td>Gebruikersnaam</td>
					<td><?php echo $_SESSION['username']; ?></td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td><?php echo $_SESSION['plaats']; ?></td>
				</tr>
				<tr>
					<td>Geboortedatum</td>
					<td><?php echo date('d', strtotime($_SESSION['gebdatum'])).' '.$datumArray[date('n', strtotime($_SESSION['gebdatum']))].' '.date('Y', strtotime($_SESSION['gebdatum'])); ?></td>
				</tr>
				<tr>
					<td>Geboorteplaats</td>
					<td><?php echo $_SESSION['gebplaats']; ?></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<!-- <tr>
					<td class="bold"><i class="fa fa-download"></i><a class="color-reset download-link" href="#">CV.docx</a></td>
				</tr> -->
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
					<td><?php echo $_SESSION['pakket']; ?></td>
				</tr>
				<?php if($_SESSION['pakket'] ==3) { ?>
					<tr>
						<td>Pakketsamenstelling</td>
						<td><ul class="controleul"><?php if($_SESSION['pakketboolean'] == 1){ 
						echo ($_SESSION['identiteit']==1) ? "<li>ID Check</li>" : ""; 
						echo ($_SESSION['werkervaring']==1) ? "<li>Werkervaring</li>" : ""; 
						echo ($_SESSION['opleiding']==1) ? "<li>Opleiding</li>" : ""; 
						echo ($_SESSION['onderzoek']==1) ? "<li>Online onderzoek</li>" : ""; 
						echo ($_SESSION['financieel']==1) ? "<li>Financiele situatie en gerechtelijke uitspraken</li>" : ""; 
						echo ($_SESSION['vog']==1) ? "<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>" : ""; 
						} else { echo "Geen pakket samengesteld."; } ?>
						</ul></td>
					</tr>
				<?php } ?>
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