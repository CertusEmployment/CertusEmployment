<?php
session_start();
include "../connect.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pakket selectie</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
</head>
<body>
<?php
$posting=false;

if(!isset($_POST['submit'])) {
	$posting = false;

} else {
	$posting=true;
	$_SESSION['opleverdatum'] = date('Y-m-d',strtotime($_POST['leverdatum']));

	if($posting) {
		header("Location: bedrijf-controlepagina.php");
	} else {
		$posting=false;
	}
}

if (!$posting) {
?>
<div id="container">

	<?php include "toolbar-bedrijf.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="bedrijf-addkandidaat.php">Kandidaat informatie</a> > <a href="#" class="activepage">Pakketselectie</a></p>	
		<form id="settings-form" method="post">
			<div class="content-block">
				<p class="content-head">Opleverdatum</p>
				<p class="comment cursive">Vul hieronder de gewenste opleverdatum in.</p>
				<input type="text" name="leverdatum" placeholder="00-00-0000" required style="margin-bottom: 15px;">
			</div>

			<div class="content-block">
				<p class="content-head">Pakket keuze</p>
				<p class="comment cursive">Selecteer hieronder een screenings pakket.
					Hou hierbij rekening met de verschillende diensten per pakket.</p>

				<a class="pakket-link" href="1">
					<div class="pakket-block">
					<i class="fa fa-users"></i>
					<p>Volledige employment screening op alle onderdelen</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Financiele situatie en gerechtelijke uitspraken</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></a>

				<a class="pakket-link" href="2">
				<div class="pakket-block">
					<i class="fa fa-globe"></i>
					<p>Controle van een kandidaat met een buitenlands diploma.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></a>

				<a class="pakket-link" href="3">
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
						</tr>
						<tr>
							<td>
								<input type="checkbox" id="vog" name="vog" />
								<label for="vog">Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label>
							</td>
						</tr>
					</table>

					<h2 class="pakket-prijs">&euro;175</h2>
				</div></a>

				<a class="pakket-link" href="4">
				<div class="pakket-block">
					<i class="fa fa-star"></i>
					<p>Pakket op maat, speciaal voor u.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Financiele situatie en gerechtelijke uitspraken</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></a>

				<br class="clear-float">

			</div>

			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>

		<?php include "../footer.php"; ?>
		<?php } //close if ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>