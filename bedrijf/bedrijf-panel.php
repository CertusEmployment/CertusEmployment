<?php
include "../connect.php";
session_start();
if(isset($_GET['klantid'])) {
	$_SESSION['klantid'] = $_GET['klantid'];
	header("location: bedrijf-kandidaatprofiel.php");
} else {
	unset($_SESSION['klantid']);
}
unset($_SESSION['vn']); unset($_SESSION['an']); unset($_SESSION['straat']); unset($_SESSION['huisnr']); unset($_SESSION['toevoeging']); unset($_SESSION['postcode']); unset($_SESSION['plaats']); unset($_SESSION['land']); unset($_SESSION['gebdatum']); unset($_SESSION['gebplaats']); unset($_SESSION['sex']); unset($_SESSION['telnr']); unset($_SESSION['email']); unset($_SESSION['aanmaakdatum']); unset($_SESSION['username']); unset($_SESSION['temppassword']); unset($_SESSION['temp']); unset($_SESSION['password']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bedrijf panel | Certus Employment</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<script src="../js/main.js"></script>
	<!-- Tablefilter -->
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script src="../js/ddtf.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		$('#filterTable').ddTableFilter();
	});
	</script>
</head>
<body>

<div id="container">
	
<?php 

include "toolbar-bedrijf.php";

$datumArray = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );

$query_bedrijf = "SELECT * FROM bedrijf WHERE id =  ".$_SESSION['id']." ";
$result = mysql_query($query_bedrijf);

$query_klant = "SELECT * FROM klant WHERE bedrijfid = ".$_SESSION['id']." ORDER BY opleverdatum ASC";
$result_klant = mysql_query($query_klant);



?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

<?php $bedrijfinfo = mysql_fetch_array($result); ?>

		<div class="content-block">
			<table class="profiletable">
			
				<tr>
					<th collspan="2">Bedrijfs informatie</th>
				</tr>
				<tr>
					<td>Bedrijfsnaam</td>
					<td><?php echo $bedrijfinfo['bedrijfnaam']; ?></td>
					<td>Telefoon nummer</td>
					<td><?php echo $bedrijfinfo['telnr_contact']; ?></td>
				</tr>
				<tr>
					<td>Adres</td>
					<td><?php echo ucfirst($bedrijfinfo['straatnaam'])." ".$bedrijfinfo['huisnummer'].$bedrijfinfo['huistoevoeging']; ?></td>
				</tr>
				<tr>
					<td>Postcode</td>
					<td><?php echo (strlen($bedrijfinfo['postcode'])==6)? chunk_split(strtoupper($bedrijfinfo['postcode']), 4, " ") : $bedrijfinfo['postcode'] ; ?></td>
				</tr>
				<tr>
					<td>Plaats</td>
					<td><?php echo ucfirst($bedrijfinfo['plaats']); ?></td>
				</tr>

			</table>
		</div>

		<div class="content-block">
			<table class="profiletable">
				<tr>
					<th collspan="2">Account informatie</th>
				</tr>
				<tr>
					<td>Gebruikersnaam</td>
					<td><?php echo $bedrijfinfo['gebruikersnaam']; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $bedrijfinfo['email_contact']; ?></td>
					<td><small><a href="../editemail.php ">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td><?php echo (($bedrijfinfo['wachtwoord'])=='')? '<i>No password</i>' : '&#8226;&#8226;&#8226;&#8226;' ; ?></td>
					<td><small><a href="../editwachtwoord.php ">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
		</div>

		<div class="screening-list">
			<table id="filterTable" class="profiletable order-table table">
				<thead>
				<tr class="table-header-filter">
					<th class="skip-filter"></th>
					<th class="noskip-filter"><select><option>--Opleverperiode--</option></select></th>
					<th class="skip-filter"></th>
					<th class="skip-filter"></th>
					<th class="noskip-filter"><select><option>--Rapport--</option></select></th>
					<th class="skip-filter"><form name="filter" id="filter"><input type="text" name="filter" data-table="order-table" class="light-table-filter" placeholder="FILTER"></form></th>
				</tr>
				</thead>
				<tr class="table-header">
					<th class="skip-filter">Naam</th>
					<th class="skip-filter">Opleverperiode</th>
					<th class="skip-filter">Postcode</th>
					<th class="skip-filter">Plaats</th>
					<th class="skip-filter">Rapport</th>
					<th class="skip-filter">Profiel</th>
				</tr>

				<?php while ($kandidaten = mysql_fetch_array($result_klant)) {
				 ?>
					<!-- <tr class="trlink" onclick="document.location = 'bedrijf-kandidaatprofiel.php?id=<?php echo $kandidaten['id']; ?>';"> -->
					<tr class="trlink" onclick="document.location = 'bedrijf-panel.php?klantid=<?php echo $kandidaten['id']; ?>';">
						<td><?php echo ucfirst($kandidaten['voornaam'])." ".ucfirst($kandidaten['achternaam']); ?></td>
						<td><?php echo $datumArray[date('n', strtotime($kandidaten['opleverdatum']))].' '.date('Y', strtotime($kandidaten['opleverdatum'])); ?></td>
						<td><?php echo chunk_split(strtoupper($kandidaten['postcode']),4," "); ?></td>
						<td><?php echo ucfirst($kandidaten['plaats']); ?></td>
						<td class="cursive"><?php echo (empty($kandidaten['rapport'])) ? "In bewerking" : "Rapport voltooid" ; ?></td>
						<td><a href="bedrijf-panel.php?klantid=<?php echo $kandidaten['id']; ?>">link</a></td>
					</tr>
				<?php } ?>
				
			</table>
		</div>

		<?php include "../footer.php";
		
		 
		?>

	</div>
</div>
</body>
</html>