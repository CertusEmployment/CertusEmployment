<?php 

include "../connect.php";
include "../landen-array.php";

$gegevens_query = "SELECT * FROM klant WHERE id = '".$_GET['id']."'";
$gegevens_result = mysql_query($gegevens_query);
	
$mChecked = "";
$vChecked = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Kandidaat wijzigen</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<script src="../js/main.js"></script>
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<?php
if(isset($_POST['cancel'])) {
	$pageid = $_GET['id'];
	header("Location: admin-kandidaatprofiel.php?id=$pageid");
}
if(!isset($_POST['submit'])) {
	$posting = false;
	unset($password);
	unset($repeat);

} else {

	$posting = true;
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	//Bedrijfsgegevens
	$voornaam = htmlentities(strip_tags(trim($_POST['voornaam'])));
	$achternaam = htmlentities(strip_tags(trim($_POST['achternaam'])));
	$straat = htmlentities(strip_tags(trim($_POST['straat'])));
	$huisnr = htmlentities(strip_tags(trim($_POST['huisnr'])));
	$toevoeging = htmlentities(strip_tags(trim($_POST['toevoeging'])));
	$postcode = htmlentities(strip_tags(trim($_POST['postcode'])));
	$plaats = htmlentities(strip_tags(trim($_POST['plaats'])));
	$land = $_POST['iCountry'];
	$geboortedatum = date('Y-m-d',strtotime($_POST['geboortedatum']));
	$geboorteplaats = htmlentities(strip_tags(trim($_POST['geboorteplaats'])));
	$telnr = htmlentities(strip_tags(trim($_POST['telnr'])));
	$email = htmlentities(strip_tags(trim($_POST['email'])));
	//maatwerkpakket
	
	if(!preg_match($regex, $email)){ 
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
		$update_sql = "UPDATE klant SET 
		voornaam='".$voornaam."',
		achternaam='".$achternaam."',
		straatnaam='".$straat."',
		huisnummer=".$huisnr.",
		huistoevoeging='".$toevoeging."',
		postcode='".$postcode."',
		plaats='".$plaats."',
		land='".$land."',
		geboortedatum='".$geboortedatum."',
		geboorteplaats='".$geboorteplaats."',
		telnr='".$telnr."',
		email='".$email."'
		WHERE id=".$_GET['id']." ";
		$update_result = mysql_query($update_sql) or die(mysql_error());
		$pageid = $_GET['id'];
		header("Location: admin-kandidaatprofiel.php?id=$pageid");
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
		<?php while ($row = mysql_fetch_array($gegevens_result)) {
					($row['geslacht'] == 'm' ? $mChecked = "checked='checked'" : $vChecked = "checked='checked'");
					(empty($row['toevoeging']) ? $row['toevoeging']= "" : $row['toevoeging']=$row['toevoeging']);
			?>
			<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="admin-bedrijfsprofiel.php?id=<?php echo $row['bedrijfid']; ?>">Bedrijfsprofiel</a> > <a href="admin-kandidaatprofiel.php?id=<?php echo $row['id']; ?>">Kandidaatprofiel</a> > <a href="#" class="activepage">Wijzigen</a></p>
		
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
							<td><input type="text" value="<?php echo $row['voornaam']; ?>" id="voornaam" name="voornaam" required></td>
							<td><input type="text" value="<?php echo $row['achternaam']; ?>" id="achternaam" name="achternaam" required></td>
						</tr>
						<tr>
							<td><label for="man"><input <?php echo $mChecked; ?> style="margin:20px 0 20px 30px;" type="radio" name="sex" id="man" value="man"> Man</label> <label for="vrouw"><input <?php echo $vChecked; ?> style="margin:20px 0 20px 30px;" type="radio" name="sex" id="vrouw" value="vrouw"> Vrouw</label></td>
						</tr>
						<tr>
							<td><label for="straat">Straatnaam</label></td>
							<td><label for="huisnr">Nummer</label><label for="toevoeging" style="margin-left: 80px;">Toevoeging</label></td>
						</tr>
						<tr>
							<td><input type="text" value="<?php echo $row['straatnaam']; ?>" id="straat" name="straat" required></td>
							<td><input type="text" value="<?php echo $row['huisnummer']; ?>" id="huisnr" name="huisnr" required style="width:110px;"><input type="text" id="toevoeging" value="<?php echo $row['toevoeging']; ?>" name="toevoeging" style="width:110px; margin-left: 10px;">
						</tr>
						<tr>
							<td><label for="postcode">Postcode</label></td>
							<td><label for="plaats">Woonplaats</label></td>
						</tr>
						<tr>
							<td><input type="text" value="<?php echo $row['postcode']; ?>" id="postcode" name="postcode" required></td>
							<td><input type="text" value="<?php echo $row['plaats']; ?>" id="plaats" name="plaats" required></td>
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
						<tr>
							<td><label for="geboortedatum">Geboortedatum</label></td>
							<td><label for="geboorteplaats">Geboorteplaats</label></td>
						</tr>
						<tr>
							<td><input type="text" value="<?php echo date('d-m-Y', strtotime($row['geboortedatum'])); ?>" placeholder="YYYY-MM-DD" id="geboortedatum" name="geboortedatum" required></td>
							<td><input type="text" value="<?php echo $row['geboorteplaats']; ?>" id="geboorteplaats" name="geboorteplaats" required></td>
						</tr>
					</table>
				</div>

				<div class="content-block">
					<p class="content-head">Extra informatie</p>
					<table id="settings-table">
						<tr>
							<td><label for="telnr">Telefoonnummer</label></td>
							<td><label for="mail">E-mailadres</label></td>
						</tr>
						<tr>
							<td><input type="text" value="<?php echo $row['telnr']; ?>" onkeypress='return isNumberKey(event)' id="telnr" name="telnr" required></td>
							<td><input type="text" value="<?php echo $row['email']; ?>" id="mail" name="email" required></td>
						</tr>
					</table>
				</div>

				<div class="content-block">
					<p class="content-head">Bestanden</p>
					<table>
						<tr>
							<td>CV.docx</td>
							<td><a href="#">Verwijderen</a></td>
						</tr>
						<tr>
							<td>ID.jpg</td>
							<td><a href="#">Verwijderen</a></td>
						</tr>
						<tr>
							<td>Toestemmingsverklaring.docx</td>
							<td><a href="#">Verwijderen</a></td>
						</tr>
						<tr>
							<td>Integriteitsverklaring.pdf</td>
							<td><a href="#">Verwijderen</a></td>
						</tr>
					</table>
				</div>

				<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" id="cancel" name="cancel" value="Annuleer"></div>
			</form>
		<?php 
			} //ENDWHILE

		include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div> <!-- container -->

<?php } //ENDIF ?>

</body>
</html>