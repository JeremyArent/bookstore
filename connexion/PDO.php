<?php
$serveur = 'localhost';
$user = 'root';
$pass = '';
$bdd = 'books';
$port = '3306';

try{
    $cnx = new PDO('mysql:host='.$serveur.';port='.$port.';dbname='.$bdd, $user, $pass);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
