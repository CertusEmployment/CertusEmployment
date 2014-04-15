<?php

include "../connect.php";

$query = "SELECT * FROM klant WHERE id = '".$_GET['id']."'";
$result = mysql_query($query);

$navquery = "SELECT k.id, k.bedrijfid, b.id FROM klant k, bedrijf b WHERE k.bedrijfid=b.id and k.id='".$_GET['id']."' ";
$navresult = mysql_query($navquery);

?>
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

		<?php
		while ($navrow = mysql_fetch_array($navresult)) {
		?><p id="breadcrumbs"><a href="admin-panel">Overzicht</a> > <a href="admin-bedrijfsprofiel.php?id=<?php echo $navrow['bedrijfid']; ?>">Bedrijfsprofiel</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p><?php
		}?>


		<?php
		while ($row = mysql_fetch_array($result)) {
		?>
			<div class="content-block">
				<table class="profiletable">
					<tr>
						<th>Kandidaatgegevens</th>
						<th></th>
						<th>Accountgegevens</th>
					</tr>
					<tr>
						<td>Naam</td>
						<td><?php echo ucfirst($row['voornaam'])." ".ucfirst($row['achternaam']); ?></td>
						<td>Gebruikersnaam</td>
						<td><?php echo $row['gebruikersnaam']; ?></td>
					</tr>
					<tr>
						<td>Straatnaam en huisnr</td>
						<td><?php echo ucfirst($row['straatnaam'])." ".$row['huisnummer']." ".$row['huistoevoeging']; ?></td>
						<td>E-mail</td>
						<td><?php echo $row['email']; ?></td>
					</tr>
					<tr>
						<td>Postcode</td>
						<td><?php echo chunk_split(strtoupper($row['postcode']), 4, " "); ?></td>
						<td>Wachtwoord</td>
						<td><?php echo $row['wachtwoord']; ?></td>
					</tr>
					<tr>
						<td>Woonplaats</td>
						<td><?php echo ucfirst($row['plaats']); ?></td>
					</tr>
					<tr>
						<td>Land</td>
						<td><?php echo ucfirst($row['land']); ?></td>
					</tr>
					<tr>
						<td>Geboortedatum</td>
						<td><?php echo date('d M Y', strtotime($row['geboortedatum'])); ?></td>
					</tr>
					<tr>
						<td>Geboorteplaats</td>
						<td><?php echo ucfirst($row['geboorteplaats']); ?></td>
						<td><small><a href="#">Gegevens wijzigen</a></small></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<th colspan="2"><?php echo $row['digid'] = (empty($row['digid'])) ? "Geen DigiD beschikbaar" : "DigiD beschikbaar" ; ?></th>
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
				<p>Pakket <?php echo $row['pakket']; ?></p>
				<p>Opleverdatum: <?php echo date('d M Y', strtotime($row['opleverdatum'])); ?></p>
				<form action="admin-kandidaatprofiel.php" class="dropzone">
					<i class="fa" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
				 	<div class="fallback">
				    	<input name="file" type="file" multiple />
				    	<a class="dz-remove">Verwijder bestand</a>
				 	</div><p class="comment">Bestandtypes: pdf, doc, docx</p>
				</form>

			</div>
		<?php
		} //ENDWHILE
		?>

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