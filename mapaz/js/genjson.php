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
//$query = "SELECT * FROM localidades_teste WHERE 1";

$query = "
SELECT *,(  SELECT nagios
            FROM tbl_ebt_nomeloc_padrao
            WHERE localidades_cadastro=nome_loc
            LIMIT 1) As nagios, (
            SELECT duration
            FROM tbl_links_indisponiveis
            WHERE host=nagios
            LIMIT  1) AS duration
FROM tbl_mapa_links
WHERE status = 'Ativado'
AND latitude <> ''
AND longitude <> ''
AND latitude <> '-'
AND longitude <> '-'";

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

//creates the file. json in the same folder genjson.php
//$fp = fopen('results.json', 'w');
//fwrite($fp, json_encode($json_data));
//fclose($fp);

?>