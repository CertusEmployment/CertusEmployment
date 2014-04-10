<!DOCTYPE html>
<html>
<head>
	<title>Informatievoorziening</title>

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

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#" class="activepage">Kandidaat informatie</a></p>
		<form id="settings-form" method="post" action="#">
			<div class="content-block">
				<p class="content-head">Persoonlijke informatie</p>
				<p class="comment cursive">Vul hieronder de persoonlijke informatie in van de kandidaat.</p>
				<table id="settings-table">
					<tr>
						<td><label for="voornaam">Voornaam</label></td>
						<td><label for="achternaam">Achternaam</label></td>
					</tr>
					<tr>
						<td><input type="text" id="voornaam"></td>
						<td><input type="text" id="achternaam"></td>
					</tr>
					<tr>
						<td><label for="man"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="man" value="man"> Man</label> <label for="vrouw"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="vrouw" value="vrouw"> Vrouw</label></td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Huisnummer</label></td>
					</tr>
					<tr>
						<td><input type="text" id="straat"></td>
						<td><input type="text" id="huisnr" style="width:100px;" ></td>
					</tr>
					<tr>
						<td><label for="postcode">Postcode</label></td>
						<td><label for="plaats">Woonplaats</label></td>
					</tr>
					<tr>
						<td><input type="text" id="postcode" placeholder="0000AA"></td>
						<td><input type="text" id="plaats"></td>
					</tr>
					<tr>
						<td><label for="geboortedatum">Geboortedatum</label></td>
						<td><label for="geboorteplaats">Geboorteplaats</label></td>
					</tr>
					<tr>
						<td><input type="text" id="geboortedatum"></td>
						<td><input type="text" id="geboorteplaats"></td>
					</tr>
				</table>
				<!--
				<div class="form-div">
					<label for="voornaam">Voornaam</label><br>
					<input type="text" id="voornaam" />
				</div>

				<div class="form-div">
					<label for="voornaam">Achternaam</label><br>
					<input type="text" id="voornaam" />
				</div>

				<div class="radio-div">
				-->
			</div>

			<div class="content-block">
				<p class="content-head">Extra informatie</p>
				<table id="settings-table">
					<tr>
						<td><label for="telnr">Telefoonnummer</label></td>
						<td><label for="mail">E-mailadres</label></td>
					</tr>
					<tr>
						<td><input type="text" id="telnr"></td>
						<td><input type="text" id="mail"></td>
					</tr>
				</table>
			</div>

			<input type="submit" id="next" name="submit" value="Opslaan">
		</form>

		<?php include "../footer.php"; ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>