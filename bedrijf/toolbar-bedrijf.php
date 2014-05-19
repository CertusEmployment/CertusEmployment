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

//	20 mins in seconds
	// $inactive = 1200;
	// $session_life = time() - $_SESSION['timeout']; 
	// if($session_life > $inactive) {
	//    session_destroy(); header("Location: ../index.php");
	// }
	// $_SESSION['timeout']=time();
	

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
						<li>Matt Lauer screeningrapport beschikbaar</li>
						<li>Erik DeWitt heeft screening afgerond</li>
						<li>Maatwerkpakket is gewijzigd</li>
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