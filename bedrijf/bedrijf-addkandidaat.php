<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Informatievoorziening</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<?php include "../connect.php"; ?>
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<?php
$warning = false;

if(!isset($_POST['submit'])) {
	$posting = false;

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

	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	$posting = true;
	//persoonlijke informatie
	$vn = $_POST['voornaam'];
	$an = $_POST['achternaam'];
	$straat = $_POST['straat'];
	$huisnr = $_POST['huisnr'];
	$toevoeging = $_POST['toevoeging'];
	$postcode = $_POST['postcode'];
	$plaats = $_POST['plaats'];
	$land = $_POST['iCountry'];
	$gebdatum = date('Y-m-d',strtotime($_POST['gebdatum']));
	$gebplaats = $_POST['gebplaats'];
	$geslacht = $_POST['sex'];
	//contactinformatie
	$telnr = $_POST['telnr'];
	$email = $_POST['email'];
	//standaardvars
	$aanmaakdatum = date('Y-m-d');
	$vnuser = str_replace(' ', '', $vn);
	$anuser = str_replace(' ', '', $an);
	$username = $vnuser .".". $anuser;
	$temppassword = 1;
	$bedrijfid = $_SESSION['id'];
	$temp = randomPassword();
	$password = hash('sha1', randomPassword() ); // random wachtwoord vanuit function

	//SESSION VARS
	$_SESSION['password'] = $temp;
	$_SESSION['mail'] = $email;
	$_SESSION['sex'] = $geslacht;
	$_SESSION['achternaam'] = $an;
	$_SESSION['username'] = $username;

	if(!preg_match($regex, $email)) {
		$posting = false;
		$warning = true;
	}

	if($posting) {
		$sql = "INSERT INTO klant(voornaam, achternaam, geslacht, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, geboortedatum, geboorteplaats, telnr, email, gebruikersnaam, wachtwoord, temppassword, bedrijfid)
				VALUES('$vn', '$an', '$geslacht', '$straat', '$huisnr', '$toevoeging', '$postcode', '$plaats', '$land', '$gebdatum', '$gebplaats', '$telnr', '$email', '$username', '$password', '$temppassword', '$bedrijfid')" or die(mysql_error());
		
		$result = mysql_query($sql);
		header("Location: bedrijf-controlepagina.php");
	}
}

if(!$posting) {
?>

<div id="container">

	<?php include "toolbar-bedrijf.php"; ?>


	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="#" class="activepage">Nieuwe kandidaat</a></p>
		<form id="settings-form" method="post" action="#">

			<div class="content-block">
				<p class="content-head">Persoonlijke informatie</p>
				<p class="comment cursive">Vul hieronder de persoonlijke informatie in van de kandidaat.</p>
				<table id="settings-table">
					<tr>
						<td><label for="voornaam">Voornaam</label></td>
						<td><label for="achternaam">Achternaam</label></td>
					</tr>
					<tr>
						<td><input type="text" id="voornaam" name="voornaam" required></td>
						<td><input type="text" id="achternaam" name="achternaam" required></td>
					</tr>
					<tr>
						<td>
							<label for="man"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="man" value="m" required> Man</label>
							<label for="vrouw"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="vrouw" value="v"> Vrouw</label>
						</td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Huisnummer</label><label for="toevoeging" style="margin-left: 60px;">Toevoeging</label></td>
					</tr>
					<tr>
						<td><input type="text" id="straat" name="straat" required></td>
						<td><input type="text" id="huisnr" name="huisnr" required style="width:110px;"><input type="text" id="toevoeging" name="toevoeging" style="width:110px; margin-left: 10px;">
					</tr>
					<tr>
						<td><label for="postcode">Postcode</label></td>
						<td><label for="plaats">Woonplaats</label></td>
					</tr>
					<tr>
						<td><input type="text" id="postcode" name="postcode" placeholder="0000AA" maxlength="6" required></td>
						<td><input type="text" id="plaats" name="plaats" required></td>
					</tr>
					<tr>
						<td><label for="land">Land</label></td>
					</tr>
					<tr>
						<td colspan="2"><?php include "../select-landen.php"; ?></td>
					</tr>
					<tr>
						<td><label for="gebdatum">Geboortedatum</label></td>
						<td><label for="gebplaats">Geboorteplaats</label></td>
					</tr>
					<tr>
						<td><input type="text"  id="gebdatum" name="gebdatum" required></td>
						<td><input type="text" id="gebplaats" name="gebplaats" required></td>
					</tr>
				</table>
			</div>

			<div class="content-block">
				<p class="content-head">Extra informatie</p>
				<table id="settings-table">
					<tr>
						<td><label for="telnr">Telefoonnummer</label></td>
						<td><label for="email">E-mailadres</label></td>
					</tr>
					<?php if($warning==true){ echo "<tr><td class='errormessage'>Voer een kloppend e-mailadres in</td></tr>"; } ?>
					<tr>
						<td><input type="text" id="telnr" name="telnr" required></td>
						<td><input <?php if($warning){ echo "class='errorinput'"; } ?> type="text" id="email" name="email" required></td>
					</tr>
				</table>
			</div>

			<div id="settings-form-buttonblock">
				<input type="submit" id="next" name="submit" value="Opslaan">
			</div>
		</form>

		<?php include "../footer.php"; ?>
		<?php } //close if ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>