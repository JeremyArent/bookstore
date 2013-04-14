<?php
include('includes/header.php');

include('includes/menu.php');

$cat = $_GET['categorie1'];

?>

<div class="center_content">
    <div class="left_content">
        <div class="crumb_nav">
            <a href="index.php">Accueil</a> &gt;&gt; Catégorie
        </div>
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Tous les livres</div>

        <div class="new_products">
            <?php
            $req = "SELECT * FROM livre WHERE categorie1='$cat' ORDER BY titre ASC";
            $res = mysql_query($req);

            while ($resultat = mysql_fetch_array($res)) {
            echo '<div class="new_prod_box">
                <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'"></a>
                <div class="new_prod_bg">
                    <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'"><img src="'.$resultat['couverture_small'].'" alt="" title="'.$resultat['titre'].'" class="thumb" border="0" /></a>
                </div>           
            </div>';
            }
            ?>                
        </div> 


        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>