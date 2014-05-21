<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	if(isset($_POST['logout'])) {
		session_destroy();
	}
	if(!isset($_SESSION['id'])) {
		header("location: ../index.php");
	}
?>
<!-- BASICTOOLBAR -->
<nav>	
	<div class="toolbar-wrapper">
		<form name="navmenuform" method="post" action="../index.php">	
			<ul class="toolbar-list-right">
				<li class="toolbar-item"><button type="submit" name="logout">Log uit<i class="fa fa-power-off"></i></button></li>
			</ul>
		</form>
	</div>
</nav>