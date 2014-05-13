<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord vergeten</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/main.css" media="screen" />
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<div id="container">

	<div id="wrapper">

		<div id="logo">
			<img src="images/certus_logo.png" />
		</div>

		<div class="content-block settings-block">
			
				<h3 >Wachtwoord herstellen</h3>
				<p>
					Geef het e-mailadres op waarmee u geregistreerd staat in het systeem.
					Wanneer u later uw e-mailadres heeft gewijzigd bij uw gegevens, geeft 
					u dan het gewijzigde e-mailadres op. Er kan dan voor u een link worden 
					gegenereerd, waar u uw wachtwoord kunt aanpassen.
				</p>
				<br>
				<form id="settings-form" name="password-forget">
					<label for="password-forget">E-mail adres: </label>
					<input id="password-forget" type="text" name="email">&nbsp;
					<input type="submit" id="settings-btn" value="Verzenden" name="submit">
				</form>
				<br>
				<p class="comment">
					Wanneer u niet meer weet met welk e-mailadres u bent geregistreerd kunt
					u contact op nemen met <br><a href="mailto:info@certus-employment.nl">info@certus-employment.nl</a> om deze op te vragen.
				</p>
				<br>
				<a href="#">Terug naar de inlog pagina</a>
				
			
		</div>
		<?php include "footer.php"; ?>
	</div>

</div>


</body>
</html>