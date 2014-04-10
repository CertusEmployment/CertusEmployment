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
			<table class="profiletable">
				<tr>
					<th>Bedrijfsgegevens</th>
					<th></th>
					<th>Accountgegevens</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td>Uitzendbureau B.V.</td>
					<td>Gebruikersnaam</td>
					<td>uitzendbureau</td>
				</tr>
				<tr>
					<td>Klantnummer</td>
					<td>2385</td>
					<td>E-mail</td>
					<td>info@uitzenbureau.nl</td>
				</tr>
				<tr>
					<td>Adres</td>
					<td>Industrieweg 9</td>
					<td>Wachtwoord</td>
					<td>******</td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td>6000 CC</td>
				</tr>
				<tr>
					<td>Plaats</td>
					<td>Utrecht</td>
				</tr>
				<tr>
					<td>Contactpersoon</td>
					<td>Peter Jansen</td>
				</tr>
				<tr>
					<td>Telefoonnummer</td>
					<td>026123456</td>
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