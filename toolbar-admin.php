<?php
	$query_adminuser = "SELECT * FROM admin";
	$result_user = mysql_query($query_adminuser);
?>
<nav>
	<div class="toolbar-wrapper">	
		<ul class="toolbar-list-left">
			<li class="toolbar-item"><a href="admin-nieuweklant.php">Nieuw bedrijf<i class="fa fa-plus"></i></a></li>
		</ul>

		<ul class="toolbar-list-right">
			<li class="toolbar-item"><a href="#">Logout<i class="fa fa-power-off"></i></a></li>
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
	</div>
</nav>