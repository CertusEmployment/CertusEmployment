<?php

//$_SESSION['id'] = (empty($_SESSION['id'])) ? 1 : $_SESSION['id'] ;
include "../connect.php";

session_start();

ob_start();

// Maak alleen rapportmap aan als deze niet bestaat.
if(!glob("../file-upload/".$_SESSION['klantid']."/rapport")) {
	mkdir("../file-upload/".$_SESSION['klantid']."/rapport", 0777);
}

if(isset($_GET['bedrijfid'])) {
	$_SESSION['bedrijfid'] = $_GET['bedrijfid'];
	header('location: admin-bedrijfsprofiel.php');
}

if(isset($_GET['delete'])) {
	$delsql = "DELETE FROM klant WHERE id = '".$_SESSION['klantid']."' ";
	mysql_query($delsql);
	//Delete klant directory
	rmdir("../file-upload/".$_SESSION['klantid']);
	header('location: admin-bedrijfsprofiel.php');
}

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
</head>
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
	
	//mail header
	$header = "MIME-version: 1.0\n"; 
	$header .= "content-type: text/html;charset=utf-8\n";
	$header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

	// Maak default $vars aan.
	$rapport = "";
	$getbedrijf = "SELECT * FROM bedrijf WHERE id='".$row['bedrijfid']."'";
	$outcome = mysql_query($getbedrijf);
	$bedrijfdata = mysql_fetch_assoc($outcome);
	$to = $row['email'];
	$subject = "Er is een screening rapport beschikbaar";
	$subject3 = "Er zijn een of meerdere bestanden verwijderd";
	$mail = 0;
	$tobedrijf = $bedrijfdata['email_contact'];
	$contact_an = $bedrijfdata['an_contact'];
	$_SESSION['an'] = $row['achternaam'];

	if($row['geslacht'] == 'm') {
		$aanhef = "heer";
	} else {
		$aanhef = "mevrouw";
	}

	if(isset($_POST['submit1'])) {
		$_SESSION['filedelete'] = 1;
	}
	if(isset($_POST['submit2'])) {
		$_SESSION['filedelete'] = 2;
	}
	if(isset($_POST['submit3'])) {
		$_SESSION['filedelete'] = 3;
	}

	if(isset($_POST['submit4'])) {
		$_SESSION['filedelete'] = 4;
	}

	if(isset($_POST['deleterapport'])) {
		unlink($row['rapport']);
		$sql = "UPDATE klant SET rapport='' WHERE id='".$_SESSION['klantid']."' ";
		mysql_query($sql) or die(mysql_error());
		header('Location: admin-kandidaatprofiel.php');
	}

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
						<td><?php echo $row['postcode']); ?></td>
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
				<form id="settings-form" method="post" action="admin-deletefiles.php">

					<tr>
						<td><p>CV</p></td>
						<?php if(!empty($row['cv'])) { ?>
						<td style="padding-left: 10px;"><a target="_blank" href="<?php echo $row['cv']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit4" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Identiteit</p></td>
						<?php if(!empty($row['identiteit'])) { ?>
						<td style="padding-left: 10px;"><a target="_blank" href="<?php echo $row['identiteit']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit1" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Toestemmingsverklaring</p></td>
						<?php if(!empty($row['toestemming'])) { ?>
						<td style="padding-left: 10px;"><a target="_blank" href="<?php echo $row['toestemming']; ?>">Download</td>
						<td style="padding-left: 10px;"><input class="nostyle" type="submit" name="submit2" value="Verwijderen" /></td>
						<?php } else { ?>
						<td style="padding-left: 10px;"><p class="comment">Niet beschikbaar</p></td>
						<?php } ?>
					</tr>
					<tr>
						<td><p>Integriteit</p></td>
						<?php if(!empty($row['integriteit'])) { ?>
						<td style="padding-left: 10px;"><a target="_blank" href="<?php echo $row['integriteit']; ?>">Download</td>
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

				if(!empty($row['rapport'])) {
					?><form method="post" action="#" style="margin:15px 0;"><span style='margin-left: 20px;'><img src='../images/pdf.png' style='width: 30px; vertical-align:middle; padding-right: 5px;' /><a href='<?php echo $row['rapport']; ?>'>Rapport beschikbaar, Download.</a></span>
					<span style="margin-left:51px;"><input class="nostyle" type="submit" name="deleterapport" value="Verwijderen"></span></form> <?php
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

				<form id="upload" method="post">
					<div><input class="upload-button" type="submit" name="upload" value="Upload" /></div>
				</form>
				<?php } //endif ?>
			</div>
			
		<?php

		$ds = DIRECTORY_SEPARATOR; 
 		$storeFolder = "../file-upload/".$_SESSION['klantid']."/rapport/";  
	 
		if (!empty($_FILES)) {
    		$tempFile = $_FILES['file']['tmp_name'];                         
    		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    		$targetFile =  $targetPath. $_FILES['file']['name']; 
    		move_uploaded_file($tempFile,$targetFile);
    	}

	
		if(isset($_POST['upload'])) {

    		// Include HTML emails
			include "../email/bedrijf-rapport-upload.php";
			include "../email/klant-rapport-upload.php";

			foreach (glob("../file-upload/".$_SESSION['klantid']."/rapport/*") as $filename) {
				$rapport = $filename;
			}

			$sql = "UPDATE klant SET rapport='".$rapport."' WHERE id='".$_SESSION['klantid']."' ";
			mysql_query($sql) or die(mysql_error());
		
			if(mysql_query($sql)) {
				if($row['sentmail'] == 1) {
					mail($to, $subject, $messageklantrapport, $header);				
				}

				if($bedrijfdata['sentmail'] == 1) {
					mail($tobedrijf, $subject, $messagebedrijfrapport, $header);		
				}
				header("Location: admin-kandidaatprofiel.php");
			}
	}


		include "../footer.php"; ?>

	</div> <!-- wrapper -->
</div>

</body>
</html>

<!-- INSTEAD OF UPLOAD.PHP -->

<?php



// Deleten van items
// Mail versturen naar kandidaat bij een verandering
/*
$to = $row['email'];
$subject = "Melding Certus-Employment";
$subject2 = "Uw rapport is beschikbaar";
$subject3 = "Screening afgerond";
//mail message
if($row['geslacht'] == 'm') {
	$aanhef = "heer";
} else {
	$aanhef = "mevrouw";
}



include "../email/klant-file-delete.php";
include "../email/klant-rapport-upload.php";
*/









?>

