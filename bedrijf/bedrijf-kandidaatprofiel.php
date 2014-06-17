<?php

//$_SESSION['id'] = (empty($_SESSION['id'])) ? 1 : $_SESSION['id'] ;
include "../connect.php";
$datumArray = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kandidaatprofiel | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<div id="container">

	<?php 
	include "toolbar-bedrijf.php"; 

	$navquery = "SELECT k.id, k.bedrijfid, b.id FROM klant k, bedrijf b WHERE k.bedrijfid=b.id and k.id='".$_SESSION['id']."' ";
	$navresult = mysql_query($navquery);
	?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<?php
		while ($navrow = mysql_fetch_array($navresult)) { ?>
			<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p><?php
		} 

		if(!isset($_SESSION['klantid'])) {
			?><div class="content-block">
				<p>Er is iets mis gegaan met het ophalen van de klantgegevens</p>
				<a href="bedrijf-panel.php">Ga terug naar het overzicht.</a>
			</div><?php
		} else {
			$query = "SELECT * FROM klant WHERE id = '".$_SESSION['klantid']."'";
			$result = mysql_query($query);
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
							<td>Adres</td>
							<td><?php echo ucfirst($row['straatnaam'])." ".$row['huisnummer']." ".$row['huistoevoeging']; ?></td>
							<td>E-mail</td>
							<td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
						</tr>
						<tr>
							<td>Postcode</td>
							<td><?php echo chunk_split(strtoupper($row['postcode']), 4, " "); ?></td>
							<td>Wachtwoord</td>
							<td>&#8226;&#8226;&#8226;&#8226;&#8226;</td>
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
							<td><?php echo date('d', strtotime($row['geboortedatum'])).' '.$datumArray[date('n', strtotime($row['geboortedatum']))].' '.date('Y', strtotime($row['geboortedatum'])); ?></td>
						</tr>
						<tr>
							<td>Geboorteplaats</td>
							<td><?php echo ucfirst($row['geboorteplaats']); ?></td>
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
					<table class="recenttable">
						<?php if(!empty($row['cv'])) { ?>
						<tr>
							<td><a style="color:black;" href="#">CV.docx</a></td>
						</tr>
						<?php }
						if(!empty($row['identiteit'])) { ?>
						<tr>
							<td><a style="color:black;" href="#">ID.jpeg</a></td>
						</tr>
						<?php }
						if(!empty($row['toestemming'])) { ?>
						<tr>
							<td><a style="color:black;" href="#">Toestemmingsverklaring.docx</a></td>
						</tr>
						<?php }
						if(!empty($row['integriteit'])) { ?>
						<tr>
							<td><a style="color:black;" href="#">Integriteitstest.pdf</a></td>
						</tr>
						<?php } 
						if(empty($row['cv']) && empty($row['identiteit']) && empty($row['toestemming']) && empty($row['integriteit'])) { 
							echo "<p class='comment'>Kandidaat heeft nog geen bestanden geupload.</p>";
						}
						?>
					</table>
				</div>

				<div class="content-block">
					<p class="content-head">Screeningsinformatie</p>
					<p>Opleverdatum: <?php echo date('d', strtotime($row['opleverdatum'])).' '.$datumArray[date('n', strtotime($row['opleverdatum']))].' '.date('Y', strtotime($row['opleverdatum'])); ?></p>
					<p>Pakket <?php echo ($row['pakket']==0)? "<i>Geen pakket geselecteerd</i>" : $row['pakket'] ; ?></p>
					<?php 
						if($row['pakket']==3) {
							$pakketsql = "SELECT * FROM maatwerk WHERE klantid=".$_SESSION['klantid']." ";
							$pakketresult = mysql_query($pakketsql);
							$pakket = mysql_fetch_assoc($pakketresult);
							echo "<p>Pakketsamenstelling</p>";
							echo "<ul class='ul-disc'>";
							echo ($pakket['idcheck']==1) ? "<li>ID Check</li>" : ""; 
							echo ($pakket['werkervaring']==1) ? "<li>Werkervaring</li>" : ""; 
							echo ($pakket['opleiding']==1) ? "<li>Opleiding</li>" : ""; 
							echo ($pakket['financieel']==1) ? "<li>Financiele situatie en gerechtelijke uitspraken</li>" : ""; 
							echo ($pakket['vog']==1) ? "<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>" : ""; 
							echo "</ul>";
						} 
					?>
				</div>
			<?php
			} //ENDWHILE
		} //ENDIF
		?>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>

<!-- INSTEAD OF UPLOAD.PHP -->

<?php

// $ds          = DIRECTORY_SEPARATOR; 
 
// $storeFolder = 'file-upload';  
 
// if (!empty($_FILES)) {
     
//     $tempFile = $_FILES['file']['tmp_name'];                         
//     $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
//     $targetFile =  $targetPath. $_FILES['file']['name']; 
//     move_uploaded_file($tempFile,$targetFile);
     
// }

?>