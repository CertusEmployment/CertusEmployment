<!DOCTYPE html>
<html>
<head>
	<title>Pakket selectie</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script> 
	<!--<script src="../js/dropzone.min.js"></script> -->
</head>
<body>

<div id="container">

	<?php include "../toolbar-bedrijf.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Kandidaat informatie</a> > <a href="#" class="activepage">Pakket keuze</a></p>
		<form id="settings-form" method="post" action="#">
			<div class="content-block">
				<p class="content-head">Opleverdatum</p>
				<p class="comment cursive">Vul hieronder de gewenste opleverdatum in.</p>
				<input type="text" name="leverdatum" placeholder="00-00-0000" style="margin-bottom: 15px;">
			</div>

			<div class="content-block">
				<p class="content-head">Pakket keuze</p>
				<p class="comment cursive">Selecteer hieronder een screenings pakket.
					Hou hierbij rekening met de verschillende diensten per pakket.</p>

				<div class="pakket-block">
					<i class="fa fa-users"></i>
					<p>Volledige employment screening op alle onderdelen</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Financiele situatie en gerechtelijke uitspraken</li>
						<li>Verklaring Omtrent Gedrag &amp Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div>

				<div class="pakket-block">
					<i class="fa fa-globe"></i>
					<p>Controle van een kandidaat met een buitenlands diploma.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Verklaring Omtrent Gedrag &amp Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div>

				<div class="pakket-block">
					<i class="fa fa-cogs"></i>
					<p>Stel uw eigen Employment Screening samen.</p>
					
					<table>
						<tr>
							<td>
								<input type="checkbox" id="id" name="id" />
								<label for="id">ID</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" id="opleiding" name="opleiding" />
								<label for="opleiding">Opleiding</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" id="ervaring" name="ervaring" />
								<label for="ervaring">Werkervaring</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" id="onderzoek" name="onderzoek" />
								<label for="onderzoek">Online onderzoek</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" id="financieel" name="financieel" />
								<label for="financieel">Financiele situatie en gerechtelijke uitspraken</label>
							</td>
						<tr>
							<td>
								<input type="checkbox" id="vog" name="vog" />
								<label for="vog">Verklaring Omtrent Gedrag &amp Integriteitsverklaring</label>
							</td>
						</tr>
					</table>

					<h2 class="pakket-prijs">&euro;175</h2>
				</div>

				<div class="pakket-block">
					<i class="fa fa-star"></i>
					<p>Pakket op maat, speciaal voor u.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Verklaring Omtrent Gedrag &amp Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div>

				<br class="clear-float">

			</div>

			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>