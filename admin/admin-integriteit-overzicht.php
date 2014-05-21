<?php 
include "../connect.php";
session_start();

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql);

if(isset($_GET['integriteitid'])) {
	$_SESSION['integriteitid'] = $_GET['integriteitid'];
	header('location: admin-integriteit-bewerken.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Integriteit overzicht</title>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
</head>
<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$posting = true;
}

if(!$posting) {

?>

<div id="container">

	<?php include "toolbar-admin.php"; ?>

	<div id="wrapper">
		
		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>
		
		<p id="breadcrumbs"><a href="admin-panel.php">Overzicht</a> > <a href="#" class="activepage">Nieuw bedrijf</a></p>

		<form id="settings-form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="content-block">
				<p class="content-head">Overzicht</p>
				
				<table class="profiletable">
					<tr>
						<th>Nummer</th>
						<th>Vraagstelling</th>
						<th>Ja/Nee optie</th>
						<th>Toelichting</th>
						<th>Opties</th>
					</tr>

				<?php
				while ($row=mysql_fetch_assoc($result)) {

					if($row['radiobutton'] == 1) {
						$radiobutton = "Aan";
					} else {
						$radiobutton = "Uit";
					}

					if($row['toelichting'] == 1) {
						$toelichting = "Aan";
					} else {
						$toelichting = "Uit";
					}
					?>

					<tr class="trlink" onclick="document.location = 'admin-integriteit-overzicht.php?integriteitid=<?php echo $row['id']; ?>';">
						<td><?php echo $row['id'] + 1; ?></td>
						<td><?php echo substr($row['vraag'], 0, 10); ?></td>
						<td><?php echo $radiobutton; ?></td>
						<td><?php echo $toelichting; ?></td>
						<td><a href="admin-integriteit-overzicht.php?integriteitid=<?php echo $row['id']; ?>">Bewerken</a></td>
					</tr>

				<?php
				}
				?>
				</table>
			</div>
	



			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Voltooien"><input type="submit" onclick="location.href='admin-panel.php'" id="cancel" name="submit" value="Annuleer"></div>
		</form>
		
		<?php include "../footer.php"; ?>
		<?php } ?>

	</div>
	
</div>

</body>
</html>			