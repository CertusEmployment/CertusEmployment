<!DOCTYPE html>
<html>
<head>
	<title>Email wijzigen</title>
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
				<p>Huidig e-mail adres: mail@mail.com</p>
				<table id="settings-table">
					<tr>
						<td><label for="new-password">Nieuw e-mail adres</label></td>
						<td><label for="new-password-repeat">Herhaal e-mail adres</label></td>
					</tr>
					<tr>
						<td><input type="text" name="new-password" id="new-password"></td>
						<td><input type="text" name="new-password-repeat" id="new-password-repeat"></td>
					</tr>
				</table>
			</div>
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"><input type="submit" id="cancel" name="submit" value="Annuleer"></div>
		</form>

	</div>
	
</div>

</body>
</html>			