<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<?php include "connect.php"; ?>
	<link rel="stylesheet" type="text/css" href="styles/main.css" />
</head>
<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;

} else {

	$username = htmlentities(strip_tags(trim($_POST['username'])));
	$password = htmlentities(strip_tags(trim($_POST['password'])));

	$retrieve = "SELECT k.wachtwoord, b.wachtwoord FROM klant k, bedrijf b, admin a 
				 WHERE k.bedrijfid=b.id and k.gebruikersnaam='$username' or b.gebruikersnaam='$username'";
	$result = mysql_query($retrieve);
	$data = mysql_fetch_assoc($result);

	echo $data['wachtwoord'];

	/**if(empty($result)) {
		$posting = false;
	}

	if($posting) {
		echo $result;
	}**/

}	

?>

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
				<input type="submit" name="submit" value="Inloggen" /><small></small>
			</form>

			<?php /***
				$retrieve = "SELECT voornaam, achternaam FROM klant WHERE voornaam='Jo' AND achternaam='Bonten'";
				$result = mysql_query($retrieve);
				$row = mysql_fetch_assoc($result);

				echo $row['achternaam']; ***/
			?>
				

		</div>
		<a id="login-link-ce" href="#">&larr;Terug naar de site</a>	
	</div>
</div>

</body>
</html>