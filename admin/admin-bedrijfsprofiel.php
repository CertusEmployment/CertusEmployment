<?php

$_GET['id'] = (empty($_GET['id'])) ? 1 : $_GET['id'] ;

include "../connect.php";

$query = "SELECT b.bedrijfnaam, b.id, b.straatnaam, b.huisnummer, b.huistoevoeging, b.postcode as 'postcode_bedrijf', b.plaats as 'plaats_bedrijf', b.vn_contact, b.an_contact, b.telnr as 'telbedrijf', b.gebruikersnaam as 'gebruikersnaam_bedrijf', b.email_contact, b.wachtwoord as 'wacthwoord_bedrijf',k.id as 'id_klant', k.voornaam, k.tussenvoegsel, k.achternaam, k.postcode as 'postcode_klant', k.plaats as 'plaats_klant', k.rapport  FROM bedrijf b, klant k WHERE b.id = k.bedrijfid  and b.id = '".$_GET['id']."'";
$result = mysql_query($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Overzicht bedrijven</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">

	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="#" class="activepage">Bedrijfsprofiel</a></p>

		<div class="content-block">
			<table class="profiletable">
			<?php
			while ($row = mysql_fetch_array($result)) {
				?>
				<tr>
					<th>Bedrijfsgegevens</th>
					<th></th>
					<th>Accountgegevens</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td><?php echo $row['bedrijfnaam']; ?></td>
					<td>Gebruikersnaam</td>
					<td><?php echo $row['gebruikersnaam_bedrijf']; ?></td>
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
					<td><?php echo $row['wacthwoord_bedrijf']; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo chunk_split(strtoupper($row['postcode_bedrijf']), 4, " "); ?></td>
				</tr>
				<tr>
					<td>Plaats</td>
					<td><?php echo ucfirst($row['plaats_bedrijf']); ?></td>
				</tr>
				<tr>
					<td>Contactpersoon</td>
					<td><?php echo ucfirst($row['vn_contact'])." ".ucfirst($row['an_contact']); ?></td>
				</tr>
				<tr>
					<td>Telefoonnummer</td>
					<td><?php echo $row['telbedrijf']; ?></td>
					<td><small><a href="#">Gegevens wijzigen</a></small></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<th colspan="2"><a class="download-link" href=""><img src="../images/excel.png" width="25px"> Download maandoverzicht - Maart 2014</a></th>
				</tr> 
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Maatwerkpakket</p>
			<ul>
				<li><i class="fa fa-check"> ID check</i></li>
				<li><i class="fa fa-empty"> Werkervaring</i></li>
				<li><i class="fa fa-check"> Opleiding</i></li>
				<li><i class="fa fa-empty"> Financiele situatie en gerechtelijke uitspraken</i></li>
				<li><i class="fa fa-check"> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</i></li>
			</ul>
		</div>

		<div class="screening-list">
			<form name="filter" id="filter">
				<select>
					<option>januari</option>
					<option>februari</option>
					<option>maart</option>
					<option>april</option>
					<option>mei</option>
					<option>juni</option>
					<option>juli</option>
					<option>augustus</option>
					<option>september</option>
					<option>oktober</option>
					<option>november</option>
					<option>december</option>
				</select>

				<select>
					<option>2009</option>
					<option>2010</option>
					<option>2011</option>
					<option>2012</option>
					<option>2013</option>
					<option>2014</option>
				</select>

				<input type="text" name="filter" placeholder="FILTER">
			</form>
			<table class="profiletable">
				<tr class="table-header">
					<th>Naam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Rapport beschikbaar</th>
					<th>Profiel</th>
				</tr>
				<!-- <tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr> -->
	
					<tr>
						<td><?php echo ucfirst($row['voornaam'])." ".ucfirst($row['achternaam']); ?></td>
						<td><?php echo ucfirst($row['vn_contact'])." ".ucfirst($row['an_contact']); ?></td>
						<td><?php echo chunk_split(strtoupper($row['postcode_klant']),4," "); ?></td>
						<td><?php echo ucfirst($row['plaats_klant']); ?></td>
						<td class="cursive"><?php if(empty($row['rapport'])) echo "In afwachting"; else echo "Rapport beschikbaar"; ?></td>
						<td class="cursive"><a href="admin-kandidaatprofiel.php?id=<?php echo $row['id_klant']; ?>">link</a></td>
					</tr>
					<?php
				}  //ENDWHILE
				?>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>