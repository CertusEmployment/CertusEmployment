<?php
	if(!isset($_SESSION)) {
		session_start();
	}

	if(!$_SESSION['id']) {
		header('location: ../index.php');
	}
	if(isset($_POST['logout'])) {
		session_destroy();
		if($basename !== "editwachtwoord" && $basename !== "editemail") {
			header("location: ../index.php");
		}
		else {
			header("location: index.php");
		}
	}
?>
<!-- KLANT -->
<nav>	
	<div class="toolbar-wrapper">
		<form name="navmenuform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">	
			<ul class="toolbar-list-right">
				<li class="toolbar-item"><button type="submit" name="logout">Log uit<i class="fa fa-power-off"></i></button></li>
				<li class="toolbar-item"><a href="#">Opties<i class="fa fa-cog"></i></a>
					<ul class="sub-menu-option">
						<li>Wachtwoord wijzingen</li>
						<li>E-mail wijzigen</li>
						<label><li><input type="checkbox"> E-mail ontvangen</li></label>
					</ul>
				</li>
			</ul>
		</form>
	</div>
</nav>