<!DOCTYPE html>
<html>
<head>
	<title>Nieuw Wachtwoord</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
</head>
<body>

<div id="container">

	<?php include "toolbar-klant.php"; ?>

	<div id="wrapper">
		<div id="logo">
			<img src="styles/images/certus_logo.png" />
		</div>
		
		<form id="new-pw-form" name="new-pw-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block new-pw-block">
				<p>Omdat dit de eerste keer is dat u inlogt, is er een nieuw wachtwoord nodig.</p>
				<p class="new-pw-block-grey">Minimaal 6 karakters en moet een cijfer en een hoofdletter bevatten.</p>
				<label for="new-password">Nieuw wachtwoord</label>
				<label for="new-password-repeat">Herhaal wachtwoord</label><br>
				<input type="password" name="new-password" id="new-password">
				<input type="password" name="new-password-repeat" id="new-password-repeat">
			</div>
			<input type="submit" name="submit" value="Opslaan">
		</form>

	</div>
	
</div>

</body>
</html>