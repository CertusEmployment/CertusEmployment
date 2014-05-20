<?php include "../connect.php"; 
session_start();

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/dropzoneIMG.js"></script>

</head>

<?php

if(!isset($_POST['submit'])){
	$posting = false;
} else {
	$posting = true;
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
		
		<?
		
		while ($row=mysql_fetch_assoc($result)) {
		echo "<div class='content-block integriteit'>";
		echo "<p style='margin: 10px 0 10px 0'>".$row['vraag']."</p>";

		if($row['radiobutton']==1) {
			echo "<div style='width: 100%; margin-bottom: 10px;'>";
			echo "<label for='ja'><input style='margin:20px 5px 20px 30px;' type='radio' name='antwoord' id='ja' value='Ja'>Ja</label>";
			echo "<label for='nee'><input style='margin:20px 5px 20px 30px;' type='radio' name='antwoord' id='nee' value='Nee'>Nee</label>";
			echo "</div>";
		}

		if($row['toelichting']==1) {
			echo "<label class='bold' for='toelichting'>Toelichting</label>";
			echo "<textarea id='toelichting'></textarea>";
		}

		echo "</div>";
		}


		?>


		<form method="post" action="#" id="settings-form">	
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


$ds = DIRECTORY_SEPARATOR; 
 
$storeFolder = "../file-upload/".$_SESSION['id'];  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                         
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    move_uploaded_file($tempFile,$targetFile);
     
}

?>