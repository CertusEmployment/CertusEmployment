<?php 
include "../connect.php";
session_start();

$sql = "SELECT * FROM integriteit WHERE id =".$_SESSION['integriteitid']."";
$result = mysql_query($sql);
$data = mysql_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<title>Integriteit overzicht</title>
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


	if(isset($_POST['optie'])) { $optie = 1; }
	if(isset($_POST['toelichting'])) { $toelichting = 1; }
	if(isset($_POST['optie-verplicht'])) { $verplichtoptie = 1; }
	if(isset($_POST['toelichting-verplicht'])) { $verplichttext = 1; }

	if(!empty($vraagstelling)) {
		$update = "UPDATE integriteit SET vraag='".$vraagstelling."', radiobutton=".$optie.", toelichting=".$toelichting.", optieverplicht=".$verplichtoptie.", textverplicht=".$verplichttext." WHERE id=".$_SESSION['integriteitid']." ";
		mysql_query($update);
		header("Location: admin-integriteit-overzicht.php");
	}
}

if(isset($_POST['delete'])) {
	$delete = "DELETE FROM integriteit WHERE id=".$_SESSION['integriteitid']."";
	mysql_query($delete);
	header("Location: admin-integriteit-overzicht.php");
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
				<p class="content-head">Vraagstelling <?php echo $_SESSION['integriteitid']; ?></p>
				<textarea id="vraagstelling" name="vraagstelling" required><?php echo $data['vraag']; ?></textarea>

				<div style="width: 170px; float: left;">
					<label for="optie"><input type="checkbox" id="optie" name="optie" <?php if($data['radiobutton'] == 1) { echo "checked"; } ?> >Ja/Nee optie weergeven</label>
				</div>
				<div style="width: 200px; float: left;">
					<label for="optie-verplicht"><input style="margin-right: 5px;" type="checkbox" id="optie-verplicht" name="optie-verplicht" <?php if($data['optieverplicht'] == 1) { echo "checked"; } ?> >Verplicht!</label>
				</div>
				<br>
				<div style="width: 210px; float: left;">
					<label for="toelichting"><input type="checkbox" id="toelichting" name="toelichting" <?php if($data['toelichting'] == 1) { echo "checked"; } ?> >Tekstvak toelichting weergeven</label>
				</div>
				<div style="float: left;">
					<label for="toelichting-verplicht"><input style="margin-right: 5px;" type="checkbox" id="toelichting-verplicht" name="toelichting-verplicht" <?php if($data['textverplicht'] == 1) { echo "checked"; } ?> >Verplicht!</label>
				</div>
				<br style="clear:both;">
				<br>
	
			</div>

			<div id="settings-form-buttonblock">
				<input type="submit" id="next" name="submit" value="Voltooien">
				<input type="submit" id="next" name="delete" value="Verwijderen">
				<input type="submit" onclick="location.href='admin-panel.php'" id="cancel" name="submit" value="Annuleer">
			</div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			