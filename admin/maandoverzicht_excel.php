<?php
include "../connect.php";

$datumArray = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' );

$sql = "SELECT id as 'klantid', voornaam, achternaam, geslacht, straatnaam, huisnummer, huistoevoeging, postcode, plaats, land, geboortedatum, geboorteplaats, telnr as 'telefoonnummer', email, opleverdatum, aanmaakdatum FROM klant WHERE bedrijfid = ".$_GET['bedrijfid']." AND MONTH(aanmaakdatum)=".$_GET['maand']." ";
$result = mysql_query($sql) or die(mysql_error());

$filename = "maandoverzicht_".$_GET['bedrijfnaam']."_".$datumArray[$_GET['maand']]."_".$_GET['jaar'];
$file_ending = "xls";
$sep = "\t"; //tabbed character


header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");

//Kollom namen
for ($i = 0; $i < mysql_num_fields($result); $i++) {
    echo mysql_field_name($result,$i) . "\t";
}
print("\n");	
//Eind kollomnamen
 	
while($row = mysql_fetch_row($result))	{	//Data ophalen
    $schema_insert = "";
    
    for($j=0; $j<mysql_num_fields($result); $j++) {
        if (!isset($row[$j])) {
            $schema_insert .= "NULL".$sep;
        }
        elseif ($row[$j] != "") {
            $schema_insert .= "$row[$j]".$sep;
        }
        else {
            $schema_insert .= "".$sep;
        }
    }

    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";

    print(trim($schema_insert));
    print "\n";
}
?>