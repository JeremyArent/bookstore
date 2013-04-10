<?php
include('../connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');
?>

<div class="center_content">

    <div class="left_content">

        <div class="title">
            <span class="title_icon">
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Gestion des Commandes
        </div>

        <?php
        if(Auth::isLog()){
        ?>
        <div class="feat_prod_box">
            
        </div>
        <?php
        }else{
        ?>
        <div class="feat_prod_box">
            Vous n'avez pas les droits pour accéder à cette partie.
        </div>
        <?php
        }
        ?>	

        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/footer.php');
?>