<?php include "../connect.php"; 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload CV | Certus Employment</title>
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
	$cv = "";

	//Search folder for files (verklaring) matching the specified extentions.
	foreach (glob("../file-upload/".$_SESSION['id']."/cv/*") as $filename) {
		$cv = $filename;
	}

	if(empty($cv)) {
		$posting = false;
	}

	if($posting) {
		$sql = "UPDATE klant SET cv='".$cv."' WHERE id=".$_SESSION['id']." ";
		$result = mysql_query($sql) or die(mysql_error());

		$getklant = "SELECT * FROM klant WHERE id=".$_SESSION['id']."";
		$data = mysql_query($getklant);
		$row = mysql_fetch_assoc($data);

		if($row['temppassword']==0) {
			header("Location: klant-panel.php");
		} else {
			$sql2 = "UPDATE klant SET temppassword=4 WHERE id=".$_SESSION['id']." ";
			mysql_query($sql2);
			header("Location: klant-upload-verklaring.php");
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
				Upload hier uw <b>CV</b>.
			</p>
			
			<form action="klant-upload-cv.php" class="dropzone">
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
 
$storeFolder = "../file-upload/".$_SESSION['id']."/cv";  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                         
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    move_uploaded_file($tempFile,$targetFile);
     
}

?>