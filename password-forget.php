<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord vergeten | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="styles/main.css" media="screen" />
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<?php

function randomPassword() {
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array();
	$alphaLength = strlen($alphabet) - 1;
	for ($i = 0; $i < 8; $i++) {
	    $n = rand(0, $alphaLength);
	    $pass[] = $alphabet[$n];
	}
	return implode($pass);
}

// DEFAULT MAIL
$header = "MIME-version: 1.0\n"; 
$header .= "content-type: text/html;charset=utf-8\n";
$header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
$subject = "U heeft een wachtwoord wijziging opgevraagd";
$password = randomPassword();
$hashed = hash('sha1', $password);
include "email/email-reset.php";

if(!isset($_POST['submit'])){
	$posting=false;
	$send = 0;
} else{
	$posting=true;

	$queryklant = "SELECT * FROM klant WHERE email ='".$_POST['email']."' ";
	$k = mysql_query($queryklant);
	$klant = mysql_fetch_assoc($k);

	$querybedrijf = "SELECT * FROM bedrijf WHERE email_contact ='".$_POST['email']."' ";
	$b = mysql_query($querybedrijf);
	$bedrijf = mysql_fetch_assoc($b);

	$queryadmin = "SELECT * FROM admin WHERE email ='".$_POST['email']."' ";
	$a = mysql_query($queryadmin);
	$admin = mysql_fetch_assoc($a);

	if(!empty($klant['email'])) {
		//Update
		$sql = "UPDATE klant SET wachtwoord='".$hashed."', temppassword=1";
		mysql_query($sql);

		//Mail
		$to = $klant['email'];
		mail($to, $subject, $message, $header);
		$send = 1;

	} else if(!empty($admin['email'])) {
		//Update
		$sql = "UPDATE admin SET wachtwoord='".$hashed."', temppassword=1";
		mysql_query($sql);

		//Mail
		$to = $admin['email'];
		mail($to, $subject, $message, $header);
		$send = 1;

	} else if(!empty($bedrijf['email_contact'])) {
		//Update
		$sql = "UPDATE bedrijf SET wachtwoord='".$hashed."', temppassword=1";
		mysql_query($sql);

		//Mail
		$to = $bedrijf['email_contact'];
		mail($to, $subject, $message, $header);
		$send = 1;

	}


}

?>

<div id="container">

	<div id="wrapper">

		<div id="logo">
			<img src="images/certus_logo.png" />
		</div>
		<p id="breadcrumbs"><a href="index.php">Startscherm</a> > <a class="activepage" href="#">Wachtwoord vergeten</a></p>
		<div class="content-block settings-block">

			<h3 >Wachtwoord herstellen</h3>
			<p>
				Geef het e-mailadres op waarmee u geregistreerd staat in het systeem.
				Wanneer u later uw e-mailadres heeft gewijzigd bij uw gegevens, geeft 
				u dan het gewijzigde e-mailadres op. Er kan dan voor u een link worden 
				gegenereerd, waar u uw wachtwoord kunt aanpassen.
			</p>
			<br>

			<?php

			if($send == 0) {

			?>

			<form id="settings-form" name="password-forget" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<label for="password-forget">E-mail adres: </label>
				<input id="password-forget" type="text" required name="email">&nbsp;
				<input type="submit" id="settings-btn" value="Verzenden" name="submit">
			</form>

			<?php

			} else {

			?>

			<div id="password-recovery">
				<h3>Hartelijk bedankt!</h3>
				<p>Als u bij ons een geregistreerd account heeft met dit e-mail adres ontvangt u zo spoedig mogelijk een e-mail.</p>
			</div>



			<?php

			}

			?>

			<br>
			<p class="comment">
				Wanneer u niet meer weet met welk e-mailadres u bent geregistreerd kunt
				u contact op nemen met <br><a href="mailto:info@certus-employment.nl">info@certus-employment.nl</a> om deze op te vragen.
			</p>

			<br>
			<a href="index.php">Terug naar de inlog pagina</a>
				
		</div>
		<?php include "footer.php"; ?>
	</div> <!-- END WRAP -->

</div>


</body>
</html>