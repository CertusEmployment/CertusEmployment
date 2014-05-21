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
	$vraagstelling = $_POST['vraagstelling'];
	if(isset($_POST['optie'])) { $optie = 1; }
	if(isset($_POST['toelichting'])) { $toelichting = 1; }

	if(!empty($vraagstelling)) {
		$insert = "INSERT INTO integriteit(vraag, radiobutton, toelichting) VALUES ('".$vraagstelling."', ".$optie.", ".$toelichting.")";
		mysql_query($insert);
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
				<textarea id="vraagstelling" name="vraagstelling" required><?php echo $data['vraag']; ?></textarea>

				<label class="label-marign" for="optie">
					<input type="checkbox" id="optie" name="optie" <?php if($data['radiobutton'] == 1){ echo 'checked'; } ?> >Ja/Nee optie weergeven
				</label>

				<label class="label-margin" for="toelichting">
					<input type="checkbox" id="toelichting" name="toelichting" <?php if($data['toelichting'] == 1){ echo 'checked'; } ?> >Tekstvak toelichting weergeven
				</label>

			</div>

			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"><input type="submit" onclick="location.href='admin-panel.php'" id="cancel" name="submit" value="Annuleer"></div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			