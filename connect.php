<?php

$host = 'localhost';
$dbnaam = 'certustest';
$user = 'root';
$passw = 'Steverink23';

$db = mysql_connect($host,$user,$passw) or die(mysql_error());
mysql_select_db($dbnaam, $db) or die(mysql_error());

?>