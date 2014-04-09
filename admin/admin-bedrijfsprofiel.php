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

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#" class="activepage">Bedrijfsprofiel</a></p>

		<div class="content-block">
			<table>
				<tr>
					<th>Bedrijfsgegevens</th>
					<th></th>
					<th>Accountgegevens</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td></td>
					<td>Gebruikersnaam</td>
				</tr>
				<tr>
					<td>Klantnummer</td>
					<td></td>
					<td>E-mail</td>
				</tr>
				<tr>
					<td>Adres</td>
					<td></td>
					<td>Wachtwoord</td>
				</tr>
				<tr>
					<td>Postcode en woonplaats</td>
				</tr>
				<tr>
					<td>Contactpersoon</td>
				</tr>
				<tr>
					<td>Telefoonnummer</td>
					<td></td>
					<td><small><a href="#">Gegevens wijzigen</a></small></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<th colspan="2"><a class="download-link" href=""><img src="../images/excel.png" width="25px"> Download maandoverzicht</a></th>
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
			<table>
				<tr class="table-header">
					<th>Naam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Rapport beschikbaar</th>
					<th>Profiel</th>
				</tr>
				<tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Daan Blauw</td>
					<td>Eric Groen</td>
					<td>4028 ES</td>
					<td>Enchede</td>
					<td class="cursive">In afwachting</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
			</table>
		</div>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>