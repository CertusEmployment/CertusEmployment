<?php 
include "../connect.php";
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<title>Vraagstelling toevoegen</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$posting = true;
	$optie = 0;
	$toelichting = 0;
	$verplichttext = 0;
	$verplichtoptie = 0;
	$vraagstelling = $_POST['vraagstelling'];
	// checkboxes
	if(isset($_POST['optie'])) { $optie = 1; }
	if(isset($_POST['toelichting'])) { $toelichting = 1; }
	if(isset($_POST['optie-verplicht'])) { $verplichtoptie = 1; }
	if(isset($_POST['toelichting-verplicht'])) { $verplichttext = 1; }

	if(!empty($vraagstelling)) {
		$update = "INSERT INTO integriteit (vraag, radiobutton, toelichting, optieverplicht, textverplicht) VALUES ('".$vraagstelling."', ".$optie.", ".$toelichting.", ".$verplichtoptie.", ".$verplichttext." )";
		mysql_query($update)or die(mysql_error());
		header("Location: admin-integriteit-overzicht.php");
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
				<p class="content-head">Vraagstelling toevoegen</p>
				<textarea id="vraagstelling" name="vraagstelling" required></textarea>

				<div style="width: 170px; float: left;">
					<label for="optie"><input type="checkbox" id="optie" name="optie">Ja/Nee optie weergeven</label>
				</div>
				<div style="width: 200px; float: left;">
					<label for="optie-verplicht"><input style="margin-right: 5px;" type="checkbox" id="optie-verplicht" name="optie-verplicht">Verplicht!</label>
				</div>
				<br>
				<div style="width: 210px; float: left;">
					<label for="toelichting"><input type="checkbox" id="toelichting" name="toelichting">Tekstvak toelichting weergeven</label>
				</div>
				<div style="float: left;">
					<label for="toelichting-verplicht"><input style="margin-right: 5px;" type="checkbox" id="toelichting-verplicht" name="toelichting-verplicht">Verplicht!</label>
				</div>
				<br style="clear:both;">
				<br>
			</div>

			<div id="settings-form-buttonblock">
				<input type="submit" id="next" name="submit" value="Voltooien">
				<input type="submit" onclick="location.href='admin-integriteit-overzicht.php'" id="cancel" name="submit" value="Annuleer">
			</div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			