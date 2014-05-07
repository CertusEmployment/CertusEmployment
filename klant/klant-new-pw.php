<!DOCTYPE html>
<html>
<head>
	<title>Nieuw Wachtwoord</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<?php

session_start();

$query = "SELECT * FROM klant WHERE id = '".$_SESSION['id']."'";
$result = mysql_query($query);

// Empty error vars
$errormessage = "";
$errorclass = "";
$errorclassold = "";

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$posting = true;
	$temp = $_POST['password'];
	$repeat = $_POST['repeat'];
	$password = hash('sha1',$temp);

	if($temp != $repeat) {
		$posting = false;
		$errormessage = "Wachtwoorden komen niet overeen";
		$errorclass = "errorinput";
	}

	if ($posting) {
		// Update Query
		$update_sql = "UPDATE klant SET 
		wachtwoord='".$password."',
		temppassword='0'
		WHERE id=".$_SESSION['id']." ";
		$update = mysql_query($update_sql);
		header("Location: klant-upload.php");
	}
}

if(!$posting) {

?>

<div id="container">

	<?php include "toolbar-klant.php"; ?>

	<div id="wrapper">
		<a href="#" id="klant-temp-logout">uitloggen</a>
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block settings-block">
				<p>Omdat dit de eerste keer is dat u inlogt, is er een nieuw wachtwoord nodig.</p>
				<p class="comment">Wachtwoord moet minimaal 6 karakters, een cijfer en een hoofdletter bevatten.</p>
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