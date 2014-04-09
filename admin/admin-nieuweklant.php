<!DOCTYPE html>
<html>
<head>
	<title>Nieuwe klant</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">

	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#">Bedrijfsprofiel</a> > <a href="#" class="activepage">Wijzigen</a></p>

		<form id="settings-form" method="post" action="#">
			<div class="content-block">
				<p class="content-head">Bedrijfsinformatie</p>
				<p class="comment cursive">Vul hieronder de bedrijfsgegevens in.</p>
				<table id="settings-table">
					<tr>
						<td><label for="bedrijfsnaam">Bedrijfsnaam</label></td>
					</tr>
					<tr>
						<td colspan="2"><input type="text" name="bedrijfsnaam" id="bedrijfsnaam" style="width:505px;"></td>
					</tr>
					<tr>
						<td><label for="straat">Straatnaam</label></td>
						<td><label for="huisnr">Nummer</label></td>
					</tr>
					<tr>
						<td><input type="text" id="straat"></td>
						<td><input type="text" id="huisnr"></td>
					</tr>
					<tr>
						<td><label for="postcode">Postcode</label></td>
						<td><label for="plaats">Plaats</label></td>
					</tr>
					<tr>
						<td><input type="text" id="postcode"></td>
						<td><input type="text" id="plaats"></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Contantgegevens</p>
				<table id="settings-table">
					<tr>
						<td><label for="voornaam">Voornaam</label></td>
						<td><label for="achternaam">Achternaam</label></td>
					</tr>
					<tr>
						<td><input type="text" name="voornaam" id="voornaam"></td>
						<td><input type="text" name="achternaam" id="achternaam"></td>
					</tr>
					<tr>
						<td><label for="man"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="man" value="man"> Man</label> <label for="vrouw"><input style="margin:20px 0 20px 30px;" type="radio" name="sex" id="vrouw" value="vrouw"> Vrouw</label></td>
					</tr>
					<tr>
						<td><label for="telnr">Telefoonnummer</label></td>
						<td><label for="email">E-mail adres</label></td>
					</tr>
					<tr>
						<td><input type="text" name="telnr" id="telnr"></td>
						<td><input type="text" name="email" id-"email"></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Login gegevens</p>
				<table id="settings-table">
					<tr>
						<td><label for="username">Gebruikersnaam</label></td>
					</tr>
					<tr>
						<td><input type="text" name="username" id="username"></td>
					</tr>
					<tr>
						<td><label for="password">Wachtwoord</label></td>
						<td><label for="repeat-password">Herhaal wachtwoord</label></td>
					</tr>
					<tr>
						<td><input type="password" name="password" id="password"></td>
						<td><input type="password" name="repeat-password" id="repeat-password"></td>
					</tr>
					<tr>
						<td colspan="2"><p class="comment">Gebruik minimaal 6 karakters, waarvaan een cijfer en een hoofdletter.</p></td>
					</tr>
				</table>
			</div>
			<div class="content-block">
				<p class="content-head">Maatwerkpakket</p>
				<p class="comment">Selecteer hieronder de opties die van toepassing zijn op deze klant. <br>Dit kan later altijd nog gewijzigd worden.</p>
				<!-- <table>
					<tr><td><label for="idcheck"><input type="checkbox" name="idcheck" id="idcheck"> ID Check</label></td></tr>
					<tr><td><label for="opleiding"><input type="checkbox" name="opleiding" id="opleiding"> Opleiding</label></td></tr>
					<tr><td><label for="werkervaring"><input type="checkbox" name="werkervaring" id="werkervaring"> Werkervaring</label></td></tr>
					<tr><td><label for="onlineonderzoek"><input type="checkbox" name="onlineonderzoek" id="onlineonderzoek"> Online onderzoek</label></td></tr>
					<tr><td><label for="financieel"><input type="checkbox" name="financieel" id="financieel"> Financiele situatie en gerechtelijke uitspraken</label></td></tr>
					<tr><td><label for="vog"><input type="checkbox" name="vog" id="vog"> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label></td></tr>
				</table> -->
				<ul>
					<li><label for="idcheck"><input type="checkbox" name="idcheck" id="idcheck"> ID check</label></li>
					<li><label for="werkervaring"><input type="checkbox" name="werkervaring" id="werkervaring"> Werkervaring</label></li>
					<li><label for="opleiding"><input type="checkbox" name="opleiding" id="opleiding"> Opleiding</label></li>
					<li><label for="financieel"><input type="checkbox" name="financieel" id="financieel"> Financiele situatie en gerechtelijke uitspraken</label></li>
					<li><label for="vog"><input type="checkbox" name="vog" id="vog"> Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label></li>
				</ul>
			</div>
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"></div>
		</form>

		<?php include "../footer.php"; ?>

	</div>
	
</div>

</body>
</html>			