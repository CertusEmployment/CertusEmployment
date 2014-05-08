<?php
	$query_adminuser = "SELECT * FROM admin";
	$result_user = mysql_query($query_adminuser);
	
	session_start();

	if(!$_SESSION['id']) {
		header('location: ../index.php');
	}
	if(isset($_POST['logout'])) {
		session_destroy();

		header("location: ../index.php");
	}
?>
<nav>
	<div class="toolbar-wrapper">	
		<ul class="toolbar-list-left">
			<li class="toolbar-item"><a href="admin-nieuweklant.php">Nieuw bedrijf<i class="fa fa-plus"></i></a></li>
		</ul>
		<form name="navmenuform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<ul class="toolbar-list-right">
				<li class="toolbar-item"><button type="submit" name="logout">Logout<i class="fa fa-power-off"></i></button></li>
				<li class="toolbar-item"><a href="#">Opties<i class="fa fa-cog"></i></a>
				<?php while ($row = mysql_fetch_array($result_user)) { ?>
					<ul class="sub-menu-option">
						<li><a href="../editwachtwoord.php?table=admin&id=<?php echo $row['id']; ?>">Wachtwoord wijzingen</a></li>
						<li><a href="../editemail.php?table=admin&id=<?php echo $row['id']; ?>">E-mail wijzigen</a></li>
						<label><li><input type="checkbox"> E-mail ontvangen</li></label>
					</ul>
				<?php } ?>
				</li>
			</ul>
		</form>
	</div>
</nav>