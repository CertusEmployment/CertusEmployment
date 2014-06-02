<?php include "../connect.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>Nieuw Wachtwoord</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>



<div id="container">

<?php include "toolbar-klant.php";

$query = "SELECT * FROM klant WHERE id = '".$_SESSION['id']."'";
$result = mysql_query($query);

// Empty error vars
$errormessage = "";
$errorclass = "";
$errorclassold = "";

$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/'; //6 characters, 1 hoofdletter, 1 cijfer

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$posting = true;
	$temp = $_POST['password'];
	$repeat = $_POST['repeat'];
	$password = hash('sha1',$temp);

	if($temp !== $repeat) {
		$posting = false;
		$errormessage = "Wachtwoorden komen niet overeen";
		$errorclass = "errorinput";
	}
	if(!preg_match($regex, $temp)){
		$posting = false;
		$errormessage = "Wachtwoord voldoet niet aan de eissen.";
		$errorclass = "errorinput";
	}

	if ($posting) {
		// Update Query
		$update_sql = "UPDATE klant SET 
		wachtwoord='".$password."',
		temppassword=2
		WHERE id=".$_SESSION['id']." ";
		$update = mysql_query($update_sql) or die("<br>error : ".mysql_error());
		header("Location: klant-upload.php");
	}
}

if(!$posting) {
	

?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block settings-block">
				<p>Omdat dit de eerste keer is dat u inlogt, is er een nieuw wachtwoord nodig.</p>
				<p class="comment">Wachtwoord moet minimaal:<ul class="ul-disc comment"><li>6 tekens bestaan</li><li>&eacute;&eacute;n hoofdletter bevatten</li><li>&eacute;&eacute;n cijfer</li><li>mag geen speciale tekens bevatten</li></ul></p>
				<p class="red"><?php echo $errormessage; ?></p>
				<table id="settings-table">
					<tr>
						<td><label for="password">Nieuw wachtwoord</label></td>
						<td><label for="repeat">Herhaal wachtwoord</label></td>
					</tr>
					<tr>
						<td><input class="<?php echo $errorclass; ?>" type="password" name="password" id="password" required></td>
						<td><input class="<?php echo $errorclass; ?>" type="password" name="repeat" id="repeat" required></td>
					</tr>
				</table>
			</div>
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>

	</div>
	
</div>

<?php

}

?>

</body>
</html>			