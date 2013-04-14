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
                    <a href="a_propos.php">A Propos</a>
                </li>
                <li>
                    <a href="livre.php">Livres</a>
                </li>
                <li>
                    <a href="specials.php">Offres Spéciales</a>
                </li>
                <li>
                    <a href="membre.php">Profil</a>
                </li>
                <li>
                    <a href="logout.php">Se Déconnecter</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
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
                <li>
                    <a href="a_propos.php">A Propos</a>
                </li>
                <li>
                    <a href="livre.php">Livres</a>
                </li>
                <li>
                    <a href="specials.php">Offres Spéciales</a>
                </li>
                <li>
                    <a href="login.php">Se Connecter</a>
                </li>
                <li>
                    <a href="inscription.php">S'enregistrer</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </div>     
        <?php
        }
        ?> 
            
    </div> 
