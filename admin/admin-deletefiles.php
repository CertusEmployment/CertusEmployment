<?php include "../connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Bestanden verwijderen | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="container">

<?php
include "toolbar-admin.php"; 

$query = "SELECT * FROM klant WHERE id = '".$_SESSION['klantid']."'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

//mail header
$header = "MIME-version: 1.0\n"; 
$header .= "content-type: text/html;charset=utf-8\n";
$header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

// Maak default $vars aan.
$to = $row['email'];
$subject = "Er zijn een of meerdere bestanden verwijderd";
$mail = 0;
$_SESSION['an'] = $row['achternaam'];

if($row['geslacht'] == 'm') {
	$aanhef = "heer";
} else {
	$aanhef = "mevrouw";
}

if(isset($_POST['textsubmit'])) {
	$_SESSION['deletetext'] = $_POST['deletetext'];
	include "../email/klant-file-delete.php";
	if($_SESSION['filedelete'] == 1) {
		unlink($row['identiteit']);
		$sql = "UPDATE klant SET identiteit='' WHERE id='".$_SESSION['klantid']."' ";
		mysql_query($sql) or die(mysql_error());

	} 

	if($_SESSION['filedelete'] == 2) {
		unlink($row['toestemming']);
		$sql = "UPDATE klant SET toestemming='' WHERE id='".$_SESSION['klantid']."' ";
		mysql_query($sql);

	}

	if($_SESSION['filedelete'] == 3) {
		unlink($row['integriteit']);
		$sql = "UPDATE klant SET integriteit='' WHERE id='".$_SESSION['klantid']."' ";
		mysql_query($sql);

	} 

	if($_SESSION['filedelete'] == 4) {
		unlink($row['cv']);
		$sql = "UPDATE klant SET cv='' WHERE id='".$_SESSION['klantid']."' ";
		mysql_query($sql);

	}

	if(mysql_query($sql)) {		
		if($row['sentmail'] ==1) {
			mail($to, $subject, $messageklantfiledelete, $header);
		}
		header("Location: admin-kandidaatprofiel.php");
	}
}




?>
<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="admin-kandidaatprofiel.php?bedrijfid=<?php echo $navrow['bedrijfid']; ?>">Bedrijfsprofiel</a> > <a href="#">Kandidaatprofiel</a> > <a href="#"></a></p>

			<div class="content-block">
			<p>Vul hier de toelichting in:</p>
			<form method="post" name="deletetextform" action="<?php $_SERVER['PHP_SELF'] ?>" >
				<textarea name="deletetext" id="deletetext"></textarea>
				<input type="submit" name="textsubmit" value="Verstuur" id="next">
			</form>
			<br class="clear-float">
			</div>
</div>
</div>

</body>
</html>