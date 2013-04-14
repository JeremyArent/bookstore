<?php
include('connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');
?>
<div class="center_content">

    <div class="left_content">

        <div class="title">  


            <span class="title_icon">  
                <img src="images/bullet1.gif" alt="" title="" />
            </span>
            Nouveautés
        </div>

        <?php
        mysql_query("SET NAMES 'utf8'");
        $req = "SELECT * FROM livre ORDER BY date_ajout DESC LIMIT 2";
        $res = mysql_query($req);

        while ($resultat = mysql_fetch_array($res)) {
            echo '<div class="feat_prod_box">

            <div class="prod_img">
                <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'">
                    <img src='.$resultat['couverture_full'].' width="98px" height="150px"></img>
                </a>
            </div>
            <div class="prod_det_box">
                <div class="box_top"></div>
                <div class="box_center">
                    <div class="prod_title">' .
            $resultat['titre']
            . '
                        
                    </div>
                    <p class="details">' .
            $resultat['resume'] . '
                    </p>
                    <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'" class="more">- plus de détails -</a>
                    <div class="clear"></div>               
                </div>
                <div class="box_bottom"></div>
            </div>                 
            <div class="clear"></div>
        </div>';
        }
        ?>



        <div class="title"><span class="title_icon"><img src="images/bullet2.gif" alt="" title="" /></span>Ajouts Récents</div> 
        
        <div class="new_products">
                    <?php
                    $req = "SELECT * FROM livre ORDER BY date_ajout DESC LIMIT 3,3";
                    $res = mysql_query($req);

                    while ($resultat = mysql_fetch_array($res)) {
                    
                    echo '<div class="new_prod_box">
                        <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'">'.$resultat['titre'].'</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/new_icon.gif" alt="" title="" /></span>
                        <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'"><img src="'.$resultat['couverture_small'].'" alt="" title="" class="thumb" border="0" /></a>
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