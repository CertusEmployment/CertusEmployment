<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<div id="container">

	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Bedrijfsprofiel</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p>

		<div class="content-block">
			<table class="profiletable">
				<tr>
					<th>Kandidaatgegevens</th>
					<th></th>
					<th>Accountgegevens</th>
				</tr>
				<tr>
					<td>Naam</td>
					<td>Roy Thuis</td>
					<td>Gebruikersnaam</td>
					<td>roy.thuis</td>
				</tr>
				<tr>
					<td>Straatnaam en huisnr</td>
					<td>Lekstraat 18</td>
					<td>E-mail</td>
					<td>roythuis1994@hotmail.com</td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td>7071 VB</td>
					<td>Wachtwoord</td>
					<td>*****</td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td>Ulft</td>
				</tr>
				<tr>
					<td>Land</td>
					<td>Nederland</td>
				</tr>
				<tr>
					<td>Geboortedatum</td>
					<td>05-07-1994</td>
				</tr>
				<tr>
					<td>Geboorteplaats</td>
					<td>Doetinchem</td>
					<td><small><a href="#">Gegevens wijzigen</a></small></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<th colspan="2">DigID beschikbaar</th>
				</tr> 
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Bestanden</p>
			<ul class="ul-disc">
				<li>CV.docx</li>
				<li>ID.jpg</li>
				<li>Toestemmingsverklaring.docx</li>
				<li>Integriteitstest.pdf</li>
			</ul>
		</div>

		<div class="content-block">
			<p class="content-head">Screeningsinformatie</p>
			<p>Pakket 2</p>
			<p>Opleverdatum: 24-4-14</p>
			<form action="admin-kandidaatprofiel.php" class="dropzone">
				<i class="fa" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: pdf, doc, docx</p>
			</form>

		</div>

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