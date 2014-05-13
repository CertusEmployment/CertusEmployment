<!DOCTYPE html>
<html>
<head>
	<title>Controle pagina</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">



</head>
<body>

<div id="container">
	
	<?php include "toolbar-bedrijf.php"; ?>
	<form id="settings-form" method="post" action="#">
	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Kandidaat informatie</a> > <a href="#">Pakket keuze</a> > <a href="#" class="activepage">Controlepagina</a></p>
		<div class="content-block">
			<table class="double-table">
				<tr><th collspan="2">Controlepagina</th></tr>
				<tr>
					<td>Naam</td>
					<td>Dhr. Roy Thuis</td>
					<td>Telefoon nummer</td>
					<td>06123456789</td>
				</tr>
				<tr>
					<td>Adres</td>
					<td>Lekstraat 18</td>
					<td>E-mail adres</td>
					<td>roythuis1994@hotmail.com</td>
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
					<td>Geboortedatum</td>
					<td>05-07-1994</td>
				</tr>
				<tr>
					<td>Geboorteplaats</td>
					<td>Doetinchem</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td class="bold"><i class="fa fa-download"></i><a class="color-reset download-link" href="#">CV.docx</a></td>
				</tr>
				<tr><td><small><a href="#">Gegevens wijzigen</a></small></td></tr>
			</table>
		</div>

		<div class="content-block">
			<table>
				<tr><th>Screening informatie</th></tr>
				<tr><td>Opleverdatum</td></tr>
				<tr><td>Pakketkeuze</td></tr>
				<tr><td><small><a href="#">Gegevens wijzigen</a></small></td></tr>
			</table>
		</div>

		<input type="submit" id="next" name="submit" value="Opslaan">
		</form>

		<?php include "../footer.php"; ?>

	</div>
</div>
</body>
</html>