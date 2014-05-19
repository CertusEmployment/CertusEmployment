<?php

//$_GET['id'] = (empty($_GET['id'])) ? 1 : $_GET['id'] ;

include "../connect.php";

session_start();

$bedrijfquery = "SELECT * FROM bedrijf WHERE id=".$_SESSION['bedrijfid']."";
$bedrijfresult = mysql_query($bedrijfquery);
$tablequery = "SELECT * FROM klant WHERE bedrijfid=".$_SESSION['bedrijfid']."";
$tableresult = mysql_query($tablequery);
$maatwerkquery = "SELECT * FROM maatwerk WHERE id=".$_SESSION['bedrijfid']."";
$maatwerkresult = mysql_query($maatwerkquery);
$pakket = mysql_fetch_assoc($maatwerkresult);

if(isset($_GET['klantid'])) {
	$_SESSION['klantid'] = $_GET['klantid'];
	header('location: admin-kandidaatprofiel.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Overzicht bedrijven</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script src="../js/ddtf.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		$('#myTable').ddTableFilter();
	});
	</script>
</head>
<body>

<div id="container">

	<?php include "toolbar-admin.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="#" class="activepage">Bedrijfsprofiel</a></p>

		<div class="content-block">
			<table class="profiletable">
			<?php
			while ($row = mysql_fetch_array($bedrijfresult)) {
				?>
				<tr>
					<th colspan="2">Bedrijfsgegevens</th>
					<th>Accountgegevens</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td><?php echo $row['bedrijfnaam']; ?></td>
					<td>Gebruikersnaam</td>
					<td><?php echo $row['gebruikersnaam']; ?></td>
				</tr>
				<tr>
					<td>Klantnummer</td>
					<td><?php echo $row['id']; ?></td>
					<td>E-mail</td>
					<td><a href="mailto:<?php echo $row['email_contact']; ?>"><?php echo $row['email_contact']; ?></a></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo ucfirst($row['straatnaam'])." ".$row['huisnummer'].$row['huistoevoeging']; ?></td>
					<td>Wachtwoord</td>
					<td><?php echo (($row['wachtwoord'])=='')? '<i>No password</i>' : '&#8226;&#8226;&#8226;&#8226;' ; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo (strlen($row['postcode'])==6)? chunk_split(strtoupper($row['postcode']), 4, " ") : $row['postcode'] ; ?></td>
				</tr>
				<tr>
					<td>Plaats</td>
					<td><?php echo ucfirst($row['plaats']); ?></td>
				</tr>
				<tr>
					<td>Plaats</td>
					<td><?php echo ucfirst($row['land']); ?></td>
				</tr>
				<tr>
					<td>Contactpersoon</td>
					<td><?php echo ucfirst($row['vn_contact'])." ".ucfirst($row['an_contact']); ?></td>
				</tr>
				<tr>
					<td>Telefoonnummer</td>
					<td><?php echo $row['telnr_contact']; ?></td>
					<td><small><a href="admin-editklant.php?id=<?php echo $row['id']; ?>">Gegevens wijzigen</a></small></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<th colspan="2"><a class="download-link" href=""><img src="../images/excel.png" width="25px"> Download maandoverzicht - Maart 2014</a></th>
				</tr> 
				<?php } //ENDWHILE ?>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Maatwerkpakket</p>
			<ul>
				<li><?php if($pakket['idcheck'] == 1){ echo "<i class='fa fa-check'>"; } else { echo "<i class='fa fa-empty'>"; }?> ID check</i></li>
				<li><?php if($pakket['werkervaring'] == 1) { echo "<i class='fa fa-check'>"; } else { echo "<i class='fa fa-empty'>"; }?> Werkervaring</i></li>
				<li><?php if($pakket['opleiding'] == 1) { echo "<i class='fa fa-check'>"; } else { echo "<i class='fa fa-empty'>"; }?> Opleiding</i></li>
				<li><?php if($pakket['financieel'] == 1) { echo "<i class='fa fa-check'>"; } else { echo "<i class='fa fa-empty'>"; }?> Financiele situatie en gerechtelijke uitspraken</i></li>
				<li><?php if($pakket['vog'] == 1) { echo "<i class='fa fa-check'>"; } else { echo "<i class='fa fa-empty'>"; }?> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</i></li>
			</ul>
		</div>

		<div class="screening-list">
			<table id="myTable" class="profiletable order-table table">
				<thead>
				<tr class="table-header-filter">
					<th class="skip-filter"></th>
					<th class="noskip-filter">Periode</th>
					<th class="skip-filter"></th>
					<th class="skip-filter"></th>
					<th class="noskip-filter">Rapport</th>
					<th class="skip-filter"><form name="filter" id="filter"><input type="text" name="filter" data-table="order-table" class="light-table-filter" placeholder="FILTER"></form></th>
				</tr>
				</thead>
				<tr class="table-header">
					<th class="skip-filter">Naam</th>
					<th class="skip-filter">Periode</th>
					<th class="skip-filter">Postcode</th>
					<th class="skip-filter">Plaats</th>
					<th class="skip-filter">Rapport</th>
					<th class="skip-filter">Profiel</th>
				</tr>
				
				<?php while ($row=mysql_fetch_array($tableresult)) { 
					$rapport = (empty($row['rapport'])) ? "In bewerking" : "Rapport beschikbaar"; ?>
					<tr class="trlink" onclick="document.location = 'admin-bedrijfsprofiel.php?klantid=<?php echo $row['id']; ?>';">
						<td><?php echo ucfirst($row['voornaam'])." ".ucfirst($row['achternaam']); ?></td>
						<td><?php echo date('M Y', strtotime($row['aanmaakdatum'])); ?></td>
						<td><?php echo chunk_split(strtoupper($row['postcode']),4," "); ?></td>
						<td><?php echo ucfirst($row['plaats']); ?></td>
						<td class="cursive"><?php echo $rapport; ?></td>
						<td class="cursive"><a href="admin-bedrijfsprofiel.php?klantid=<?php echo $row['id']; ?>">link</a></td>
					</tr>
					<?php
				 } //ENDWHILE
				?>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>
</body>
</html>