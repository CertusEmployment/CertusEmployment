<?php
session_start();
include "../connect.php";
$dateerrormessage = "";
$dateerrorclass = "";
$pakketerrormessage = "";
$pakketerrorclass = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pakket selectie</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">
	<link href="../styles/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="../js/dropzone.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
	//http://jqueryui.com/datepicker/  
	$(function() {
	    $( "#leverdatum" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
	      yearRange: "+0:+5",
	      minDate: "+0Y", maxDate: "+5Y"
	    });
	 });
	 </script>
</head>
<body>
<?php
$posting=false;

if(!isset($_POST['submit'])) {
	$posting = false;

} else {
	$posting = true;
	if(isset($_POST['leverdatum'])){
		$_SESSION['opleverdatum'] = date('Y-m-d',strtotime($_POST['leverdatum']));
	} else {
		$posting = false;
		$dateerrormessage = "Selecteer de opleverdatum.";
		$dateerrorclass = "class='errorinput'";
	}
	if (isset($_POST['pakketselect'])){
		$_SESSION['pakket'] = $_POST['pakketselect'];
	} else {
		$posting = false;
		$pakketerrormessage = "Selecteer een pakket.";
		$pakketerrorclass = "class='errorinput'";
	}
	if($_SESSION['pakket']==3){
		$_SESSION['identiteit'] = (isset($_POST['identiteit'])) ? $_POST['identiteit'] : 0 ;
		$_SESSION['opleiding'] = (isset($_POST['opleiding'])) ? $_POST['opleiding'] : 0 ;
		$_SESSION['werkervaring'] = (isset($_POST['werkervaring'])) ? $_POST['werkervaring'] : 0 ;
		$_SESSION['onderzoek'] = (isset($_POST['onderzoek'])) ? $_POST['onderzoek'] : 0 ;
		$_SESSION['financieel'] = (isset($_POST['financieel'])) ? $_POST['financieel'] : 0 ;
		$_SESSION['vog'] = (isset($_POST['vog'])) ? $_POST['vog'] : 0 ;
		$_SESSION['pakketboolean'] = 1;
	}
	//die();

	if($posting) {
		header("Location: bedrijf-controlepagina.php");
	} else {
		$posting=false;
	}
}

if (!$posting) {
?>
<div id="container">

	<?php include "toolbar-bedrijf.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<p id="breadcrumbs"><a href="bedrijf-panel.php">Overzicht</a> > <a href="bedrijf-addkandidaat.php">Kandidaat informatie</a> > <a href="#" class="activepage">Pakketselectie</a></p>	
		<form id="settings-form" method="post">
			<div class="content-block">
				<p class="content-head">Opleverdatum</p>
				<p class="comment cursive">Vul hieronder de gewenste opleverdatum in.</p>
				<p <?php echo $dateerrorclass ?>><?php echo $dateerrormessage; ?></p>
				<input type="text" id="leverdatum" name="leverdatum" placeholder="00-00-0000" value="<?php echo (!empty($_SESSION['opleverdatum']))? date('d-m-Y',strtotime($_SESSION['opleverdatum'])) : '' ; ?>" required style="margin-bottom: 15px;">
			</div>

			<div class="content-block" id="pakketform">
				
				<p class="content-head">Pakket keuze</p>
				<p class="comment cursive">Selecteer hieronder een screenings pakket.
					Hou hierbij rekening met de verschillende diensten per pakket.</p>
				<p <?php echo $pakketerrorclass ?>><?php echo $pakketerrormessage; ?></p>
				
				<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio1" value="1">
				<label class="pakketlabel" for="pakketradio1">
					<div class="pakket-block">
					<i class="fa fa-users"></i>
					<p>Volledige employment screening op alle onderdelen</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Financiele situatie en gerechtelijke uitspraken</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></label>

				<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio2" value="2">
				<label class="pakketlabel" for="pakketradio2">
				<div class="pakket-block">
					<i class="fa fa-globe"></i>
					<p>Controle van kandidaat met een buitenlands diploma.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></label>

				<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio3" value="3">
				<label class="pakketlabel" for="pakketradio3">
				<div class="pakket-block">
					<i class="fa fa-cogs"></i>
					<p>Stel uw eigen Employment Screening samen.</p>
					
					<table>
						<tr>
							<td>
								<input type="checkbox" value="1" id="identiteit" name="identiteit" />
								<label for="identiteit">ID</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="1" id="opleiding" name="opleiding" />
								<label for="opleiding">Opleiding</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="1" id="ervaring" name="werkervaring" />
								<label for="ervaring">Werkervaring</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="1" id="onderzoek" name="onderzoek" />
								<label for="onderzoek">Online onderzoek</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="1" id="financieel" name="financieel" />
								<label for="financieel">Financiele situatie en gerechtelijke uitspraken</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" value="1" id="vog" name="vog" />
								<label for="vog">Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</label>
							</td>
						</tr>
					</table>

					<h2 class="pakket-prijs">&euro;175</h2>
				</div></label>

				<input type="radio" class="input_hidden" style="display:;" name="pakketselect" id="pakketradio4" value="4">
				<label class="pakketlabel" for="pakketradio4">
				<div class="pakket-block">
					<i class="fa fa-star"></i>
					<p>Pakket op maat,<br> speciaal voor u.</p>
					<ul>
						<li>ID check</li>
						<li>Opleiding</li>
						<li>Werkervaring</li>
						<li>Online onderzoek</li>
						<li>Financiele situatie en gerechtelijke uitspraken</li>
						<li>Verklaring Omtrent Gedrag &amp; Integriteitsverklaring</li>
					</ul>
					<h2 class="pakket-prijs">&euro;175</h2>
				</div></label>

				<br class="clear-float">
				
			</div>

			<div id="settings-form-buttonblock"><input type="submit" id="next" name="submit" value="Opslaan"></div>
		</form>

		<?php include "../footer.php"; ?>
		<?php } //close if ?>

	</div> <!-- wrapper -->

</div>

</body>
</html>