<?php 
include "../connect.php";
include "../landen-array.php";

session_start();

$errormessage = "";
$errorclass = "";

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<title>Nieuwe klant | Certus Employment</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>
</head>
<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;
	$_POST['bedrijfsnaam'] = "";
	$_POST['straat'] = "";
	$_POST['huisnr'] = "";
	$_POST['toevoeging'] = "";
	$_POST['postcode'] = "";
	$_POST['plaats'] = "";
	$_POST['voornaam'] = "";
	$_POST['achternaam'] = "";
	$_POST['telnr'] = "";
	$_POST['email'] = "";
	$_POST['username'] = "";
} else {

	function randomPassword() {
    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array();
    	$alphaLength = strlen($alphabet) - 1;
    	for ($i = 0; $i < 8; $i++) {
    	    $n = rand(0, $alphaLength);
    	    $pass[] = $alphabet[$n];
    	}
    	return implode($pass);
	}

	$posting = true;
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	//Bedrijfsgegevens
	$bedrijfsnaam = htmlentities(strip_tags(trim($_POST['bedrijfsnaam'])));
	$straat = htmlentities(strip_tags(trim($_POST['straat'])));
	$huisnr = htmlentities(strip_tags(trim($_POST['huisnr'])));
	$toevoeging = htmlentities(strip_tags(trim($_POST['toevoeging'])));
	$postcode = htmlentities(strip_tags(trim($_POST['postcode'])));
	$plaats = htmlentities(strip_tags(trim($_POST['plaats'])));
	$land = $_POST['iCountry'];
	//contactgegevens
	$contact_vn = htmlentities(strip_tags(trim($_POST['voornaam'])));
	$contact_an = htmlentities(strip_tags(trim($_POST['achternaam'])));
	$contact_tel = htmlentities(strip_tags(trim($_POST['telnr'])));
	$contact_email = htmlentities(strip_tags(trim($_POST['email'])));
	
	//login gegevens
	$username = htmlentities(strip_tags(trim($_POST['username'])));
	$password = randomPassword();
	$hashed = hash('sha1', $password);

	//maatwerkpakket
	$idcheck = 0;
	$opleiding = 0;
	$vog = 0;
	$werkervaring = 0;
	$financieel = 0;

	//Mail settings
	$header = "MIME-version: 1.0\n"; 
    $header .= "content-type: text/html;charset=utf-8\n";
    $header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    $to = $contact_email;
    $subject = "Welkom bij Certus Employment";
    $subject_tips = "Handige tips";
    include "../email/bedrijf-welkom.php";
  	include "../email/bedrijf-tips.php";

	if(isset($_POST['idcheck'])) { $idcheck = 1; }
	if(isset($_POST['werkervaring'])) { $werkervaring = 1; }
	if(isset($_POST['opleiding'])) { $opleiding = 1; }
	if(isset($_POST['financieel'])) { $financieel = 1; }
	if(isset($_POST['vog'])) { $vog = 1; }

	if(!preg_match($regex, $contact_email)){ 
		$posting = false;
	}

	if($posting == true) {
		//Send mail
		mail($to, $subject, $message, $header);
		mail($to, $subject_tips, $message_tips, $header);
		$temppassword = 1;

		// SQL
		$sql = "INSERT INTO bedrijf(bedrijfnaam, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, vn_contact, an_contact, telnr_contact, email_contact, gebruikersnaam, wachtwoord, temppassword) 
				VALUES ('$bedrijfsnaam', '$straat', '$huisnr', '$toevoeging', '$postcode', '$plaats', '$land', '$contact_vn', '$contact_an', '$contact_tel', '$contact_email', '$username', '$hashed', '$temppassword')";
		$result = mysql_query($sql);
		//INSERT maatwerkpakket
		$maatwerk = "INSERT INTO maatwerk(idcheck, werkervaring, opleiding, financieel, vog)
					 VALUES('$idcheck', '$werkervaring', '$opleiding', '$financieel', '$vog')";
		$pakket = mysql_query($maatwerk);
		unset($_SESSION['an']);
		header("Location: admin-panel.php");
	}
}

if(!$posting) {

?>

<div id="container">

	<?php include "toolbar-admin.php"; ?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="#" class="activepage">Nieuw bedrijf</a></p>

		<form id="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block">
				<p class="content-head">Bedrijfsinformatie</p>
				<p class="comment cursive">Vul hieronder de bedrijfsgegevens in.</p>
				<table id="settings-table">
					<tr>
						<td><label for="bedrijfsnaam">Bedrijfsnaam</label></td>
					</tr>
					<tr>
						<td colspan="2"><input type="text" value="<?php echo $_POST['bedrijfsnaam']; ?>" name="bedrijfsnaam" id="bedrijfsnaam" style="width:505px;" required></td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Nummer</label><label for="toevoeging" style="margin-left: 80px;">Toevoeging</label></td>
					</tr>
					<tr>
						<td><input type="text" value="<?php echo $_POST['straat']; ?>" id="straat" name="straat" required></td>
						<td><input type="text" value="<?php echo $_POST['huisnr']; ?>" id="huisnr" name="huisnr" required style="width:110px;"><input type="text" id="toevoeging" value="<?php echo $_POST['toevoeging']; ?>" name="toevoeging" style="width:110px; margin-left: 10px;">
					</tr>

					<tr>
						<td><label for="postcode">Postcode</label></td>
						<td><label for="plaats">Plaats</label></td>
					</tr>
					<tr>

						<td><input type="text" value="<?php echo $_POST['postcode']; ?>" id="postcode" name="postcode" required></td>

						<td><input type="text" value="<?php echo $_POST['plaats']; ?>" id="plaats" name="plaats" required></td>
					</tr>
					<tr>
						<td><label for="land">Land</label></td>
					</tr>
					<tr>
						<td colspan="2">
							<select id="iCountry" name="iCountry">
								<?php	
									foreach ($arrayLanden as $code => $landnaam) {
										if ($landnaam == $row['land'] OR $landnaam == $_SESSION['land']) {
											$isSelected = " selected='' "; 
										}
										elseif (!isset($row['land']) && $landnaam == 'Nederland') {
											$isSelected = " selected='' "; 
										}
										 else {
											$isSelected = "";
										}
										echo "<option value='".$landnaam."' ".$isSelected.">".$landnaam."</option>";
									}
								?>
							</select>
						</td>
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
						<td><input type="text" value="<?php echo $_POST['voornaam']; ?>" name="voornaam" id="voornaam" required></td>
						<td><input type="text" value="<?php echo $_POST['achternaam']; ?>" name="achternaam" id="achternaam" required></td>
					</tr>
					<tr>
						<td><label for="telnr">Telefoonnummer</label></td>
						<td><label for="email">E-mail adres</label></td>
					</tr>
					<tr>
						<td><input type="text" value="<?php echo $_POST['telnr']; ?>" name="telnr" id="telnr" onkeypress='return isNumberKey(event)' required></td>
						<td><input type="text" value="<?php echo $_POST['email']; ?>" name="email" id-"email" required></td>
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
						<td colspan="2"><input type="text" value="<?php echo $_POST['username']; ?>" name="username" id="username"></td>
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
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"><input type="submit" onclick="location.href='admin-panel.php'" id="cancel" name="submit" value="Annuleer"></div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			