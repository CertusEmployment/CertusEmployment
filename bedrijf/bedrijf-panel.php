<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beheerderspaneel</title>
	<?php include "../connect.php"; ?>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<?php

/**
Pak ID vanuit login window
**/

$_GET['id'] = (empty($_GET['id'])) ? 1 : $_GET['id'] ;

$query = "SELECT b.bedrijfnaam, b.id, b.straatnaam, b.huisnummer, b.huistoevoeging, b.postcode as 'postcode_bedrijf', b.plaats as 'plaats_bedrijf', b.vn_contact, b.an_contact, b.telnr as 'telbedrijf', b.gebruikersnaam as 'gebruikersnaam_bedrijf', b.email_contact, b.wachtwoord as 'wacthwoord_bedrijf',k.id as 'id_klant', k.voornaam, k.tussenvoegsel, k.achternaam, k.postcode as 'postcode_klant', k.plaats as 'plaats_klant', k.rapport, opleverdatum  FROM bedrijf b, klant k WHERE b.id = k.bedrijfid  and b.id = '".$_GET['id']."'";
$result = mysql_query($query);

?>

<div id="container">
	
	<?php include "toolbar-bedrijf.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<div class="content-block">
			<table class="profiletable">
			<?php while ($row = mysql_fetch_array($result)) { ?>
				<tr>
					<th collspan="2">Bedrijfs informatie</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td><?php echo $row['bedrijfnaam']; ?></td>
					<td>Telefoon nummer</td>
					<td><?php echo $row['telbedrijf']; ?></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo ucfirst($row['straatnaam'])." ".$row['huisnummer'].$row['huistoevoeging']; ?></td>
				</tr>
				<tr>
					<td>Postcode en woonplaats</td>
					<td><?php echo chunk_split(strtoupper($row['postcode_bedrijf']), 4, " ") ." ". $row['plaats_bedrijf']; ?>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<table>
				<tr><th collspan="2">Account informatie</th></tr>
				<tr>
					<td collspan="2">Gebruikersnaam</td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><small><a href="#">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td><small><a href="#">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
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
					<option>2014</option>
					<option>2013</option>
					<option>2012</option>
					<option>2011</option>
					<option>2010</option>
					<option>2009</option>
				</select>

				<input type="text" name="filter" data-table="order-table" class="light-table-filter" placeholder="FILTER">
			</form>
			<table class="profiletable order-table table">
				<thead>
				<tr class="table-header">
					<th>Naam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Rapport beschikbaar</th>
					<th>Profiel</th>
				</tr>
				</thead>	
					<tr>
						<td><?php echo ucfirst($row['voornaam'])." ".ucfirst($row['achternaam']); ?></td>
						<td><?php echo date('d F Y', strtotime($row['opleverdatum'])); ?></td>
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

	</div>
</div>
</body>
</html>