<?php
$hostname = "localhost";
$database = "books";
$username = "root";
$password = "";
$connDB = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $connDB);

function recupNewBook(){
    $req = "SELECT * FROM livre WHERE date_ajout = CURRENT_DATE";
    $res = mysql_query($req);
    
    while($resultat = mysql_fetch_array($res)){
        echo $resultat['titre'];
    }
}
?>
