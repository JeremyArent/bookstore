<?php
session_start();

require_once('class/auth.class.php');
?>

<body>
<div id="wrap">

    <div class="header">
        <div class="logo">
            <a href="index.php">
                <img src="images/logo.gif" alt="" title="" border="0" />
            </a>
        </div>
        
        <?php
        if(Auth::isLog()){
        ?>
        <div id="menu">
            <ul>                                                                       
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="gestion_oeuvre.php">Gestion des Oeuvres</a>
                </li>
                <li>
                    <a href="gestion_membre.php">Gestion des Membres</a>
                </li>
                <li>
                    <a href="gestion_commande.php">Gestion des Commandes</a>
                </li>
                <li>
                    <a href="gestion_contact.php">Contact</a>
                </li>
                <li>
                    <a href="gestion_acces.php">Gestion des Accès</a>
                </li>
                <li>
                    <a href="https://www.google.com/analytics/web/?hl=fr&pli=1#report/visitors-overview/a40086097w69185294p71278022/" target="_blank">Statistiques</a>
                </li>
            </ul>
        </div> 
        <?php
        }else{
        ?>
        <div id="menu">
            <ul>                                                                       
                <li>
                    <a href="index.php">Accueil</a>
                </li>
            </ul>
        </div>     
        <?php
        }
        ?> 
            
    </div> 
