<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css" />
</head>
<body>


<div id="container">
	<div id="login-wrap">
		<div id="login-block">
			<img src="images/certus_logo.png" />

			<form name="login" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
				<label id="username">Gebruikersnaam:</label><br />
				<input class="margin" type="text" name="username" id="username" /><br />

				<label id="password">Wachtwoord:</label><br />
				<input class="no-padding" type="password" name="password" id="password" /><br />

				<a class="reset-password" href="#">Wachtwoord vergeten</a><br />
				<input type="submit" name="Submit" value="Inloggen" /><small></small>
			</form>

		</div>
		<a id="login-link-ce" href="#">&larr;Terug naar de site</a>	
	</div>
</div>

</body>
</html>