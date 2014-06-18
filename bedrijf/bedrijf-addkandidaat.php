<?php 
session_start();
include "../connect.php";
include "../landen-array.php";
$mChecked = "";
$vChecked = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nieuwe kandidaat | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/main.js"></script>
	<!-- datepicker -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
	//http://jqueryui.com/datepicker/  
	$(function() {
	    $( "#gebdatum" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      yearRange: "-80:+0",
	      minDate: "-80Y", maxDate: "+0"
	    });
	 });
	 </script>
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<?php 
$warning = false;
if(isset($_POST['cancel'])) {
	header('location: bedrijf-panel.php');
}
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
	$_SESSION['vn'] = $_POST['voornaam'];
	$_SESSION['an'] = $_POST['achternaam']; 
	$_SESSION['straat'] = $_POST['straat'];
	$_SESSION['huisnr'] = $_POST['huisnr'];
	$_SESSION['toevoeging'] = $_POST['toevoeging'];
	$_SESSION['postcode'] = $_POST['postcode'];
	$_SESSION['plaats'] = $_POST['plaats'];
	$_SESSION['land'] = $_POST['iCountry'];
	$_SESSION['gebdatum'] = date('Y-m-d',strtotime($_POST['gebdatum'])); 
	$_SESSION['gebplaats'] = $_POST['gebplaats'];
	$_SESSION['sex'] = $_POST['sex'];
	//contactinformatie 
	$_SESSION['telnr'] = $_POST['telnr'];
	$_SESSION['email'] = $_POST['email']; 
	//standaardvars
	$_SESSION['aanmaakdatum'] = date('Y-m-d');
	//$vn = str_replace(' ', '', $vn);
	//$an = str_replace(' ', '', $an);
	$_SESSION['username'] = str_replace(' ', '', strtolower($_POST['voornaam'])) .".". str_replace(' ', '', strtolower($_POST['achternaam']));
	$_SESSION['temppassword'] = 1;
	$_SESSION['temp'] = randomPassword(); //random wachtwoord
	$_SESSION['password'] = hash('sha1', $_SESSION['temp']);

	if(!preg_match($regex, $_SESSION['email'])) {
		$posting = false;
		$warning = true;
	}

	if($posting) {
		header("Location: bedrijf-pakketselectie.php");
		echo randomPassword();
		}
}

if(!$posting) { 
	if(isset($_SESSION['sex'])) {
		($_SESSION['sex'] == 'v' ? $vChecked = "checked='checked'" : $mChecked = "checked='checked'");
	}
?>

<div id="container">

	<?php include "toolbar-bedrijf.php"; $_SESSION['aanmaakdatum'] = date('Y-m-d');?>

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
						<td><input type="text" id="voornaam" value="<?php echo (!empty($_SESSION['vn']))? $_SESSION['vn'] : '' ; ?>" name="voornaam" required></td>
						<td><input type="text" id="achternaam" value="<?php echo (!empty($_SESSION['an']))? $_SESSION['an'] : '' ; ?>" name="achternaam" required></td>
					</tr>
					<tr>
						<td>
							<label for="man"><input style="margin:20px 0 20px 30px;" <?php echo $mChecked; ?> type="radio" name="sex" id="man" value="m"> Man</label>
							<label for="vrouw"><input style="margin:20px 0 20px 30px;" <?php echo $vChecked; ?> type="radio" name="sex" id="vrouw" value="v"> Vrouw</label>
						</td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Huisnummer</label><label for="toevoeging" style="margin-left: 60px;">Toevoeging</label></td>
					</tr>
					<tr>
						<td><input type="text" id="straat" name="straat" value="<?php echo (!empty($_SESSION['straat']))? $_SESSION['straat'] : '' ; ?>" required></td>
						<td><input type="text" id="huisnr" name="huisnr" value="<?php echo (!empty($_SESSION['huisnr']))? $_SESSION['huisnr'] : '' ; ?>" required style="width:110px;"><input type="text" id="toevoeging" name="toevoeging" style="width:110px; margin-left: 10px;">
					</tr>
					<tr>
						<td><label for="postcode">Postcode</label></td>
						<td><label for="plaats">Woonplaats</label></td>
					</tr>
					<tr>
						<td><input type="text" id="postcode" name="postcode" value="<?php echo (!empty($_SESSION['postcode']))? $_SESSION['postcode'] : '' ; ?>" required></td>
						<td><input type="text" id="plaats" name="plaats" value="<?php echo (!empty($_SESSION['plaats']))? $_SESSION['plaats'] : '' ; ?>" required></td>
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
					<tr>
						<td><label for="gebdatum">Geboortedatum</label></td>
						<td><label for="gebplaats">Geboorteplaats</label></td>
					</tr>
					<tr>
						<td><input type="text"  id="gebdatum" name="gebdatum" value="<?php echo (!empty($_SESSION['gebdatum']))? $_SESSION['gebdatum'] : '' ; ?>" placeholder="00-00-0000" required></td>
						<td><input type="text" id="gebplaats" name="gebplaats" value="<?php echo (!empty($_SESSION['gebplaats']))? $_SESSION['gebplaats'] : '' ; ?>" required></td>
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
					<?php if($warning==true){ echo "<tr><td></td><td class='errormessage'>Voer een kloppend e-mailadres in</td></tr>"; } ?>
					<tr>
						<td><input type="text" id="telnr" name="telnr" onkeypress='return isNumberKey(event)' value="<?php echo (!empty($_SESSION['telnr']))? $_SESSION['telnr'] : '' ; ?>" required></td>
						<td><input <?php if($warning){ echo "class='errorinput'"; } ?> type="text" id="email" name="email" value="<?php echo (!empty($_SESSION['email']))? $_SESSION['email'] : '' ; ?>"></td>
					</tr>
				</table>
			</div>

			<div id="settings-form-buttonblock">
				<input type="submit" id="next" name="submit" value="Opslaan"><a id="next" href="bedrijf-panel.php">Annuleer</a><!-- <button id="next" onclick="location.href='bedrijf-panel.php'">Annuleer</button> -->
			</div>
		</form>

		<?php include "../footer.php"; ?>
		<?php } //close if ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>