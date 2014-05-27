<?php 
include "../connect.php"; 
session_start();

$_SESSION['p'] = 1;

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/dropzoneIMG.js"></script>

</head>

<?php

if(!isset($_POST['submit'])){
	//Unset alle vars voor de optelling onderaan.
	unset($_SESSION['i']);
	unset($_SESSION['p']);
	$_SESSION['i'] = 1;
	$posting = false;
} else {

	$_SESSION['amount'] = $_SESSION['i'];

	for($_SESSION['p'] = 1; $_SESSION['p']<$_SESSION['i']; $_SESSION['p']++) {
		$_SESSION['toelichting'.$_SESSION['p'].''] = $_POST['toelichting'.$_SESSION['p'].''];
		echo $_SESSION['toelichting'.$_SESSION['p']];
	}

	$posting = true;
	//header("Location: klant-create-pdf.php");
}

if(!$posting) {

?>

<body>

<div id="container">

	<?php include "toolbar-klant.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Bedrijfsprofiel</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p>
		<form method="post" id="settings-form">	
		<?

		$radio_req = "";
		$text_req = "";
		
		while ($row=mysql_fetch_assoc($result)) {
		echo "<div class='content-block integriteit'>";
		echo "<p class='integriteit-vraag'>".$row['vraag']."</p>";

		if($row['optieverplicht'] == 1) {
			$radio_req = "required";
		}

		if($row['textverplicht'] == 1) {
			$text_req = "required";
		}

		if($row['radiobutton']==1) {
		?>
			<div style='width: 100%; margin-bottom: 10px;'>
			<label for="ja<?php echo $_SESSION['i']; ?>"><input style="margin:20px 5px 20px 30px;" type="radio" name="antwoord<?php echo $_SESSION['i']; ?>" id="ja<?php echo $_SESSION['i']; ?>" value="Ja" <?php echo $radio_req; ?>>Ja</label>
			<label for="nee<?php echo $_SESSION['i']; ?>"><input style="margin:20px 5px 20px 30px;" type="radio" name="antwoord<?php echo $_SESSION['i']; ?>" id="nee<?php echo $_SESSION['i']; ?>" value="Nee" <?php echo $radio_req; ?>>Nee</label>
			</div>

		<?php
		}

		if($row['toelichting']==1) {
		?>
		
			<label class="bold" for="toelichting<?php echo $_SESSION['i']; ?>">Toelichting</label>";
			<textarea id="toelichting<?php echo $_SESSION['i']; ?>" name="toelichting<?php echo $_SESSION['i']; ?>" <?php echo $text_req; ?>></textarea>
		
		<?php
		}

		$_SESSION['i']++;
		echo "</div>";
		}

		?>

		<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Verzenden"></div>
		</form>
		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>

<!-- INSTEAD OF UPLOAD.PHP -->

<?php
}
?>