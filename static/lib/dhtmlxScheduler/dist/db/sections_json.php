<?php
require ("dbinfo.php");

// Opens a connection to a MySQL server
$connection=mysql_connect ($localhost, $user, $senha);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
//converter os caracteres especiais inseridos no banco
mysql_set_charset('utf8', $connection);

// Select all the rows in the markers table	
			 // AND status = 'Completed'
			 // AND status = 'Completed/Errors'
//$query = "SELECT * FROM localidades_teste WHERE 1";

$query = "SELECT DISTINCT specification AS `key`,
						  specification AS label	
			  FROM tbl_dp_backups
			  WHERE specification NOT LIKE '%TESTE%'
			  AND specification <> 'Interactive'
			  AND specification NOT LIKE '%OLD%'
			  AND specification NOT LIKE '%EXTRA%'
			  AND specification NOT LIKE '%DD'
			  AND specification NOT LIKE 'FRONT_%'
			  AND specification <> 'DEFAULT'
			  AND specification NOT LIKE '%\_0'
			  AND specification NOT LIKE '%\_1'
			  AND day_time between (NOW() - interval 1 month) and NOW()";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//set up the php headers so that the page doesnt cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate( "D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/json",true);

$json_data = array(); // create a new array

while ($row = mysql_fetch_assoc($result)) {
   array_push($json_data, $row);
}
 
$json_data = json_encode($json_data);
//$safe = array_map('htmlentities', $json_data);
echo $json_data; //$safe;

//close database connection
mysql_close($connection);

?>