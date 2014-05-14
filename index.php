<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php include "connect.php"; ?>
	<link rel="stylesheet" type="text/css" href="styles/main.css" />
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<?php
session_start();

$error = "";
$errorclass = "";

if(!isset($_POST['submit'])) {
	$posting = false;

} else {

	if(!empty($_SESSION['id'])) {
		
	}

	$username = htmlentities(strip_tags(trim($_POST['username'])));
	$temp = htmlentities(strip_tags(trim($_POST['password'])));
	$password = hash('sha1',$temp);

	/* Query list */

	$retrieve = "SELECT wachtwoord, id, temppassword FROM klant WHERE gebruikersnaam='$username'";
	$result = mysql_query($retrieve);
	$klantdata = mysql_fetch_assoc($result);

	$bedrijf = "SELECT wachtwoord, id FROM bedrijf WHERE gebruikersnaam='$username'";
	$b = mysql_query($bedrijf);
	$bedrijfdata = mysql_fetch_assoc($b);

	$admin = "SELECT wachtwoord, id FROM admin WHERE gebruikersnaam='$username'";
	$a = mysql_query($admin);
	$admindata = mysql_fetch_assoc($a);

	/* Query list end */

	if(!empty($klantdata['wachtwoord'])) {
		if($password==$klantdata['wachtwoord']) {
			$_SESSION['id'] = $klantdata['id'];
			$_SESSION['table'] = "klant";
			//check temp password
			if($klantdata['temppassword'] == '1') {
				header("Location: klant/klant-new-pw.php");
			} else {
				header("Location: klant/klant-panel.php");
			}
		} else {
			$posting = false;
			$errorclass = "errorinput"; 
		}

	} else {
		$posting = false;
	}

	if(!empty($bedrijfdata['wachtwoord'])) {	
		if($password==$bedrijfdata['wachtwoord']) { 
			$_SESSION['id'] = $bedrijfdata['id'];
			$_SESSION['table'] = "bedrijf";
			header("Location: bedrijf/bedrijf-panel.php");
		} else { 
			$posting = false;
			$errorclass = "errorinput"; 
		}
	} else { 
		$posting = false; 
	}

	if(!empty($admindata['wachtwoord'])) {
		if($password==$admindata['wachtwoord']) {
			$_SESSION['id'] = $admindata['id'];
			$_SESSION['table'] = "admin";
			header("Location: admin/admin-panel.php");
		} else {
			$posting = false;
			$errorclass = "errorinput"; 
		}
	} else {
		$posting = false;
	}

	if(!$posting) {
		$errorclass = "errorinput";
		$error = "Gebruikersnaam of wachtwoord onjuist.";
	}
}

if(!$posting) {

?>

<div id="container">
	<div id="login-wrap">
		<div id="login-block">
			<img src="images/certus_logo.png" />

			<form name="login" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
				<p class="loginred"><?php echo $error; ?></p>
				<label id="username">Gebruikersnaam:</label><br />
				<input class="margin <?php echo $errorclass; ?>" type="text" name="username" id="username" /><br />

				<label id="password">Wachtwoord:</label><br />
				<input class="no-padding <?php echo $errorclass; ?>" type="password" name="password" id="password" /><br />

				<a class="reset-password" href="password-forget.php">Wachtwoord vergeten</a><br />
				<input type="submit" name="submit" value="Inloggen" /><small></small>
			</form>

		</div>
		<a id="login-link-ce" href="http://www.certus-employment.com"><i class="fa fa-reply"></i> Terug naar de site</a>	
	</div>
</div>

<?php

}


?>

</body>
</html>