<!DOCTYPE html>
<html>
<head>
	<title>Controle pagina</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">



</head>
<body>

<div id="container">
	
	<?php include "../toolbar-bedrijf.php"; ?>
	<form id="settings-form" method="post" action="#">
	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs">Overzicht > Kandidaat informatie > Pakket keuze > <a href="#">Controlepagina</a></p>
		<div class="content-block">
			<table class="double-table">
				<tr><th collspan="2">Controlepagina</th></tr>
				<tr>
					<td>Dhr/Mvr. Volledige naam</td>
					<td>Telefoon nummer</td>
				</tr>
				<tr>
					<td>Adres</td>
					<td>E-mail adres</td>
				</tr>
				<tr><td>Postcode en woonplaats</td></tr>
				<tr>
					<td>Geboorteplaats</td>
					<td class="bold"><i class="fa fa-download"></i><a class="color-reset" href="#">CV.docx</a></td>
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