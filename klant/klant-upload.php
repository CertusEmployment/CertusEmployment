<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/dropzoneIMG.js"></script>

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
			<form action="klant-upload.php" class="dropzone">
				<i class="fa font" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: ,pdf, doc, docx</p>
			</form>
		
			<p class="block">
				Upload hier een afbeelding van uw <b>paspoort of identiteitskaart</b>, het is belangrijk dat alle gegevens goed leesbaar zijn.
			</p>
			<form action="klant-upload.php" class="dropzoneIMG">
				<i class="fa" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: jpg, png, pdf</p>
			</form>

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

<!-- INSTEAD OF UPLOAD.PHP -->

<?php

$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = 'file-upload';  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                         
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    move_uploaded_file($tempFile,$targetFile);
     
}

?>