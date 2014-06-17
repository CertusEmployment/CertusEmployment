<?php

include "../connect.php";
include "../landen-array.php";

$gegevens_query = "SELECT * FROM bedrijf WHERE id = '".$_GET['id']."'";
$gegevens_result = mysql_query($gegevens_query);
$maatwerkquery = "SELECT * FROM maatwerk WHERE id=".$_GET['id']."";
$maatwerkresult = mysql_query($maatwerkquery);
$pakket = mysql_fetch_assoc($maatwerkresult);

$errormessage = "";
$errorclass = "";

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<title>Klant wijzigen | Certus Employment</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>
</head>
<body>

<?php

if(isset($_POST['cancel'])) {
	$pageid = $_GET['id'];
	header("Location: admin-bedrijfsprofiel.php?id=$pageid");
}
if(!isset($_POST['submit'])) {
	$posting = false;
	//unset($password);

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
	$land = htmlentities(strip_tags(trim($_POST['iCountry'])));
	//contactgegevens
	$contact_vn = htmlentities(strip_tags(trim($_POST['voornaam'])));
	$contact_an = htmlentities(strip_tags(trim($_POST['achternaam'])));
	$contact_tel = htmlentities(strip_tags(trim($_POST['telnr'])));
	$contact_email = htmlentities(strip_tags(trim($_POST['email'])));
	//login gegevens
	$username = htmlentities(strip_tags(trim($_POST['username'])));
	//$password = htmlentities(strip_tags(trim($_POST['password'])));
	//maatwerkpakket
	$idcheck = ($_POST['idcheck']==1) ? 1 : 0 ;
	$werkervaring = ($_POST['werkervaring']==1) ? 1 : 0 ;
	$opleiding = ($_POST['opleiding']==1) ? 1 : 0 ;
	$financieel = ($_POST['financieel']==1) ? 1 : 0 ;
	$vog = ($_POST['vog']==1) ? 1 : 0 ;
	
	// if(empty($password)) {
	// 		$posting = false;
	// 		$errormessage = "<tr><td class='errormessage'>Geen wachtwoord ingevuld.</td></tr>";
	// 		$errorclass = "class='errorinput'";
	// 	}else {
	// 	$hashed = hash('sha1', $password);
	// }
	
	if(!preg_match($regex, $contact_email)){ 
		$posting = false;
	}
	// if($password != $repeat) {
	// 	$posting = false;
	// 	$errormessage = "Herhaal de wachtwoorden op de juiste manier.";
	// 	$errorclass = "class='errorinput'";
	// }

	// if (preg_match($regexpass, $password)) {
	// 	$posting = false;
	// 	$errormessage = "Wachtwoord komt niet overeen met de eisen";
	// 	$errorclass = "class='errorinput'";
	// } 

	if ($posting) {
		$update_sql = "UPDATE bedrijf SET 
		bedrijfnaam='".$bedrijfsnaam."',
		straatnaam='".$straat."',
		huisnummer=".$huisnr.",
		huistoevoeging='".$toevoeging."',
		postcode='".$postcode."',
		plaats='".$plaats."',
		land='".$land."',
		vn_contact='".$contact_vn."',
		an_contact='".$contact_an."',
		telnr_contact='".$contact_tel."',
		email_contact='".$contact_email."',
		gebruikersnaam='".$username."'
		WHERE id=".$_GET['id']." ";
		mysql_query($update_sql) or die(mysql_error());

		$update_maatwerk = "UPDATE maatwerk SET
		idcheck = ".$idcheck.",
		werkervaring = ".$werkervaring.",
		opleiding = ".$opleiding.",
		financieel = ".$financieel.",
		vog = ".$vog."
		WHERE id = ".$_GET['id']." ";
		mysql_query($update_maatwerk) or die(mysql_error());
		$pageid = $_GET['id'];
		header("Location: admin-bedrijfsprofiel.php?id=$pageid");
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
		
		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="admin-bedrijfsprofiel.php?id=<?php echo $_GET['id']; ?>">Bedrijfsprofiel</a> > <a href="#" class="activepage">Wijzigen</a></p>
		<?php while ($row = mysql_fetch_array($gegevens_result)) {
		?>
			<form id="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="content-block">
					<p class="content-head">Bedrijfsinformatie</p>
					<p class="comment cursive">Pas hieronder de bedrijfsgegevens aan.</p>
					<table id="settings-table">
						<tr>
							<td><label for="bedrijfsnaam">Bedrijfsnaam</label></td>
						</tr>
						<tr>
							<td colspan="2"><input value="<?php echo $row['bedrijfnaam']; ?>" type="text" name="bedrijfsnaam" id="bedrijfsnaam" style="width:505px;" required></td>
						</tr>
						<tr>
							<td><label for="straat">Straatnaam</label></td>
							<td><label for="huisnr">Nummer</label></td>
						</tr>
						<tr>
							<td><input value="<?php echo $row['straatnaam']; ?>" type="text" id="straat" name="straat" required></td>
							<td><input value="<?php echo $row['huisnummer']; ?>" type="text" id="huisnr" name="huisnr" required></td>
						</tr>
						<tr>
							<td><label for="toevoeging">Toevoeging</label></td>
							<td><label for="postcode">Postcode</label></td>
						</tr>
						<tr>
							<td><input value="<?php echo $row['huistoevoeging']; ?>" type="text" id="toevoeging" name="toevoeging"></td>
							<td><input value="<?php echo $row['postcode']; ?>" type="text" id="postcode" name="postcode" required></td>
						<tr>
							<td><label for="plaats">Plaats</label></td>
						</tr>
						<tr>
							<td colspan="2"><input value="<?php echo $row['plaats']; ?>" type="text" id="plaats" name="plaats" style="width:505px;" required></td>
						</tr>
						<tr>
							<td><label for="land">Land</label></td>
						</tr>
						<tr>
							<td colspan="2">
								<select id="iCountry" name="iCountry">
									<?php	
										foreach ($arrayLanden as $code => $landnaam) {
											if ($landnaam == $row['land']) {
												$isSelected = " selected='' "; 
											} else {
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
							<td><input value="<?php echo $row['vn_contact']; ?>" type="text" name="voornaam" id="voornaam" required></td>
							<td><input value="<?php echo $row['an_contact']; ?>" type="text" name="achternaam" id="achternaam" required></td>
						</tr>
						<tr>
							<td><label for="telnr">Telefoonnummer</label></td>
							<td><label for="email">E-mail adres</label></td>
						</tr>
						<tr>
							<td><input value="<?php echo $row['telnr_contact']; ?>" type="text" name="telnr" id="telnr" onkeypress='return isNumberKey(event)' required></td>
							<td><input value="<?php echo $row['email_contact']; ?>" type="text" name="email" id-"email" required></td>
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
							<td colspan="2"><input value="<?php echo $row['gebruikersnaam']; ?>" type="text" name="username" id="username"></td>
						</tr>
					</table>
				</div>
				<div class="content-block">
					<p class="content-head">Maatwerkpakket</p>
					<p class="comment">Selecteer hieronder de opties die van toepassing zijn op deze klant. <br>Dit kan later altijd nog gewijzigd worden.</p>
					<ul>
						<li><label for="idcheck"><input type="checkbox" name="idcheck" id="idcheck" value="1" <?php echo ($pakket['idcheck']==1) ? "checked" : "" ; ?>> ID check</label></li>
						<li><label for="werkervaring"><input type="checkbox" name="werkervaring" id="werkervaring" value="1" <?php echo ($pakket['werkervaring']==1) ? "checked" : "" ; ?>> Werkervaring</label></li>
						<li><label for="opleiding"><input type="checkbox" name="opleiding" value="1" id="opleiding" <?php echo ($pakket['opleiding']==1) ? "checked" : "" ; ?>> Opleiding</label></li>
						<li><label for="financieel"><input type="checkbox" name="financieel" value="1" id="financieel" <?php echo ($pakket['financieel']==1) ? "checked" : "" ; ?>> Financiele situatie en gerechtelijke uitspraken</label></li>
						<li><label for="vog"><input type="checkbox" name="vog" value="1" id="vog" <?php echo ($pakket['vog']==1) ? "checked" : "" ; ?>> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label></li>
					</ul>
				</div>
				<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"><input type="submit" id="cancel" name="cancel" value="Annuleer"></div>
			</form>
		<?php
		} //ENDWHILE
		include "../footer.php";
		?>

	</div>
	
</div>
<?php
} //ENDIF
?>

</body>
</html>			