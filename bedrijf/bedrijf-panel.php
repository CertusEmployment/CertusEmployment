<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Beheerderspaneel</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">
	
	<?php include "toolbar-bedrijf.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<div class="content-block">
			<table class="double-table">
				<tr><th collspan="2">Bedrijfs informatie</th></tr>
				<tr><td>Bedrijfsnaam</td><td>Telefoon nummer</td></tr>
				<tr><td>Adres</td><td>Mobiel nummer</td></tr>
				<tr><td>Postcode en woonplaats</td></tr>
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
					<th>Volledige naam</th>
					<th>Geboortedatum</th>
					<th>Woonplaats</th>
					<th>Screening datum</th>
					<th>Rapport beschikbaar</th>
					<th>Profiel</th>
				</tr>
				<tr>
					<td>Jo Bonten</td>
					<td>12-12-1980</td>
					<td>Utrecht</td>
					<td>01-04-2014</td>
					<td>Nee</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Rob Hummelink</td>
					<td>14-08-1990</td>
					<td>Amsterdam</td>
					<td>Gisteren</td>
					<td>Nee</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Roy Donders</td>
					<td>19-11-1976</td>
					<td>Rotterdam</td>
					<td>15-01-2014</td>
					<td>Ja</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div>
</div>
</body>
</html>