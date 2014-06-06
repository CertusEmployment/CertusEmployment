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

	$alertquery = "SELECT * FROM klant WHERE bedrijfid=".$_SESSION['id']." ORDER BY aanmaakdatum LIMIT 0,3 ";
	$alertresult = mysql_query($alertquery)or die(mysql_error());

	$mailsql = "SELECT * FROM bedrijf WHERE id=".$_SESSION['id']." ";
	$mailresult = mysql_query($mailsql)or die(mysql_error());
	$mailrow = mysql_fetch_assoc($mailresult);
	$sentmail = $mailrow['sentmail'];
	
	if(isset($_POST['submitmail'])) {
		if($sentmail==1) {
			$mailupdate = "UPDATE bedrijf SET sentmail=0 WHERE id=".$_SESSION['id']." ";
			mysql_query($mailupdate) or die(mysql_error());
			header("location:$basename.php ");
		} else {
			$mailupdate = "UPDATE bedrijf SET sentmail=1 WHERE id=".$_SESSION['id']." ";
			mysql_query($mailupdate) or die(mysql_error());
			header("location:$basename.php ");
		}
	}

	if($sentmail == 1) {
		$mailmessage = "U ontvangt nu geen e-mails meer van Certus Employment";
	} else {
		$mailmessage = "U ontvangt weer e-mails van Certus Employment";
	}
	

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
						<p style="border-bottom:1px solid #ddd;"><b>Meldingen</b></p>
						<?php while($alert = mysql_fetch_assoc($alertresult)) { 
							$date1 = new DateTime(date('d-m-Y', strtotime($alert['opleverdatum']))); //opleverdatum
							$date2 = new DateTime(date('d-m-Y')); //huidige datum
							if($date1 > $date2 && $alert['rapport']==0) {
								?><li class="errorinput" style="border:none;"><a href="bedrijf-panel.php?klantid=<?php echo $alert['id'] ?>">Leverdatum <?php echo $alert['voornaam']." ".$alert['achternaam']; ?> verstreken</a></li><?php
							} elseif ($date1 < $date2) {
						?><li><a href="bedrijf-panel.php?klantid=<?php echo $alert['id'] ?>"><?php echo $alert['voornaam']." ".$alert['achternaam']; ?> screening aangemaakt</a></li><?php 
							}
						} ?>
					</ul>
				</li>
				<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<li class="toolbar-item"><button type="submit" name="logout">Log uit<i class="fa fa-power-off"></i></button></li>
				</form>
				<?php if($basename !== "editwachtwoord" && $basename !== "editemail") { ?>
				<li class="toolbar-item"><a href="#">Opties<i class="fa fa-cog"></i></a>
						<ul class="sub-menu-option">
							<li><a href="../editwachtwoord.php">Wachtwoord wijzingen</a></li>
							<li><a href="../editemail.php">E-mail wijzigen</a></li>
							<form name="navmenuform" method="post" onSubmit="alert('<?php echo $mailmessage; ?>');" action="<?php $_SERVER['PHP_SELF']; ?>"><label><li><button type="submit" name="submitmail" style="font-size:12px;"><?php echo ($sentmail==1) ? "E-mail ontvangen uitschakelen" : "E-mail ontvangen inschakelen" ; ?></button></li></label></form>
						</ul>
				</li>
				<?php } ?>
			</ul>
		</form>
	</div>
</nav>