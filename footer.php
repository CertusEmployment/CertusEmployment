<div id="footer">
	<p>&copy; copyright <a style="color:inherit;" href="http://www.certus-employment.nl">Certus Employment</a> <?php echo date('Y'); ?> -  All Rights Reserved</p>
</div>

<?php

if(isset($db)){
	mysql_close($db);
}

?>