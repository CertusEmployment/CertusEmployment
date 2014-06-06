<?php include "../connect.php"; 
session_start();

// Maak alleen klantmap aan als die niet bestaat.
if(!glob("../file-upload/".$_SESSION['id']."/identiteit")) {
	mkdir("../file-upload/".$_SESSION['id']."/identiteit", 0777);
}

if(!glob("../file-upload/".$_SESSION['id']."/toestemming")) {
	mkdir("../file-upload/".$_SESSION['id']."/toestemming", 0777);
}

if(!glob("../file-upload/".$_SESSION['id']."/cv")) {
	mkdir("../file-upload/".$_SESSION['id']."/cv", 0777);
}

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
	$posting = false;
} else {
	$posting = true;
	$digid = 0;
	$verklaring = "";
	$identiteit = "";

	//If digiD box is ticket set to 1
	if(isset($_POST['digid'])) { $digid = 1; }
  
	//Search folder for files (ID Kaart) matching the below extentions.
	foreach (glob("../file-upload/".$_SESSION['id']."/identiteit/*") as $filename) {
		$identiteit = $filename;
	}

	if(empty($identiteit)) {
		$posting = false;
	}

	if($posting) {
		$sql = "UPDATE klant SET identiteit='".$identiteit."', temppassword=3 WHERE id=".$_SESSION['id']." ";
		$result = mysql_query($sql) or die(mysql_error());
		header("Location: klant-upload-cv.php");
	}

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
		
		<div class="content-block">
			<p class="content-head">Informatievoorziening</p>


			<form action="#" method="post">
				<p class="block">
					<input type="checkbox" id="digid" name="digid" />
					<label for="digid">Ik beschik over een geldig DigiD.</label>
				</p>
				<ul>
					<li class="help-item pos3 alert">
						<a class="grey help" href="#"><i class="fa fa-question-circle"></i>Wat is dit?</a>
						<ul class="notification">
							<li>DigiD staat voor Digitale Identiteit en is een persoonlijke combinatie van een
								gebruikersnaam en een wachtwoord. U gebruikt DigiD om u te legitimeren op 
								internet. Zo weten organisaties dat ze ook echt met u te maken hebben.</li>
						</ul>
					</li>
				</ul>
			</form>
			
			<p class="block">
				Upload hier een afbeelding van uw <b>paspoort of identiteitskaart</b>, het is belangrijk dat alle gegevens goed leesbaar zijn.
			</p>
			<form action="klant-upload-identiteit.php" class="dropzoneIMG">
				<i class="fa" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: jpg, png, pdf</p>
			</form>

			<br class="clear-float">
		</div>
		<form method="post" action="#" id="settings-form">	
		<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>
		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>

<?php
}


$ds = DIRECTORY_SEPARATOR; 
 
$storeFolder = "../file-upload/".$_SESSION['id']."/identiteit/";  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                         
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    move_uploaded_file($tempFile,$targetFile);
     
}

?>