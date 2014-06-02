<?php
session_start();

include "connect.php";

$query = "SELECT * FROM ".$_SESSION['table']." WHERE id = '".$_SESSION['id']."' ";
$result = mysql_query($query);
//var_dump($query);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Email wijzigen</title>
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
		elseif($_SESSION['table']=='admin'){
			include "admin/toolbar-admin.php";
		} 
		else {
			include "klant/toolbar-klant.php";
		}
	?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="images/certus_logo.png" />
		</div>
		
		<?php
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		if (isset($_POST['submit']) && $_POST['new-email'] == $_POST['new-email-repeat'] && isset($_POST['new-email']) && isset($_POST['new-email-repeat'])){
			if (preg_match($regex, $_POST['new-email'])){
				( $_SESSION['table'] == 'bedrijf' ? mysql_query("UPDATE ".$_SESSION['table']." SET email_contact = '".$_POST['new-email']."' WHERE id = '".$_SESSION['id']."'") : mysql_query("UPDATE ".$_SESSION['table']." SET email = '".$_POST['new-email']."' WHERE id = '".$_SESSION['id']."'") ) ;
				header("Location: ".$_SESSION['table']."/".$_SESSION['table']."-panel.php");
			} else {
				$errormessage = "Voer een geldig e-mail adres in.";
				$errorclass = "class='errorinput'";
			}
		} 
		if ($_POST['new-email'] != $_POST['new-email-repeat']) {
			$errormessage = "Vul het e-mail adres op de juiste manier in.";
			$errorclass = "class='errorinput'";
			unset($_POST['new-email']);
			unset($_POST['new-email-repeat']);
		} 

		while ($row = mysql_fetch_array($result)) {
			?>
			<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="content-block settings-block">
					<p>Huidig e-mail adres: <?php echo ($_SESSION['table'] == 'bedrijf' ? $row['email_contact'] : $row['email']); ?></p>
					<table id="settings-table">
						<?php echo (empty($errormessage)) ? "" : "<tr><td class='errormessage'>".$errormessage."</td></tr>" ;?>
						<tr>
							<td><label for="new-email">Nieuw e-mail adres</label></td>
							<td><label for="new-email-repeat">Herhaal e-mail adres</label></td>
						</tr>
						<tr>
							<td><input <?php echo $errorclass; ?> type="text" name="new-email" id="new-email" required></td>
							<td><input <?php echo $errorclass; ?> type="text" name="new-email-repeat" id="new-email-repeat" required></td>
						</tr>
					</table>
				</div>
				<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" onclick="location.href='<?php echo $_SESSION['table']; ?>/<?php echo $_SESSION['table']; ?>-panel.php'" id="cancel" name="cancel" value="Annuleer"></div>
			</form>
			<?php
		}
		?>

	</div>
	
</div>

</body>
</html>			