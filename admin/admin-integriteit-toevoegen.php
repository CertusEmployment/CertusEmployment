<?php 
include "../connect.php";
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
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
	$vraagstelling = $_POST['vraagstelling'];
	if(isset($_POST['optie'])) { $optie = 1; }
	if(isset($_POST['toelichting'])) { $toelichting = 1; }

	if(!empty($vraagstelling)) {
		$update = "INSERT INTO integriteit (vraag, radiobutton, toelichting) VALUES ('".$vraagstelling."', ".$optie.", ".$toelichting.")";
		mysql_query($update);
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
				<p class="content-head">Vraagstelling <?php echo $_SESSION['integriteitid'] +1; ?></p>
				<textarea id="vraagstelling" name="vraagstelling" required></textarea>

				<label class="label-marign" for="optie"><input type="checkbox" id="optie" name="optie">Ja/Nee optie weergeven</label>
				<label class="label-margin" for="toelichting"><input type="checkbox" id="toelichting" name="toelichting">Tekstvak toelichting weergeven</label>

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