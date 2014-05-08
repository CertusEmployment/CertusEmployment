<!DOCTYPE html>
<html>
<head>
	<title>Uw overzicht</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">

	<?php include "toolbar-klant.php"; ?>

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
					<td>Roy Thuis</td>
					<td>Telefoonnummer</td>
					<td>0315123456</td>
				</tr>
				<tr>
					<td>Straat en huisnummer</td>
					<td>Lekstraat 18</td>
					<td>Mobielnummer</td>
					<td>06123456789</td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td>7071 VB</td>
				</tr>
				<tr>
					<td>Woonplaats</td>
					<td>Ulft</td>
				</tr>
				<tr>
					<td>Land</td>
					<td>Nederland</td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Accountinformatie</p>
			<table class="profiletable">
				<tr>
					<td>Gebruikernaam</td>
					<td>roy.thuis</td>
				</tr>
				<tr>
					<td>E-mail adres</td>
					<td>roythuis1994@hotmail.com</td>
					<td><small><a href="#">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td>********</td>
					<td><small><a href="#">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Bestanden</p>
			<table class="profiletable">
				<tr>
					<td>Identiteitsbewijs</td>
					<td class="bold">ID.jpg</td>
				</tr>
				<tr>
					<td>Toestemmingsverklaring</td>
					<td class="bold">Toestemming.docx</td>
				</tr>
				<tr>
					<td>DigiD</td>
					<td class="bold">Ja</td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="content-head">Rapport</p>
			<table class="rapporttable">
				<tr>
					<td class="wideCell">Screeningrapport beschikbaar!</td>
					<td class="bold">Rapport.pdf</td>
					<td> <button class="download-btn">Download</button>
				</tr>
			</table>
		</div>
		
		<?php include "../footer.php"; ?>

	</div> <!-- /wrapper -->
</div>

</body>
</html>