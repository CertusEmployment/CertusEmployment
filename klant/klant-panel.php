<!DOCTYPE html>
<html>
<head>
	<title>Uw overzicht</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">

	<?php 

	include "toolbar-klant.php";

	$sql = "SELECT * FROM klant WHERE id=".$_SESSION['id']."";
	$result = mysql_query($sql);
	$info = mysql_fetch_assoc($result);

	if(!empty($info['identiteit'])) {
		$identiteit = "<a href='#'>Download</a>";
	} else {
		$identiteit = "ID niet goed leesbaar of ongeschikt. <a href='klant-upload.php'>Upload hier</a>";
	}

	if(!empty($info['toestemming'])) {
		$toestemming = "<a href='#'>Download</a>";
	}

	if(!empty($info['rapport'])) {
		$rapport = "<a href='#'>Download</a>";
	} else {
		$rapport = "Rapport nog niet beschikbaar";
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
					<td><?php echo ucfirst($row['land']); ?></td>
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
					<td class="wideCell"><?php echo $rapport; ?></td>
				</tr>
			</table>
		</div>
		
		<?php include "../footer.php"; ?>

	</div> <!-- /wrapper -->
</div>

</body>
</html>