<?php
include('includes/header.php');

include('includes/menu.php');
?>

<div class="center_content">
    <div class="left_content">
        <div class="crumb_nav">
            <a href="index.php">Accueil</a> &gt;&gt; Liste des livres
        </div>
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Tous les livres</div>

        <div class="new_products">
            <?php
            $req = "SELECT COUNT(id) as Total FROM livre";   
            $resp = mysql_query($req);
            $result = mysql_fetch_assoc($resp);
            
            $nbLivre = $result['Total'];
            $perPage = 12;
            $nbPage = ceil($nbLivre/$perPage);
            
            if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPage){
                $currentPage = $_GET['p'];
            }else{
                $currentPage = 1;
            }
            
            $req = "SELECT * FROM livre ORDER BY titre ASC LIMIT ".(($currentPage - 1)*$perPage).",$perPage";
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
            <div class="pagination">
                <?php
                    for ($i=1;$i<=$nbPage;$i++){
                        if($i==$currentPage){
                            echo "<a href=\"livre.php?p=$i\" style='color:red;'>$i</a> ";
                        }else{
                            echo "<a href=\"livre.php?p=$i\">$i</a> ";
                        }
                    }
                ?>
            </div>  

        </div> 


        <div class="clear"></div>
    </div><!--end of left content-->

<?php
include('includes/achat.php');

include('includes/droite.php');

include('includes/footer.php');
?>