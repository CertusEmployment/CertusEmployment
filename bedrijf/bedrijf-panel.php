<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beheerderspaneel</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>
</head>
<body>

<div id="container">
	
<?php 

include "toolbar-bedrijf.php";


$query_bedrijf = "SELECT * FROM bedrijf WHERE id =  ".$_SESSION['id']." ";
$result = mysql_query($query_bedrijf);

$query_klant = "SELECT * FROM klant WHERE bedrijfid = ".$_SESSION['id']." ";
$result_klant = mysql_query($query_klant);

?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
<?php while ($row = mysql_fetch_array($result)) { ?>
		<div class="content-block">
			<table class="profiletable">
			
				<tr>
					<th collspan="2">Bedrijfs informatie</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td><?php echo $row['bedrijfnaam']; ?></td>
					<td>Telefoon nummer</td>
					<td><?php echo $row['telnr_contact']; ?></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo ucfirst($row['straatnaam'])." ".$row['huisnummer'].$row['huistoevoeging']; ?></td>
				</tr>
				<tr>
					<td>Postcode en woonplaats</td>
					<td><?php echo chunk_split(strtoupper($row['postcode']), 4, " ") ." ". $row['plaats']; ?>
				</tr>

			</table>
		</div>

		<div class="content-block">
			<table class="profiletable">
				<tr>
					<td>Gebruikersnaam</td>
					<td><?php echo $row['gebruikersnaam']; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $row['email_contact']; ?></td>
					<td><small><a href="../editemail.php?table=bedrijf	&id=<?php echo $row['id']; ?>">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td><?php echo (($row['wachtwoord'])=='')? '<i>No password</i>' : '&#8226;&#8226;&#8226;&#8226;' ; ?></td>
					<td><small><a href="../editwachtwoord.php?table=bedrijf	&id=<?php echo $row['id']; ?>">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
		</div>
<?php } ?>
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
					<th>Opleverdatum</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Rapport beschikbaar</th>
					<th>Profiel</th>
				</tr>
				</thead>	
				<?php while ($row = mysql_fetch_array($result_klant)) { ?>
					<tr>
						<td><?php echo ucfirst($row['voornaam'])." ".ucfirst($row['achternaam']); ?></td>
						<td><?php echo date('d F Y', strtotime($row['opleverdatum'])); ?></td>
						<td><?php echo chunk_split(strtoupper($row['postcode']),4," "); ?></td>
						<td><?php echo ucfirst($row['plaats']); ?></td>
						<td class="cursive"><?php if(empty($row['rapport'])) echo "In afwachting"; else echo "Rapport beschikbaar"; ?></td>
						<td class="cursive"><a href="../admin/admin-kandidaatprofiel.php?id=<?php echo $row['id']; ?>">link</a></td>
					</tr>
				<?php } ?>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div>
</div>
</body>
</html>