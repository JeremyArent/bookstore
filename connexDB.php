<?php
$hostname = "mysql.hostinger.fr";
$database = "u500668516_books";
$username = "u500668516_jerem";
$password = "bookspwd";
$connDB = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $connDB);

?>
