<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/main.js"></script>

	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<div id="container">

	<?php include "../toolbar-klant.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Bedrijfsprofiel</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p>

		<div class="content-block">
			<p class="content-head">Informatievoorziening</p>
			
			<p class="block">
				Upload hier uw <b>toestemming verklaring</b>, deze kunt u vinden in uw mail of <a href="#">download hem hier</a>.
			</p>
				<ul>
					<li class="help-item pos1 alert">
						<a class="grey help" href="#"><i class="fa fa-question-circle"></i>Wat is dit?</a>
						<ul class="notification">
							<li>Met een toestemmingsverklaring verklaart u dat Certus Employment
								toestemming heeft om een screening uit te voeren.</li>
						</ul>
					</li>
				</ul>
			<form action="admin-kandidaatprofiel.php" class="dropzone">
				<i class="fa font" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Remove file</a>
			 	</div><p class="comment">Bestandtypes: ,pdf, doc, docx</p>
			</form>
		
			<p class="block">
				Upload hier een afbeelding van uw <b>paspoort of identiteitskaart</b>, het is belangrijk dat alle gegevens goed leesbaar zijn.
			</p>
			<form action="admin-kandidaatprofiel.php" class="dropzone">
				<i class="fa font" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Remove file</a>
			 	</div><p class="comment">Bestandtypes: ,pdf, jpeg, png</p>
			</form>

			<form action="#">
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
			<br class="clear-float">
		</div>
		<input type="submit" id="next" name="submit" value="Opslaan">

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>

<!-- INSTEAD OF UPLOAD.PHP -->

<?php

$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'file-upload';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3                
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4   
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    move_uploaded_file($tempFile,$targetFile); //6
     
}

?>