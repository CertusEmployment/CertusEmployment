<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord vergeten</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/main.css" media="screen" />
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<?php

$posting=false;
if(!isset($_POST['submit'])){
	$posting=false;
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

	if(isset($klant['email'])) {
		$to = $klant['email'];
		$header = "MIME-version: 1.0\n"; 
	    $header .= "content-type: text/html;charset=utf-8\n";
	    $header .= "From: noreply@certus-employment.nl" . "\r\n" . "Reply-To: noreply@certus-employment.nl" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	    $message = 
    "
    Geachte ".$klant['voornaam']." ".$klant['achternaam'].",<br><br>
    
    ";
		
	} else {
		$posting=false;
	}
	if(isset($bedrijf['email_contact'])) {
		echo "bedrijf ".$bedrijf['email_contact'];
		
	} else {
		$posting=false;
	}
	if(isset($admin['email'])) {
		echo "admin ".$admin['email'];
		
	} else {
		$posting=false;
	}
}

if(!$posting) {
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
				<form id="settings-form" name="password-forget" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<label for="password-forget">E-mail adres: </label>
					<input id="password-forget" type="text" required name="email">&nbsp;
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
	</div> <!-- END WRAP -->
	<?php } ?>

</div>


</body>
</html>