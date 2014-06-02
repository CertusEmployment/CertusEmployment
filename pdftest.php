<?php
include "connect.php";

$datumArray = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );

$sql = "SELECT * FROM integriteit";
$result = mysql_query($sql) or die(mysql_error());

$filename = "Overzicht_".$datumArray[$_GET['maand']]."_".$_GET['jaar'];
$file_ending = "pdf";
$sep = "\t"; //tabbed character

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=$filename.pdf");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table>";
$i=1;
while ($row=mysql_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>Vraag ".$i.":</td>";
    echo "<td>".$row['vraag']."</td>";
    echo"</tr>";
    $i++;
}
echo "</table>";
?>