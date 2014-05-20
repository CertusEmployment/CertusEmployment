<?php include "../connect.php"; 
mkdir("../file-upload/".$_SESSION['id'], 0777);
session_start();

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
		
		<div class="content-block">

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