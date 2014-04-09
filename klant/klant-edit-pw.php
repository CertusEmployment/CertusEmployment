<!DOCTYPE html>
<html>
<head>
	<title>Wachtwoord wijzigen | Certus Employment</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<div id="content">

	<?php include "../toolbar-klant.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="#">Overzicht</a> > <a href="#" class="activepage">Wachtwoord wijzigen</a></p>

		<form id="settings-form" name="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block settings-block">
				<p class="content-head">Wachtwoord wijzigen</p>
				<table id="settings-table">
					<tr>
						<td><label for="old-password">Oud wachtwoord</label></td>
					</tr>
					<tr>
						<td><input type="password" name="old-password" id="old-password"></td>
					</tr>
					<tr>
						<td colspan="2"><p class="comment">Wachtwoord moet minimaal 6 karakters, een cijfer en een hoofdletter bevatten.</p></td>
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
			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>
		
	</div>
</div>

</body>
</html>