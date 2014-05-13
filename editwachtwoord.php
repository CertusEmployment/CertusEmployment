<?php

include "connect.php";

$query = "SELECT * FROM ".$_GET['table']." WHERE id = '".$_GET['id']."' ";
$result = mysql_query($query);
//var_dump($query);
$errormessage = "";
$errorclass = "";
$errorclassold = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord wijzigen</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">
	<?php
		if($_GET['table']=='bedrijf'){
			include "bedrijf/toolbar-bedrijf.php";
		}
		if($_GET['table']=='admin'){
			include "admin/toolbar-admin.php";
		}
		if($_GET['table']=='klant'){
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
				if ($_POST['new-password'] == $_POST['new-password-repeat'] && isset($_POST['new-password']) && isset($_POST['new-password-repeat'])){
					$oldpwhash = hash('sha1',$_POST['old-pw']);
					if($oldpwhash == $row['wachtwoord']) {
						$newpwhash = hash('sha1',$_POST['new-password']);
						mysql_query("UPDATE ".$_GET['table']." SET wachtwoord = '".$newpwhash."' WHERE id = '".$_GET['id']."'");
						header("Location: ".$_GET['table']."/".$_GET['table']."-panel.php");
					}
					$posting = true;
				} 
				if ($_POST['old-pw'] != $row['wachtwoord']) {
					$errormessage = "Het oude wachtwoord is incorrect.";
					$errorclassold = "class='errorinput'";
					unset($_POST['submit']);
					$posting = false;
				}

				if ($_POST['new-password'] != $_POST['new-password-repeat']) {
					$errormessage = "Herhaal het wachtwoord op de juiste manier";
					$errorclass = "class='errorinput'";
					unset($_POST['new-password']);
					unset($_POST['new-password-repeat']);
					$posting = false;
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
					<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" onclick="location.href='<?php echo $_GET['table']; ?>/<?php echo $_GET['table']; ?>-panel.php'" id="cancel" name="cancel" value="Annuleer"></div>
				</form>
			<?php
			} //endif
		}
		?>

	</div>
	
</div>

</body>
</html>			