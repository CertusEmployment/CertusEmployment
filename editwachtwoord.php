<?php


include "connect.php";

$query = "SELECT * FROM ".$_GET['table']." WHERE id = '".$_GET['id']."' ";
$result = mysql_query($query);
//var_dump($query);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord wijzigen</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">
	<?php
		if($_GET['table']=='bedrijf'){
			include "toolbar-bedrijf.php";
		}
		if($_GET['table']=='admin'){
			include "toolbar-admin.php";
		} else {
			include "toolbar-klant.php";
		}
	?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="images/certus_logo.png" />
		</div>

		<?php
		while ($row=mysql_fetch_array($result)) {
		if (isset($_POST['submit']) && $_POST['new-password'] == $_POST['new-password-repeat'] && isset($_POST['new-password']) && isset($_POST['new-password-repeat'])){
			
				if($_POST['old-pw'] == $row['wachtwoord']) {
					mysql_query("UPDATE ".$_GET['table']." SET wachtwoord = '".$_POST['new-password']."' WHERE id = '".$_GET['id']."'");
					if($_GET['table']=='bedrijf'){
						header('Location: bedrijf/bedrijf-panel.php');
					}
					if($_GET['table']=='klant'){
						header('Location: klant/klant-panel.php');
					} else {
						header("Location: admin/admin-panel.php");
					}
			}
		} 
		if ($_POST['submit'] && $_POST['old-pw'] != $row['wachtwoord']) {
			$errormessage = "Het oude wachtwoord is incorrect.";
			$errorclassold = "class='errorinput'";
		}
		if ($_POST['new-password'] != $_POST['new-password-repeat']) {
			$errormessage = "Herhaal het wachtwoord op de juiste manier";
			$errorclass = "class='errorinput'";
			unset($_POST['new-password']);
			unset($_POST['new-password-repeat']);
		} 

		?>
			<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="content-block settings-block">
					<table id="settings-table">
						<?php echo (empty($errormessage)) ? "" : "<tr><td class='errormessage'>".$errormessage."</td></tr>" ;?>
						<tr>
							<td><label for="old-pw">Huidig wachtwoord: <?php echo $row['wachtwoord']; ?></label></td>
						</tr>
						<tr>
							<td><input <?php echo $errorclassold; ?> type="password" name="old-pw" id="old-pw" required></td>
						</tr>
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
				<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" id="cancel" name="submit" value="Annuleer"></div>
			</form>
		<?php
		}
		?>

	</div>
	
</div>

</body>
</html>			