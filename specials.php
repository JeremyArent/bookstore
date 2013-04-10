<?php
include('connexion/connexDB.php');

include('includes/header.php');

include('includes/menu.php');
?>

<div class="center_content">
    <div class="left_content">

        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Offres spéciales</div>
        <?php
        mysql_query("SET NAMES 'utf8'");
        $req = "SELECT COUNT(id) as Total FROM livre WHERE reduction = '1'";
        $resp = mysql_query($req);
        $result = mysql_fetch_assoc($resp);

        $nbLivre = $result['Total'];
        $perPage = 4;
        $nbPage = ceil($nbLivre / $perPage);

        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) {
            $currentPage = $_GET['p'];
        } else {
            $currentPage = 1;
        }
        
        $req = "SELECT * FROM livre WHERE reduction = '1' LIMIT ".(($currentPage - 1)*$perPage).",$perPage";
        $res = mysql_query($req);

        while ($resultat = mysql_fetch_array($res)) {
        echo '<div class="feat_prod_box">

            <div class="prod_img"><a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'"><img src="'.$resultat['couverture_full'].'" width="98px" height="150px" alt="" title="" border="0" /></a></div>

            <div class="prod_det_box">
                <span class="special_icon"><img src="images/special_icon.gif" alt="" title="" /></span>
                <div class="box_top"></div>
                <div class="box_center">
                    <div class="prod_title">'.$resultat['titre'].'</div>
                    <p class="details">'.$resultat['resume'].'</p>
                    <a href="details.php?id='.$resultat['id'].'&aut='.$resultat['id_auteur'].'" class="more">- plus de détails -</a>
                    <div class="clear"></div>
                </div>

                <div class="box_bottom"></div>
            </div>    
            <div class="clear"></div>
        </div>';
        }
        ?>           

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $nbPage; $i++) {
                if ($i == $currentPage) {
                    echo "<a href=\"specials.php?p=$i\" style='color:red;'>$i</a> ";
                } else {
                    echo "<a href=\"specials.php?p=$i\">$i</a> ";
                }
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