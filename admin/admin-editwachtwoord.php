<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord wijzigen</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="container">

	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block settings-block">
				<table id="settings-table">
					<tr>
						<td><label for="old-pw">Huidig wachtwoord</label></td>
					</tr>
					<tr>
						<td><input type="password" name="old-pw" id="old-pw"></td>
					</tr>
					<tr>
						<td><label for="new-password">Nieuw wachtwoord</label></td>
						<td><label for="new-password-repeat">Herhaal wachtwoord</label></td>
					</tr>
					<tr>
						<td><input type="password" name="new-password" id="new-password"></td>
						<td><input type="password" name="new-password-repeat" id="new-password-repeat"></td>
					</tr>
				</table>
			</div>
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" id="cancel" name="submit" value="Annuleer"></div>
		</form>

	</div>
	
</div>

</body>
</html>			