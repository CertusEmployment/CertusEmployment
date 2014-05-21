<?php
	$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4); //Geeft de  filename van de pagina zonder .php bijv: 'editklant'

	if(!isset($_SESSION)) {
		session_start();
	}
	
	if(!$_SESSION['id']) {
		header('location: ../index.php');
	}
	if(isset($_POST['logout'])) {
		session_destroy();
		header("location: /certusemployment/index.php");
	}

	$alertquery = "SELECT * FROM klant WHERE bedrijfid=".$_SESSION['id']." AND rapport=0 ORDER BY aanmaakdatum LIMIT 0,3 ";
	$alertresult = mysql_query($alertquery);
	

?>
<nav>
	<div class="toolbar-wrapper">	
		<ul class="toolbar-list-left">
			<li class="toolbar-item"><a href="bedrijf-addkandidaat.php">Nieuwe kandidaat<i class="fa fa-plus"></i></a></li>
		</ul>
		<form name="navmenuform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<ul class="toolbar-list-right" >
				<li class="toolbar-item alert" id="submenu"><a href="#"><i class="fa fa-bell"></i></a>
					<ul class="sub-menu-alert">
					<?php while($alert = mysql_fetch_assoc($alertresult)) { 
						$date1 = new DateTime(date('d-m-Y', strtotime($alert['opleverdatum']))); //opleverdatum
						$date2 = new DateTime(date('d-m-Y')); //huidige datum
						if($date1 > $date2 && !isset($alert['rapport'])) {
							?><li>Leverdatum <?php echo $alert['voornaam']." ".$alert['achternaam']; ?> verstreken</li><?php
						} else {
					?><li><?php echo $alert['voornaam']." ".$alert['achternaam']; ?> screening aangemaakt</li><?php 
						}
					} ?>
					</ul>
				</li>
				<li class="toolbar-item"><button type="submit" name="logout">Log uit<i class="fa fa-power-off"></i></button></li>
				<?php if($basename !== "editwachtwoord" && $basename !== "editemail") { ?>
				<li class="toolbar-item"><a href="#">Opties<i class="fa fa-cog"></i></a>
						<ul class="sub-menu-option">
							<li><a href="../editwachtwoord.php">Wachtwoord wijzingen</a></li>
							<li><a href="../editemail.php">E-mail wijzigen</a></li>
							<label><li><input type="checkbox"> E-mail ontvangen</li></label>
						</ul>
				</li>
				<?php } ?>
			</ul>
		</form>
	</div>
</nav>