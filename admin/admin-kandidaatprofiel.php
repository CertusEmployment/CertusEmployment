<?php

//$_SESSION['id'] = (empty($_SESSION['id'])) ? 1 : $_SESSION['id'] ;
include "../connect.php";

session_start();

if(isset($_GET['bedrijfid'])) {
	$_SESSION['bedrijfid'] = $_GET['bedrijfid'];
	header('location: admin-bedrijfsprofiel.php');
}

if(isset($_GET['delete'])) {
	$delsql = "DELETE FROM klant WHERE id = ".$_SESSION['klantid']." ";
	mysql_query($delsql);
	header('location: admin-bedrijfsprofiel.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Kandidaatprofiel</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>

<?php
// Admin verwijderd een kandidaat bestand.
if(isset($_POST['submit'])) {
	$sql = "UPDATE klant SET cv='' WHERE id='".$_SESSION['klantid']."' ";
	mysql_query($sql);

	if(mysql_query($sql)) {
		header("Location: admin-kandidaatprofiel.php");
	}
}

if(isset($_POST['submit1'])) {
	$sql = "UPDATE klant SET identiteit='' WHERE id='".$_SESSION['klantid']."' ";
	mysql_query($sql);

	if(mysql_query($sql)) {
		header("Location: admin-kandidaatprofiel.php");
	}
}

if(isset($_POST['submit2'])) {
	$sql = "UPDATE klant SET toestemming='' WHERE id='".$_SESSION['klantid']."' ";
	mysql_query($sql);

	if(mysql_query($sql)) {
		header("Location: admin-kandidaatprofiel.php");
	}
}

if(isset($_POST['submit3'])) {
	$sql = "UPDATE klant SET integriteit='' WHERE id='".$_SESSION['klantid']."' ";
	mysql_query($sql);

	if(mysql_query($sql)) {
		header("Location: admin-kandidaatprofiel.php");
	}
}

?>

<body>

<div id="container">

	<?php 
	include "toolbar-admin.php"; 

	$query = "SELECT * FROM klant WHERE id = '".$_SESSION['klantid']."'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	$navquery = "SELECT k.id, k.bedrijfid, b.id FROM klant k, bedrijf b WHERE k.bedrijfid=b.id and k.id='".$_SESSION['klantid']."' ";
	$navresult = mysql_query($navquery);
	$navrow = mysql_fetch_array($navresult);

	$datumArray = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );
	?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="admin-kandidaatprofiel.php?bedrijfid=<?php echo $navrow['bedrijfid']; ?>">Bedrijfsprofiel</a> > <a href="#" class="activepage">Kandidaatprofiel</a></p>

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
						<td><?php echo (strlen($row['postcode'])==6)? chunk_split(strtoupper($row['postcode']), 4, " ") : $row['postcode'] ; ?></td>
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
						<td><small><a href="admin-editkandidaat.php?id=<?php echo $row['id']; ?>">Gegevens wijzigen</a></small></td>
						<td><small><a href="admin-kandidaatprofiel.php?delete=true" onclick="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?');" class="red">Verwijder <?php echo $row['voornaam']." ".$row['achternaam']; ?></a></small></td>
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
				<form id="settings-form" method="post">

					<tr>
						<td><p>CV</p></td>
						<?php if(!empty($row['cv'])) { ?>
						<td style="padding-left: 10px;"><a href="<?php echo $row['cv']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Identiteit</p></td>
						<?php if(!empty($row['identiteit'])) { ?>
						<td style="padding-left: 10px;"><a href="<?php echo $row['identiteit']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit1" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Toestemmingsverklaring</p></td>
						<?php if(!empty($row['toestemming'])) { ?>
						<td style="padding-left: 10px;"><a href="<?php echo $row['toestemming']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit2" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Integriteit</p></td>
						<?php if(!empty($row['integriteit'])) { ?>
						<td style="padding-left: 10px;"><a href="<?php echo $row['integriteit']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit3" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
				</form>
				</table>

			</div>

			<div class="content-block">
				<p class="content-head">Screeningsinformatie</p>
				<p>Opleverdatum: <?php echo date('d', strtotime($row['opleverdatum'])).' '.$datumArray[date('n', strtotime($row['opleverdatum']))].' '.date('Y', strtotime($row['opleverdatum'])); ?></p>
				<p>
				<?php
					if($row['pakket'] == 1) {
						echo  "Pakket 1: Een volledige Employment Screening op alle onderdelen.";
					} elseif($row['pakket'] == 2) {
						echo "Pakket 2: Controle van een kandidaat met een buitenlands diploma.";
					} elseif($row['pakket'] == 3) {
						echo "Pakket 3: Samengesteld pakket.";
					} elseif($row['pakket'] == 4) {
						echo "Maatwerk pakket.";
					}
				?>
				</p>
				<?php 
					if($row['pakket']==3) {
						$pakketsql = "SELECT * FROM maatwerk WHERE klantid=".$_SESSION['klantid']." ";
						$pakketresult = mysql_query($pakketsql)or die(mysql_error());
						$pakket = mysql_fetch_assoc($pakketresult);
						echo "<ul class='ul-disc comment'>";
						echo ($pakket['idcheck']==1) ? "<li>ID Check</li>" : ""; 
						echo ($pakket['werkervaring']==1) ? "<li>Werkervaring</li>" : ""; 
						echo ($pakket['opleiding']==1) ? "<li>Opleiding</li>" : ""; 
						echo ($pakket['financieel']==1) ? "<li>Financiele situatie en gerechtelijke uitspraken</li>" : ""; 
						echo ($pakket['vog']==1) ? "<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>" : ""; 
						echo "</ul>";
					}

				if(!empty($rapport)) {
					echo "<p style='margin-left: 20px;'><img src='../images/excel.png' style='width: 25px; vertical-align:middle; padding-right: 5px;' /><a href='".$row['rapport']."'>Rapport beschikbaar, Download.</a></p>";
				} else {
				?>
				<!-- dropzone -->
				<form action="admin-kandidaatprofiel.php" class="dropzone">
					<i class="fa" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
				 	<div class="fallback">
				    	<input name="file" type="file" multiple />
				    	<a class="dz-remove">Verwijder bestand</a>
				 	</div><p class="comment">Bestandtypes: pdf, doc, docx</p>
				</form>

				<div><input class="upload-button" type="submit" name="upload" value="Upload" /></div>
				<?php } //endif ?>

			</div>
			
		<?php
	
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