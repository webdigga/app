<?

$dbname = "localhost";
$dbuser = "diggasco_web";
$dbpass = "digga47digga";

$con = mysql_connect($dbname,$dbuser,$dbpass);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("diggasco_appcident", $con);

?>