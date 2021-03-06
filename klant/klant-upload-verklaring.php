<?php include "../connect.php"; 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload toestemmingsverklaring | Certus Employment</title>
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
	$verklaring = "";

	$pakket = "SELECT * FROM maatwerk WHERE id=".$_SESSION['id']." ";
	$p = mysql_query($pakket);
	$custom = mysql_fetch_assoc($p);

	//Search folder for files (verklaring) matching the specified extentions.
	foreach (glob("../file-upload/".$_SESSION['id']."/toestemming/*") as $filename) {
		$verklaring = $filename;
	}

	if(empty($verklaring)) {
		$posting = false;
	}

	if($posting) {
		$sql = "UPDATE klant SET toestemming='".$verklaring."' WHERE id=".$_SESSION['id']." ";
		$result = mysql_query($sql) or die(mysql_error());
		header("Location: klant-integriteit.php");

		$getklant = "SELECT * FROM klant WHERE id=".$_SESSION['id']."";
		$data = mysql_query($getklant);
		$row = mysql_fetch_assoc($data);

		if($row['temppassword']==0) {
			header("Location: klant-panel.php");
		} else {
			$sql2 = "UPDATE klant SET temppassword=4 WHERE id=".$_SESSION['id']." ";
			mysql_query($sql2);

			if($row['pakket'] == 1 && $row['pakket'] == 2) {
				header("Location: klant-integriteit.php");	
			} else if($custom['vog'] == 1) {
				header("Location: klant-integriteit.php");
			} else {
				header("Location: klant-panel.php");
			}			
		}

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
			
			<p class="block">
				Upload hier uw <b>toestemming verklaring</b>, deze kunt u vinden in uw mail of <a target="_blank" href="../file-upload/default/toestemmingsverklaring.pdf">download hem hier</a>.
			</p>
				<ul>
					<li class="help-item pos3 alert">
						<a class="grey help" href="#"><i class="fa fa-question-circle"></i>Wat is dit?</a>
						<ul class="notification">
							<li>Met een toestemmingsverklaring verklaart u dat Certus Employment
								toestemming heeft om een screening uit te voeren.</li>
						</ul>
					</li>
				</ul>
			<form action="klant-upload-verklaring.php" class="dropzone">
				<i class="fa font" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: ,pdf, doc, docx</p>
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
 
$storeFolder = "../file-upload/".$_SESSION['id']."/toestemming/";  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                         
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    move_uploaded_file($tempFile,$targetFile);
     
}

?>