<?php

session_start();
include "connect.php";

$query = "SELECT * FROM ".$_SESSION['table']." WHERE id = '".$_SESSION['id']."' ";
$result = mysql_query($query);

$errormessage = "";
$errorclass = "";
$errorclassold = "";

$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/'; //6 characters, 1 hoofdletter, 1 cijfer

?>
<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord wijzigen | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">
	<?php
		if($_SESSION['table']=='bedrijf'){
			include "bedrijf/toolbar-bedrijf.php";
		}
		if($_SESSION['table']=='admin'){
			include "admin/toolbar-admin.php";
		}
		if($_SESSION['table']=='klant'){
			include "klant/toolbar-klant.php";
		}
	?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="images/certus_logo.png" />
		</div>

		<?php
		$posting = false;
		while ($row = mysql_fetch_array($result)) {
			
			if (isset($_POST['submit'])) {
				
				$oldpwhash = hash('sha1',$_POST['old-pw']);
				
				if($oldpwhash !== $row['wachtwoord']) {
					$errormessage = "Het oude wachtwoord is niet goed gehashed.";
					$errorclassold = "class='errorinput'";
					$posting=false;
				} else {
					$posting=true;
				}

				if (!isset($_POST['new-password']) OR !isset($_POST['new-password-repeat'])) {
					$errormessage = "Herhaal het wachtwoord op de juiste manier.";
					$errorclass = "class='errorinput'";
					$posting=false;
				}

				if ($_POST['new-password'] != $_POST['new-password-repeat']) {
					$errormessage = "Herhaal het wachtwoord op de juiste manier.";
					$errorclass = "class='errorinput'";
					unset($_POST['new-password']);
					unset($_POST['new-password-repeat']);
					$posting = false;
				} else {
					$posting=true;
				}
				if ($_SESSION['table']!='admin'){
					if (!preg_match($regex, $_POST['new-password'])) {
						$errormessage = "Wachtwoord voldoet niet aan de eisen.";
						$errorclass = "class='errorinput'";
						unset($_POST['new-password']);
						unset($_POST['new-password-repeat']);
						$posting=false;
					} else {
						$posting=true;
					}
				}

				if($posting){
					$newpwhash = hash('sha1',$_POST['new-password']);
					mysql_query("UPDATE ".$_SESSION['table']." SET wachtwoord = '".$newpwhash."', temppassword=0 WHERE id = '".$_SESSION['id']."'")or die(mysql_error());
					header("Location: ".$_SESSION['table']."/".$_SESSION['table']."-panel.php");
				}
			}
			
			if(!$posting) {
			

			?>
				<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<div class="content-block settings-block">
						<table id="settings-table">
							<?php echo (empty($errormessage)) ? "" : "<tr><td class='errormessage'>".$errormessage."</td></tr>" ;?>
							<tr>
								<td><label for="old-pw">Huidig wachtwoord</label></td>
							</tr>
							<tr>
								<td><input <?php echo $errorclassold; ?> type="password" name="old-pw" id="old-pw" required></td>
							</tr>
							<?php if($_SESSION['table']!='admin'){?><tr><td><p class="comment">Wachtwoord moet minimaal:<ul class="ul-disc comment"><li>6 tekens bestaan</li><li>&eacute;&eacute;n hoofdletter bevatten</li><li>&eacute;&eacute;n cijfer</li><li>mag geen speciale tekens bevatten</li></ul></p></td></tr><?php } ?>
							<tr>
								<td><label for="new-password">Nieuw wachtwoord</label></td>
								<td><label for="new-password-repeat">Herhaal wachtwoord</label></td>
							</tr>
							<tr>
								<td><input <?php echo $errorclass; ?> type="password" name="new-password" id="new-password" required></td>
								<td><input <?php echo $errorclass; ?> type="password" name="new-password-repeat" id="new-password-repeat" required></td>
							</tr>
						</table>
					</div>
					<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" onclick="location.href='<?php echo $_SESSION['table']; ?>/<?php echo $_SESSION['table']; ?>-panel.php'" id="cancel" name="cancel" value="Annuleer"></div>
				</form>
			<?php
			} //endif
		}
		?>

	</div>
	
</div>

</body>
</html>			