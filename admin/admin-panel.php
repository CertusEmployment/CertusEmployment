<?php

include "../connect.php";

$query_admin = "SELECT * FROM admin";
$result_admin = mysql_query($query_admin);

$query_bedrijf = "SELECT * FROM bedrijf";
$result_bedrijf = mysql_query($query_bedrijf);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>

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

		<div class="content-block">
			<table class="profiletable">
				<tr><th collspan="2">Account informatie</th></tr>
				<?php
				while ($row = mysql_fetch_array($result_admin)) {
					?>
					<tr>
						<td>Gebruikersnaam</td>
						<td><?php echo $row['gebruikersnaam']; ?></td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td><?php echo $row['email']; ?></td>
						<td><small><a href="#">E-mail wijzigen</a></small></td>
					</tr>
					<tr>
						<td>Wachtwoord</td>
						<td><?php echo $row['wachtwoord']; ?></td>
						<td><small><a href="#">Wachtwoord wijzigen</a></small></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>

		<div class="content-block">
			<table>
				<tr><th collspan="4">Recente screenings</th></tr>
				<tr>
					<td>Jos Dubben</td>
					<td>Randstad</td>
					<td>vandaag</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Jo Bonten</td>
					<td>Olympia</td>
					<td>Gisteren</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Roy Donders</td>
					<td>Start People</td>
					<td>20-02-2014</td>
					<td class="cursive"><a href="#">link</a></td>
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
					<option>2009</option>
					<option>2010</option>
					<option>2011</option>
					<option>2012</option>
					<option>2013</option>
					<option>2014</option>
				</select>

				<input type="text" name="filter" placeholder="FILTER">
			</form>
			<table  class="profiletable">
				<tr class="table-header">
					<th>Bedrijfsnaam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Lopende screenings</th>
					<th>Profiel</th>
				</tr>
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