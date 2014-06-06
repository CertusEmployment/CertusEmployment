<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Uw overzicht</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
</head>
<body>

<div id="container">

	<?php 

	// Klant profiel
	include "toolbar-klant.php";
	$sql = "SELECT * FROM klant WHERE id=".$_SESSION['id']."";
	$result = mysql_query($sql);
	$info = mysql_fetch_assoc($result);

	if(!empty($info['identiteit'])) {
		$identiteit = "<a href='".$info['identiteit']."'>Download</a>";
	} else {
		$identiteit = "ID niet goed leesbaar of ongeschikt. <a href='klant-upload.php'>Upload hier</a>";
	}

	if(!empty($info['toestemming'])) {
		$toestemming = "<a href='".$info['toestemming']."'>Download</a>";
	} else {
		$toestemming = "Geen Toestemmingsverklaring geupload. <a href='klant-upload.php'>Upload hier</a>";
	}

	if(!empty($info['rapport'])) {
		$rapport = "<a href='".$info['rapport']."'>Download</a>";
	} else {
		$rapport = "Helaas, er is nog geen rapport beschikbaar.";
	}

	?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#" class="activepage">Overzicht</a></p>


		<div class="content-block">
			<p class="content-head">Persoonlijke informatie</p>
			<table class="profiletable">
				<tr>
					<td>Naam</td>
					<td><?php echo $info['voornaam']." ".$info['achternaam']; ?></td>
					<td>Telefoonnummer</td>
					<td><?php echo $info['telnr']; ?></td>
				</tr>
				<tr>
					<td>Straat en huisnummer</td>
					<td><?php echo $info['straatnaam']; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo $info['postcode']; ?></td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td><?php echo $info['plaats']; ?></td>
				</tr>
				<tr>
					<td>Land</td>
					<td><?php echo ucfirst($info['land']); ?></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Accountinformatie</p>
			<table class="profiletable">
				<tr>
					<td>Gebruikernaam</td>
					<td><?php echo $info['gebruikersnaam'] ?></td>
				</tr>
				<tr>
					<td>E-mail adres</td>
					<td><?php echo $info['email']; ?></td>
					<td><small><a href="../editemail.php">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td>********</td>
					<td><small><a href="../editwachtwoord.php">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Bestanden</p>
			<table class="profiletable">
				<tr>
					<td>Identiteitsbewijs</td>
					<td class="bold"><?php echo $identiteit; ?></td>
				</tr>
				<tr>
					<td>Toestemmingsverklaring</td>
					<td class="bold"><?php echo $toestemming; ?></td>
				</tr>
				<tr>
					<td>DigiD</td>
					<td class="bold"><?php if($info['digid'] == 1) { echo "Ja"; } else { echo "Nee"; } ?></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Rapport</p>
			<table class="rapporttable">
				<tr>
					<td><?php if(!empty($info['rapport'])) { ?><img src="../images/excel.png" style="width:25px;" ><?php } echo $rapport; ?></td>
				</tr>
			</table>
		</div>
		
		<?php include "../footer.php"; ?>

	</div> <!-- /wrapper -->
</div>

</body>
</html>