<?php include "../connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>***Paginatitel**** | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">

	<!-- TABLEFILTER -->
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script src="../js/ddtf.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		$('#filterTable').ddTableFilter();
	});
	</script>

	<!-- DROPZONE -->
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<script src="../js/dropzoneIMG.js"></script>

	<!-- DATEPICKER -->
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script>
	$(function() {
	    $( "#datepicker" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      yearRange: "+0:+5",
	      minDate: "+0Y", maxDate: "+5Y"
	    });
	 });
	 </script>

</head>
<body>

<div id="container">

<!-- Toolbars -->
	<?php //include "toolbar-admin.php"; ?>
	<?php //include "toolbar-bedrijf.php"; ?>
	<?php //include "toolbar-klant.php"; ?>
	<?php include "toolbar-basic.php"; ?>

	<?php $_SESSION['id'] = 1; ?> <!-- OM DEZE PAGINA TE LATEN WERKEN -->

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<p id="breadcrumbs"><a href="#">Parent</a> > <a href="#" class="activepage">Child</a></p>
		<div class="content-block">
			<table class="double-table">
				<tr>
					<th>Overzicht</th>
				</tr>
				<tr>
					<td>Kollomnaam:</td>
					<td>Data</td>
				</tr>
				<tr>
					<td><small><a href="#">Link</a></small></td>
				</tr>
				<tr>
					<td><small><a href="#" class="red">Verwijder link</a></small></td>
				</tr>
				<tr>
					<td><a class="download-link" href="#"><img src="../images/excel.png" width="25px"> Download link</a></td>
				</tr>
			</table>
		</div>
		
		<div class="content-block">
			<p class="content-head">Lijst</p>
			<ul>
				<li><i class='fa fa-check'> Checked</i></li>
				<li><i class='fa fa-empty'> Not checked</i></li>
			</ul>
		</div>

		<div class="screening-list">
			<table id="filterTable" class="profiletable order-table table">
				<thead>
				<tr class="table-header-filter">
					<th class="skip-filter"></th>
					<th class="noskip-filter"><select><option selected disabled>--Opleverperiode--</option></select></th>
					<th class="skip-filter"></th>
					<th class="skip-filter"></th>
					<th class="noskip-filter"><select><option selected disabled>--Rapport--</option></select></th>
					<th class="skip-filter"><form name="filter" id="filter"><input type="text" name="filter" data-table="order-table" class="light-table-filter" placeholder="FILTER"></form></th>
				</tr>
				</thead>
				<tr class="table-header">
					<th class="skip-filter">Naam</th>
					<th class="skip-filter">Opleverperiode</th>
					<th class="skip-filter">Postcode</th>
					<th class="skip-filter">Plaats</th>
					<th class="skip-filter">Rapport</th>
					<th class="skip-filter">Profiel</th>
				</tr>
				
				<tr class="trlink" onclick="document.location ='' "> <!-- Vul de locatie in! -->
					<td>John Smith</td>
					<td>1 januari 0001</td>
					<td>0000 AA</td>
					<td>Amsterdam</td>
					<td class="cursive">In bewerking</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="bold">Settingsform</p>
			<table id="settings-table">
				<tr>
					<td><label for="inputtext">Label for text</label></td>
					<td><input type="text" id="inputtext" name="inputtext"	></td>
				</tr>
				<tr>
					<td><label for="datepicker">Label for datepicker</label></td>
					<td><input type="text" id="datepicker" name="datepicker" required style="margin-bottom: 15px;"></td>
				</tr>
				<tr>
					<td>
						<label for="man"><input style="margin:20px 0 20px 30px;" type="radio" name="radio" id="radio1" value="1"> Radio1</label>
						<label for="vrouw"><input style="margin:20px 0 20px 30px;" type="radio" name="radio" id="radio2" value="2"> Radio2</label>
					</td>
				</tr>
				<tr>
					<td><input type="checkbox" style="margin:20px 0 20px 30px;" id="checkbox" name="checkbox"><label for="checkbox"> Checkbox</label></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<p class="bold">File upload</p>
			<form action="klant-upload-cv.php" class="dropzone">
				<i class="fa font" style="font-size:30px;color:#ccc;">Sleep het bestand hier <br>of klik op dit vlak.</i><br>
			 	<div class="fallback">
			    	<input name="file" type="file" multiple />
			    	<a class="dz-remove">Verwijder bestand</a>
			 	</div><p class="comment">Bestandtypes: ,pdf, doc, docx</p>
			</form>
		</div>


		<div class="content-block" id="pakketform">
			<p class="bold">Pakketselectie</p>
			<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio1" value="1">
			<label class="pakketlabel" for="pakketradio1">
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
			</div></label>

			<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio2" value="2">
			<label class="pakketlabel" for="pakketradio2">
			<div class="pakket-block">
				<i class="fa fa-globe"></i>
				<p>Controle van kandidaat met een buitenlands diploma.</p>
				<ul>
					<li>ID check</li>
					<li>Opleiding</li>
					<li>Werkervaring</li>
					<li>Online onderzoek</li>
					<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
				</ul>
				<h2 class="pakket-prijs">&euro;175</h2>
			</div></label>

			<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio3" value="3">
			<label class="pakketlabel" for="pakketradio3">
			<div class="pakket-block">
				<i class="fa fa-cogs"></i>
				<p>Stel uw eigen Employment Screening samen.</p>
				
				<table>
					<tr>
						<td>
							<input type="checkbox" value="1" id="identiteit" name="identiteit" />
							<label for="identiteit">ID</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" value="1" id="opleiding" name="opleiding" />
							<label for="opleiding">Opleiding</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" value="1" id="ervaring" name="werkervaring" />
							<label for="ervaring">Werkervaring</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" value="1" id="onderzoek" name="onderzoek" />
							<label for="onderzoek">Online onderzoek</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" value="1" id="financieel" name="financieel" />
							<label for="financieel">Financiele situatie en gerechtelijke uitspraken</label>
						</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" value="1" id="vog" name="vog" />
							<label for="vog">Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label>
						</td>
					</tr>
				</table>

				<h2 class="pakket-prijs">&euro;175</h2>
			</div></label>

			<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio4" value="4">
			<label class="pakketlabel" for="pakketradio4">
			<div class="pakket-block">
				<i class="fa fa-star"></i>
				<p>Pakket op maat,<br> speciaal voor u.</p>
				<ul>
					<li>ID check</li>
					<li>Opleiding</li>
					<li>Werkervaring</li>
					<li>Online onderzoek</li>
					<li>Financiele situatie en gerechtelijke uitspraken</li>
					<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
				</ul>
				<h2 class="pakket-prijs">&euro;175</h2>
			</div></label>

			<br class="clear-float">
			
		</div>

		<form id="settings-form">
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Submit"><input type="submit" onclick="location.href=''" id="cancel" name="cancel" value="Cancel"></div>
		</form>

		<?php include "../footer.php"; ?>

	</div>
</div>
</body>
</html>