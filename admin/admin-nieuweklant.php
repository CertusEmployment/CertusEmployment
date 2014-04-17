<!DOCTYPE html>
<html>
<head>
	<title>Nieuwe klant</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<?php include "../connect.php"; ?>
</head>
<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;

} else {

	$posting = true;
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	//Bedrijfsgegevens
	$bedrijfsnaam = htmlentities(strip_tags(trim($_POST['bedrijfsnaam'])));
	$straat = htmlentities(strip_tags(trim($_POST['straat'])));
	$huisnr = htmlentities(strip_tags(trim($_POST['huisnr'])));
	$toevoeging = htmlentities(strip_tags(trim($_POST['toevoeging'])));
	$postcode = htmlentities(strip_tags(trim($_POST['postcode'])));
	$plaats = htmlentities(strip_tags(trim($_POST['plaats'])));
	$land = htmlentities(strip_tags(trim($_POST['land'])));
	//contactgegevens
	$contact_vn = htmlentities(strip_tags(trim($_POST['voornaam'])));
	$contact_an = htmlentities(strip_tags(trim($_POST['achternaam'])));
	$contact_tel = htmlentities(strip_tags(trim($_POST['telnr'])));
	$contact_email = htmlentities(strip_tags(trim($_POST['email'])));
	//login gegevens
	$username = htmlentities(strip_tags(trim($_POST['username'])));
	$password = htmlentities(strip_tags(trim($_POST['password'])));
	$repeat = htmlentities(strip_tags(trim($_POST['repeat'])));
	//maatwerkpakket

	if(!preg_match($regex, $contact_email)){ 
		$posting = false;
	}

	if($password == $repeat) {
		$posting = false;
	}

	$sql = "INSERT INTO bedrijf(bedrijfnaam, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, vn_contact, an_contact, telnr_contact, email_contact, gebruikersnaam, wachtwoord) 
			VALUES ('$bedrijfsnaam', '$straat', '$huisnr', '$toevoeging', '$postcode', '$plaats', '$land', '$contact_vn', '$contact_an', '$contact_tel', '$contact_email', '$username', '$password')";
	$result = mysql_query($sql);

	if($posting == true) {
		header("Location: admin-panel.php");
	}
}

if(!$posting) {

?>

<div id="container">

	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="#" class="activepage">Nieuw bedrijf</a></p>

		<form id="settings-form" method="post">
			<div class="content-block">
				<p class="content-head">Bedrijfsinformatie</p>
				<p class="comment cursive">Vul hieronder de bedrijfsgegevens in.</p>
				<table id="settings-table">
					<tr>
						<td><label for="bedrijfsnaam">Bedrijfsnaam</label></td>
					</tr>
					<tr>
						<td colspan="2"><input type="text" name="bedrijfsnaam" id="bedrijfsnaam" style="width:505px;" required></td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Nummer</label></td>
					</tr>
					<tr>
						<td><input type="text" id="straat" name="straat" required></td>
						<td><input type="text" id="huisnr" name="huisnr" required></td>
					</tr>
					<tr>
						<td><label for="toevoeging">Huis toevoeging</label></td>
						<td><label for="postcode">Postcode</label></td>
					</tr>
					<tr>
						<td><input type="text" id="toevoeging" name="toevoeging"></td>
						<td><input type="text" id="postcode" name="postcode" required></td>
					<tr>
						<td><label for="plaats">Plaats</label></td>
						<td><label for="land">Land</label></td>
					</tr>
					<tr>
						<td><input type="text" id="plaats" name="plaats" required></td>
						<td><input type="text" id="land" name="land" required></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Contantgegevens</p>
				<table id="settings-table">
					<tr>
						<td><label for="voornaam">Voornaam</label></td>
						<td><label for="achternaam">Achternaam</label></td>
					</tr>
					<tr>
						<td><input type="text" name="voornaam" id="voornaam" required></td>
						<td><input type="text" name="achternaam" id="achternaam" required></td>
					</tr>
					<tr>
						<td><label for="telnr">Telefoonnummer</label></td>
						<td><label for="email">E-mail adres</label></td>
					</tr>
					<tr>
						<td><input type="text" name="telnr" id="telnr" required></td>
						<td><input type="text" name="email" id-"email" required></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Login gegevens</p>
				<table id="settings-table">
					<tr>
						<td colspan="2"><label for="username">Gebruikersnaam</label></td>
					</tr>
					<tr>
						<td colspan="2"><input type="text" name="username" id="username"></td>
					</tr>
					<tr>
						<td><label for="password">Wachtwoord</label></td>
						<td><label for="repeat">Herhaal wachtwoord</label></td>
					</tr>
					<tr>
						<td><input type="password" name="password" id="password"></td>
						<td><input type="password" name="repeat" id="repeat"></td>
					</tr>
					<tr>
						<td colspan="2"><p class="comment">Gebruik minimaal 6 karakters, waarvaan een cijfer en een hoofdletter.</p></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Maatwerkpakket</p>
				<p class="comment">Selecteer hieronder de opties die van toepassing zijn op deze klant. <br>Dit kan later altijd nog gewijzigd worden.</p>
				<ul>
					<li><label for="idcheck"><input type="checkbox" name="idcheck" id="idcheck"> ID check</label></li>
					<li><label for="werkervaring"><input type="checkbox" name="werkervaring" id="werkervaring"> Werkervaring</label></li>
					<li><label for="opleiding"><input type="checkbox" name="opleiding" id="opleiding"> Opleiding</label></li>
					<li><label for="financieel"><input type="checkbox" name="financieel" id="financieel"> Financiele situatie en gerechtelijke uitspraken</label></li>
					<li><label for="vog"><input type="checkbox" name="vog" id="vog"> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label></li>
				</ul>
			</div>
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"></div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			