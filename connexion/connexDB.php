<?php
$hostname = "localhost";
$database = "books";
$username = "root";
$password = "";
$connDB = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $connDB);

?>
