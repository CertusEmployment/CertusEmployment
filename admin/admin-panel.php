<?php

include "../connect.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>

</head>
<body>

<div id="container">
	<?php
	include "toolbar-admin.php"; 
	$query_admin = "SELECT * FROM admin WHERE id = ".$_SESSION['id']." ";
	$result_admin = mysql_query($query_admin);

	$query_bedrijf = "SELECT * FROM bedrijf";
	$result_bedrijf = mysql_query($query_bedrijf);

	$recentquery = "SELECT k.id, k.voornaam, k.achternaam, b.bedrijfnaam, k.aanmaakdatum FROM klant k, bedrijf b WHERE k.bedrijfid=b.id ORDER BY aanmaakdatum DESC LIMIT 0,4";
	$recentresult = mysql_query($recentquery);
	?>

		<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<div class="content-block">
			<table class="profiletable">
				<tr><th collspan="2">Account informatie</th></tr>
				<?php while ($row = mysql_fetch_assoc($result_admin)) { ?>
					<tr>
						<td>Gebruikersnaam</td>
						<td><?php echo $row['gebruikersnaam']; ?></td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td><?php echo $row['email']; ?></td>
						<td><small><a href="../editemail.php?table=admin&id=<?php echo $row['id']; ?>">E-mail wijzigen</a></small></td>
					</tr>
					<tr>
						<td>Wachtwoord</td>
						<td><?php echo (($row['wachtwoord'])=='')? '<i>No password</i>' : '&#8226;&#8226;&#8226;&#8226;' ; ?></td>
						<td><small><a href="../editwachtwoord.php?table=admin&id=<?php echo $row['id']; ?>">Wachtwoord wijzigen</a></small></td>
					</tr>
					<?php
						}
					?>
			</table>
		</div>

		<div class="content-block">
			<table class="profiletable">
				<tr><th collspan="4">Recente screenings</th></tr>
				<?php
					while ($recentrow = mysql_fetch_array($recentresult)) {
						$date1 = new DateTime(date('d-m-Y', strtotime($recentrow['aanmaakdatum']))); //aanmaakdatum
						$date2 = new DateTime(date('d-m-Y')); //huidige datum
						if ($date1 <= $date2) {
						?>
						<tr>
							<td><?php echo ucfirst($recentrow['voornaam'])." ".ucfirst($recentrow['achternaam']); ?></td>
							<td><?php echo $recentrow['bedrijfnaam']; ?></td>

							<!-- Verschil tussen de aanmaakdatum en de huidige datum in dagen -->
							<?php 
								if($date1->diff($date2)->days == 0) { ?> <td>Vandaag</td> <?php } //Screening vandaag aangemaakt
								elseif ($date1->diff($date2)->days == 1) { ?> <td>Gisteren</td> <?php } //Screening gisteren aangemaakt
								else { ?><td><?php echo $date1->diff($date2)->days." dagen geleden"; ?></td> <?php } //Screening ouder dan gisteren
							?>
							<td class="cursive"><a href="admin-kandidaatprofiel.php?id=<?php echo $recentrow['id'] ;?>">link</a></td>
						</tr>
					<?php
					} //ENDIF
				} //ENDWHILE
				?>
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
			<table  class="profiletable order-table table">
				<thead>
				<tr class="table-header">
					<th>Bedrijfsnaam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Lopende screenings</th>
					<th>Profiel</th>
				</tr>
				</thead>
				<?php

				while ($row = mysql_fetch_array($result_bedrijf)) {
					?>
					<tr>
						<td><?php echo $row['bedrijfnaam']; ?></td>
						<td><?php echo $row['vn_contact']." ".$row['an_contact']; ?></td>
						<td><?php echo chunk_split(strtoupper($row['postcode']), 4, " "); ?></td>
						<td><?php echo $row['plaats']; ?></td>
						<td>wait for it</td>
						<td><a href="admin-bedrijfsprofiel.php?id=<?php echo $row['id']; ?>">link</a></td>
					</tr>
					<?php
				}	//ENDWHILE

				?>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div>
</div>
</body>
</html>