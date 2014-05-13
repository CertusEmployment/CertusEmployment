<?php 
	session_start();
	include "../connect.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Controle pagina</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<?php

$sql = "SELECT * FROM klant WHERE id ='".$_SESSION['id']."'";
$result = mysql_query($sql);
$klantdata = mysql_fetch_assoc($result);

if(!isset($_POST['submit'])) {
	$posting = false;
} else {

	$password = $_SESSION['password'];
	$to = $_SESSION['mail'];

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
    Geachte ".$aanhef." ".$_SESSION['achternaam'].",<br><br>
    Welkom bij Certus-Employment, Dit is een automatisch gegenereerd bericht, 
    Hieronder vind u uw tijdelijke inlog gegevens.<br><br>
    Gebruikersnaam: ".$_SESSION['username']."<br>
    Wachtwoord: ".$_SESSION['password']."<br><br>
    <a href='http://www.cairansteverink.com/certusemployment'>Klik hier om in te loggen</a>
    ";	

    if(mail($to, $subject, $message, $header)) {
    	header("Location: bedrijf-panel.php");
    } else {
    	$posting = false;
    	die(mysql_error());
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

		<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="bedrijf-addkandidaat.php">Kandidaat informatie</a> > <a href="bedrijf-pakketselectie.php">Pakket keuze</a> > <a href="#" class="activepage">Controlepagina</a></p>
		<div class="content-block">
			<table class="double-table">
				<tr><th collspan="2">Controlepagina</th></tr>
				<tr>
					<td>Naam</td>
					<td><?php echo $klantdata['voornaam']." ".$klantdata['achternaam']; ?></td>
					<td>Telefoon nummer</td>
					<td><?php echo $klantdata['telnr']; ?></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo $klantdata['straatnaam']; ?></td>
					<td>E-mail adres</td>
					<td><?php echo $klantdata['email']; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo $klantdata['postcode']; ?></td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td><?php echo $klantdata['plaats']; ?></td>
				</tr>
				<tr>
					<td>Geboortedatum</td>
					<td><?php echo $klantdata['geboortedatum']; ?></td>
				</tr>
				<tr>
					<td>Geboorteplaats</td>
					<td><?php echo $klantdata['geboorteplaats']; ?></td>
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
			<table>
				<tr><th>Screening informatie</th></tr>
				<tr><td>Opleverdatum</td></tr>
				<tr><td>Pakketkeuze</td></tr>
				<tr><td><small><a href="#">Gegevens wijzigen</a></small></td></tr>
			</table>
		</div>

		<input type="submit" id="next" name="submit" value="Opslaan">
		</form>

		<?php include "../footer.php"; ?>

	</div>
</div>
<?php
}
?>
</body>
</html>